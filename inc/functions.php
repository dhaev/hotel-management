<?php
//require_once '../config.php';
//----------------------------------------INSERT-CUSTOMER-------------------------------------------
	function insertCustomer($conn,$fname,$lname,$email,$phone){
				$sql="INSERT INTO customer (fname,lname,email,phone) VALUES(?,?,?,?);";
			$stmt=mysqli_stmt_init($conn);

			if (!mysqli_stmt_prepare($stmt,$sql)){
				echo('failed to connect');
				exit();
			}			
			mysqli_stmt_bind_param($stmt,'ssss',$fname,$lname,$email,$phone);
			mysqli_stmt_execute($stmt);
		}

//----------------------------------------UPDATE-CUSTOMER-------------------------------------------
	function updateCustomer($conn,$id,$fname,$lname,$email,$phone,$address,$country,$city){
	
		
	    $sql="UPDATE `customer` SET `fname`=?,`lname`=?,`email`=?,`phone`=?,`address`=?,`country`=?,`city`=? WHERE `CustomerID`=?;";
        $stmt=mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt,$sql)){
            echo(' select cus failed');
             exit();
        }
        mysqli_stmt_bind_param($stmt,'sssssssi',$fname,$lname,$email,$phone,$address,$country,$city,$id);
        mysqli_stmt_execute($stmt);
        
		}

//----------------------------------------SELECT-ROOM-NUMBER----------------------------------------
	function selectRnum($conn,$rnum){
		        
        $sql="SELECT * FROM room WHERE rnum=?;";
        $stmt=mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt,$sql)){
            echo('failed to connect');
             exit();
        }
        mysqli_stmt_bind_param($stmt,'i',$rnum);
        mysqli_stmt_execute($stmt);
        $result=mysqli_stmt_get_result($stmt);
        if (mysqli_num_rows($result)>0) {
        while($row=mysqli_fetch_assoc($result)){	
	        return $row;
	    }
	    }else {
			echo('no room available');
			$result = false;
			return $result;
			exit();
		} 
    } 

//----------------------------------------REGISTER-CUSTOMER-----------------------------------------
	function register($conn,$CustomerID,$pwd,$image){
	    $sql="INSERT INTO registered (CustomerID,password,image) VALUES(?,?,?);";   	
        $stmt=mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt,$sql)){
            echo('failed to register');
             exit();
        }
        $hashpwd=password_hash($pwd, PASSWORD_DEFAULT);
        mysqli_stmt_bind_param($stmt,'iss',$CustomerID,$hashpwd,$image);
        mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);	
	}  

//-----------------------------------------------------------------------			
	function selectCustomer($conn,$fname,$lname,$email,$phone){
	
	$sql="SELECT CustomerID FROM customer WHERE  fname=? AND lname=? AND email=? AND phone=?;";
        $stmt=mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt,$sql)){
            echo('select cus failed');
             exit();
        }
        mysqli_stmt_bind_param($stmt,'ssss',$fname,$lname,$email,$phone);
        mysqli_stmt_execute($stmt);
        $result=mysqli_stmt_get_result($stmt);
        if (mysqli_num_rows($result)>0) {
        	$row=mysqli_fetch_assoc($result);
        	return $row;

        }else{
        	$res=false;
			return $res;
        }
        
    }
//----------------------------------------SIGN-UP---------------------------------------------------
	function signupEmpty($fname,$lname,$email,$phone,$pwd,$rpwd){
		$result;
		if (empty($fname)||empty($lname)||empty($email)||empty($phone)||empty($pwd)||empty($rpwd)){
			$result = true;
		}
		else {
			$result = false;
		}
		return $result;
	}

	function validUserID($name){
		$result;
		if (!preg_match('/^[a-zA-Z0-9]*$/',$name)){
			$result = true;
		}
		else {
			$result = false;
		}
		return $result;
	}

	function invalidEmail($email){
		$result;
		if (!filter_var($email,FILTER_VALIDATE_EMAIL)){
			$result = true;
		}
		else {
			$result = false;
		}
		return $result;
	}

	function pwdMatch($pwd,$rpwd){
		$result;
		if ($pwd !== $rpwd){
			$result = true;
		}
		else {
			$result = false;
		}
		return $result;
	}

	function emailExists($conn,$email){
		$sql="SELECT customer.fname,customer.lname,customer.phone,customer.address,customer.country,customer.city,customer.email,registered.CustomerID,registered.password,registered.image FROM customer,registered WHERE customer.email= ? AND customer.CustomerID=registered.CustomerID ;";
		$stmt=mysqli_stmt_init($conn);

		if (!mysqli_stmt_prepare($stmt,$sql)){
			echo('stmt emailname exist failed');
			exit();
		}
		mysqli_stmt_bind_param($stmt,'s',$email);
		mysqli_stmt_execute($stmt);

		$resultData=mysqli_stmt_get_result($stmt);
		
		if ($row=mysqli_fetch_assoc($resultData)) {
		
		return $row;
		}
		else {
			$result = false;
			return $result;
		}

		mysqli_stmt_close($stmt);
	}

	function createUser($conn,$fname,$lname,$email,$phone,$pwd,$image){
		$ID=selectCustomer($conn,$fname,$lname,$email,$phone) ;
		if($ID !==false){
		$CustomerID=$ID['CustomerID']; 
		}
		else{
			insertCustomer($conn,$fname,$lname,$email,$phone);
			$CustomerID=mysqli_insert_id($conn);  
		}
	    register($conn,$CustomerID,$pwd,$image);
		session_start();
		$_SESSION['CustomerID'] =$CustomerID;
		$_SESSION['fname'] =$fname;
		$_SESSION['lname'] =$lname;
		$_SESSION['email'] =$email;
		$_SESSION['phone'] =$phone;		
		$_SESSION['image'] =$image;
		echo('welcome');
			
	}

//----------------------------------------LOG-IN----------------------------------------------------
	function loginEmpty($email,$pwd){
		$result;
		if (empty($email)||empty($pwd)){
			$result = true;
		}
		else {
			$result = false;
		}
		return $result;
	}

	function loginUser($conn,$email,$pwd){
		$email=emailExists($conn,$email);
		if ($email === false) {
			echo('email does not exist');
			exit();
		}

		$hashedpwd=$email['password'];
		$pwdcheck=password_verify($pwd, $hashedpwd);
		if ( $pwdcheck === false) {
			echo('incorrect password');
			exit();
		}
		elseif ($pwdcheck === true) {
			session_start();
			$_SESSION['CustomerID'] =$email['CustomerID'];
			$_SESSION['fname'] =$email['fname'];
			$_SESSION['lname'] =$email['lname'];
			$_SESSION['email'] =$email['email'];
			$_SESSION['phone'] =$email['phone'];
			$_SESSION['address'] =$email['address'];
			$_SESSION['country'] =$email['country'];
			$_SESSION['city'] =$email['city'];			
			$_SESSION['image'] =$email['image'];
		}
 }

//----------------------------------------UPDATE-PROFILE--------------------------------------------

function updateProfileImage($conn,$image,$id){
			
		$sql="UPDATE registered SET `image`=? WHERE `CustomerID`=?";
		$stmt=mysqli_stmt_init($conn);

	if (!mysqli_stmt_prepare($stmt,$sql)){
		echo('could not update');
	} 

	mysqli_stmt_bind_param($stmt,'si',$image,$id);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	
		$_SESSION['image'] =$image;
	
	}

//----------------------------------------ADD-ROOM--------------------------------------------------

	function addRoomEmpty($rtype,$rnum){
		$empty=loginEmpty($rtype,$rnum);
		return $empty;
	}

	function createRoom($conn,$RtypeID,$rnum){
		// var_dump($rtype);
	//---------------------SELECT ROOM TYPE----------------------------------------
		if(rtypeExists($conn,$RtypeID)){
			$sql="INSERT INTO room (rnum,RtypeID) VALUES(?,?);";
		$stmt=mysqli_stmt_init($conn);

		if (!mysqli_stmt_prepare($stmt,$sql)){
			echo('stmt insert new room failed');
			exit();
		}
		mysqli_stmt_bind_param($stmt,'si',$rnum,$RtypeID);
		mysqli_stmt_execute($stmt);

		mysqli_stmt_close($stmt);
		echo('New Room Added');
	}
	
	else{
		echo('Room type does not exist');
	}
	} 
	//--------------------INSERT NEW ROOM---------------------------
		

//----------------------------------------BOOK------------------------------------------------------

	function bookEmpty($checkin,$checkout,$rtype,$rnum,$price,$fname,$lname,$email,$phone){
		$result;
		if (empty($checkin)||empty($checkout)||empty($rtype)||empty($rnum)||empty($price)||empty($fname)||empty($lname)||empty($email)||empty($phone)){
			$result = true;
		}
		else {
			$result = false;
		}
		return $result;
	}

	function createBook($conn,$checkin,$checkout,$fname,$lname,$email,$phone){

		$ID=selectCustomer($conn,$fname,$lname,$email,$phone) ;
		if($ID !==false){
		$CustomerID=$ID['CustomerID']; 
		}
		else{
		//---------------------INSERT-CUSTOMER----------------------------------------
			insertCustomer($conn,$fname,$lname,$email,$phone);
			$CustomerID=mysqli_insert_id($conn);
		}
		 
	   
//check if session is guest---------------------INSERT INTO BOOK----------------------------------------
		$sql="INSERT INTO book (CustomerID,check_in,check_out) VALUES(?,ADDDATE(STR_TO_DATE(?,'%Y-%m-%d'),INTERVAL 14 HOUR),ADDDATE(STR_TO_DATE(?,'%Y-%m-%d'),INTERVAL 12 HOUR))";
		 $stmt=mysqli_stmt_init($conn);
	    if (!mysqli_stmt_prepare($stmt,$sql)){
	        echo(' insert book failed');
	         exit();
	    }
	    mysqli_stmt_bind_param($stmt,'iss',$CustomerID,$checkin,$checkout);
	    mysqli_stmt_execute($stmt);
	    $BookID=mysqli_insert_id($conn);
	    mysqli_stmt_close($stmt);
	    
   return $BookID;
	}
	function bookRnum($conn,$RtypeID,$checkin,$checkout,$BookID,$status,$price)
	{

		$b=0;
        $bs=1;
        $m=1;
    
		$num = getrnum($conn,$RtypeID,$b,$bs,$checkin,$checkout,$m); 
		var_dump($num);
		$rnum = $num['rnum'];
		$RoomID=$num['RoomID'];
		

	    $sql="INSERT INTO book_rnum (BookID,RoomID,status,price) VALUES(?,?,?,?)";
		 $stmt=mysqli_stmt_init($conn);
	    if (!mysqli_stmt_prepare($stmt,$sql)){
	        echo(' insert bookrnum failed');
	         exit();
	    }
	    mysqli_stmt_bind_param($stmt,'iiid',$BookID,$RoomID,$status,$price);
	    mysqli_stmt_execute($stmt);
	    mysqli_stmt_close($stmt);
		echo('booking successful');
	}

//----------------------------------------CHANGE-PASSWORD-------------------------------------------

	function pwdEmpty($oldpwd,$newpwd){
		$empty=loginEmpty($oldpwd,$newpwd);
		return $empty;
	}

	function cpwd($conn,$email,$oldpwd){
		$result;
		$cpwd=emailExists($conn,$email);
		$hashedpwd=$cpwd['password'];
		$pwdcheck=password_verify($oldpwd, $hashedpwd);
		if ( $pwdcheck === false) {
			echo(' incorrect password');
			exit();
		}else{
		$result=false;		
		}
		return $result;
	}
	
	function passwordUpdate($conn,$id,$newpwd){
		$sql="UPDATE registered SET `password`=? WHERE `CustomerID`=?";
	    $stmt=mysqli_stmt_init($conn);
	    if (!mysqli_stmt_prepare($stmt,$sql)){
	       echo('could not connect to server');
	    } 
		$hashpwd=password_hash($newpwd, PASSWORD_DEFAULT);
	    mysqli_stmt_bind_param($stmt,'si',$hashpwd,$id);
	    mysqli_stmt_execute($stmt);
	    mysqli_stmt_close($stmt);
	  	echo('password updated');
	  }

//----------------------------------------UPDATE-BOOK-----------------------------------------------

	function updateBook($conn,$Customerid,$Bookid,$id,$checkin,$checkout,$RoomID,$price,$fname,$lname,$email,$phone,$address,$country,$city,$status){		
		//---------------------UPDATE-CUSTOMER----------------------------------------
		updateCustomer($conn,$Customerid,$fname,$lname,$email,$phone,$address,$country,$city);
		//---------------------SELECT ROOM NUMBER----------------------------------------	
		
		//---------------------UPDATE BOOK----------------------------------------
		$sql="UPDATE book SET `check_in`=ADDDATE(STR_TO_DATE(?,'%Y-%m-%d'),INTERVAL 14 HOUR),`check_out`=ADDDATE(STR_TO_DATE(?,'%Y-%m-%d'),INTERVAL 12 HOUR) WHERE BookID=?;";
		 $stmt=mysqli_stmt_init($conn);
	    if (!mysqli_stmt_prepare($stmt,$sql)){
	        echo('insert book failed');
	         exit();
	    }
	    mysqli_stmt_bind_param($stmt,'ssi',$checkin,$checkout,$id);
	    mysqli_stmt_execute($stmt);
	    mysqli_stmt_close($stmt);

	    $sql="UPDATE book_rnum SET `RoomID`=?,`price`=? WHERE id=?;";
		 $stmt=mysqli_stmt_init($conn);
	    if (!mysqli_stmt_prepare($stmt,$sql)){
	        echo('insert book failed');
	         exit();
	    }
	    mysqli_stmt_bind_param($stmt,'iii',$RoomID,$price,$id);
	    mysqli_stmt_execute($stmt);
	    mysqli_stmt_close($stmt);
		echo('bookin updated');
	}

//----------------------------------------ADD-ROOM-TYPE---------------------------------------------
	function addrtypeEmpty($rtype,$price,$desc,$image){
		$result;
		if (empty($rtype)||empty($price)||empty($desc)||empty($image)){
			$result = true;
		}
		else {
			$result = false;
		}
		return $result;
	}

	function rtypeExists($conn,$RtypeID){
	//---------------------SELECT ROOM TYPE----------------------------------------
		$sql="SELECT * FROM room_type WHERE RtypeID = ?;";
		$stmt=mysqli_stmt_init($conn);

		if (!mysqli_stmt_prepare($stmt,$sql)){
			echo('failed to connect');
			exit();
		}
		mysqli_stmt_bind_param($stmt,'i',$RtypeID);
		mysqli_stmt_execute($stmt);
		$result=mysqli_stmt_get_result($stmt);
		if (mysqli_num_rows($result)>0) {
			while($row=mysqli_fetch_assoc($result)){
				return $row;
			}
		}
		else {
			$result = false;
			
			echo('Room type does not exist');
		}
		return $result;
		mysqli_stmt_close($stmt);
	}

	function rtypeprice($conn,$rtype){
		//---------------------SELECT ROOM TYPE----------------------------------------
			$sql="SELECT price FROM room_type WHERE RtypeID = ?;";
			$stmt=mysqli_stmt_init($conn);
	
			if (!mysqli_stmt_prepare($stmt,$sql)){
				echo('failed to connect');
				exit();
			}
			mysqli_stmt_bind_param($stmt,'s',$rtype);
			mysqli_stmt_execute($stmt);
			$result=mysqli_stmt_get_result($stmt);
			if (mysqli_num_rows($result)>0) {
				while($row=mysqli_fetch_assoc($result)){
					return $row;
				}
			}
			else {
				$result = false;
				
				echo('Room type does not exist');
			}
			return $result;
			mysqli_stmt_close($stmt);
		}
	
//----------------------------------------INSERT NEW ROOM-TYPE---------------------------------------
	function addRtype($conn,$rtype,$price,$desc,$image){
		$sql="INSERT INTO room_type (rtype,price,description,image) VALUES(?,?,?,?);";
		$stmt=mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt,$sql)){
			echo('stmt insert add_rtype failed');
			exit();
		}
		mysqli_stmt_bind_param($stmt,'sdss',$rtype,$price,$desc,$image);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
		echo('New room type added');			
	}
	//------------------------------------UPDATE-ROOM-TYPE--------------------------
	function updateRtype($conn,$rtype,$price,$desc,$RtypeID){
	
		$sql="UPDATE room_type SET rtype=?,price=?,description=?, WHERE RtypeID=?";
		$stmt=mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt,$sql)){
			echo(' failed to update rtype');
			exit();
		}
		mysqli_stmt_bind_param($stmt,'sisi',$rtype,$price,$desc,$RtypeID);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
		echo('room type updated');			
	}
	function updateRtypeImage($conn,$image,$RtypeID){
	
		$sql="UPDATE room_type SET image=? WHERE RtypeID=?";
		$stmt=mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt,$sql)){
			echo(' failed to update rtype');
			exit();
		}
		mysqli_stmt_bind_param($stmt,'si',$image,$RtypeID);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
		echo('room type updated');			
	}

//----------------------------------------FILE-UPLOAD------------------------------------------------
	function invalidImage($fileEXT,$allowed,$fileSize,$fileError,$image,$fileTempName,$fileDestination){
		$result;
		var_dump($allowed);
		var_dump($fileEXT);

		if (in_array($fileEXT,$allowed)) {
            if ($fileSize < 100000000) {
                if ($fileError === 0) {
                    move_uploaded_file($fileTempName, $fileDestination);						
					$result=false;                         
                }else {
                    echo ("file could not be uploaded");
                    //print_r($file);
                    $result=true;
            	}
                  
    	    } else {
				echo ("file is too large");
				$result=true;
            }
            
        } else {
            echo('invalid image type...only jpg jpeg and png files supported');
            $result=true;
        }  

		return $result;
	}

//----------------------------------------CHANGE-BOOK-STATUS-----------------------------------------
//----------------------------------------------------------------------------------------------
    function getrnum($conn,$RtypeID,$b,$bs,$r,$s,$m){
	
    $sql="SELECT * FROM `room` WHERE room.RtypeID=? AND  room.RoomID NOT IN ( SELECT book_rnum.RoomID FROM `book_rnum`,`book` WHERE 
        book_rnum.BookID=book.BookID AND 
		-- (book_rnum.status=? or book_rnum.status=?) AND 
        
          ((book.check_in BETWEEN ADDDATE(STR_TO_DATE(?,'%Y-%m-%d'),INTERVAL 14 HOUR) AND ADDDATE(STR_TO_DATE(?,'%Y-%m-%d'),INTERVAL 12 HOUR))
         OR 
        
         (book.check_out BETWEEN ADDDATE(STR_TO_DATE(?,'%Y-%m-%d'),INTERVAL 14 HOUR) AND ADDDATE(STR_TO_DATE(?,'%Y-%m-%d'),INTERVAL 12 HOUR))
         OR
        
         ( ADDDATE(STR_TO_DATE(?,'%Y-%m-%d'),INTERVAL 14 HOUR) BETWEEN book.check_in AND book.check_out)
         OR
        
         ( ADDDATE(STR_TO_DATE(?,'%Y-%m-%d'),INTERVAL 12 HOUR) BETWEEN book.check_in AND book.check_out)))";
		// --   UNION
        // --  SELECT maintenance.RoomID FROM maintenance WHERE maintenance.status=?)"; 
	 $stmt=mysqli_stmt_init($conn); 
	 if (!mysqli_stmt_prepare($stmt,$sql)){ 
	 	echo('index.php ?  failed to get room'); 
	 	exit();
	 	 }
	  mysqli_stmt_bind_param($stmt,'issssss',$RtypeID,$r,$s,$r,$s,$r,$s);
	  mysqli_stmt_execute($stmt);
	  $result=mysqli_stmt_get_result($stmt);

	 if (mysqli_num_rows($result)>0) {
	    $row=mysqli_fetch_all($result,MYSQLI_ASSOC) ;   
	    return $row  ;
	 }else{}
	 }

	 function geteditrnum($conn,$RtypeID,$b,$bs,$r,$s,$m,$RoomID){
     $sql="SELECT * FROM `room` WHERE room.RtypeID=? AND  room.RoomID NOT IN ( SELECT book_rnum.RoomID FROM `book_rnum`,`book` WHERE 
        book_rnum.BookID=book.BookID AND (book_rnum.status=? or book_rnum.status=?) AND 
        
          ((book.check_in BETWEEN ADDDATE(STR_TO_DATE(?,'%Y-%m-%d'),INTERVAL 14 HOUR) AND ADDDATE(STR_TO_DATE(?,'%Y-%m-%d'),INTERVAL 12 HOUR))
         OR 
        
         (book.check_out BETWEEN ADDDATE(STR_TO_DATE(?,'%Y-%m-%d'),INTERVAL 14 HOUR) AND ADDDATE(STR_TO_DATE(?,'%Y-%m-%d'),INTERVAL 12 HOUR))
         OR
        
         ( ADDDATE(STR_TO_DATE(?,'%Y-%m-%d'),INTERVAL 14 HOUR) BETWEEN book.check_in AND book.check_out)
         OR
        
         ( ADDDATE(STR_TO_DATE(?,'%Y-%m-%d'),INTERVAL 12 HOUR) BETWEEN book.check_in AND book.check_out)) UNION
         SELECT maintenance.RoomID FROM maintenance WHERE maintenance.status=?)
     UNION ( SELECT * FROM `room` WHERE room.RoomID=? AND room.RtypeID=?)" ;
	 $stmt=mysqli_stmt_init($conn); 
	 if (!mysqli_stmt_prepare($stmt,$sql)){ 
	 	echo('index.php ?  failed'); 
	 	exit();
	 	 }
	  mysqli_stmt_bind_param($stmt,'iiissssssiii',$RtypeID,$b,$bs,$r,$s,$r,$s,$r,$s,$m,$RoomID,$RtypeID);
	  mysqli_stmt_execute($stmt);
	  $result=mysqli_stmt_get_result($stmt);

	 if (mysqli_num_rows($result)>0) {
		while($row=mysqli_fetch_all($result,MYSQLI_ASSOC))   
	    {return $row  ;}
	 }else{}
	 }
//--------------------------------------------------------
function dirtyRoom($conn,$RoomID){
	     $sql="UPDATE `room` SET  status=1 WHERE RoomID=?";
	     $stmt=mysqli_stmt_init($conn);

	    if (!mysqli_stmt_prepare($stmt,$sql)){
	        echo('stmt failed:could not cancel2');
	    } 

	    mysqli_stmt_bind_param($stmt,'i',$RoomID);
	    mysqli_stmt_execute($stmt);
	    mysqli_stmt_close($stmt);
	     
	   
	     }

function clean($conn,$RoomID){
	     $sql="UPDATE `room` SET  status=0 WHERE RoomID=?";
	     $stmt=mysqli_stmt_init($conn);

	    if (!mysqli_stmt_prepare($stmt,$sql)){
	        echo('stmt failed:could not cancel2');
	    } 

	    mysqli_stmt_bind_param($stmt,'i',$RoomID);
	    mysqli_stmt_execute($stmt);
	    mysqli_stmt_close($stmt);
	     
	   
	     }
//-------------------------------------------------------------------
	     function bookingstatus($conn,$ID,$status) {
	 
	 $sql="UPDATE `book_rnum` SET `status`=? WHERE id=?";
	 	     $stmt=mysqli_stmt_init($conn);
	 
	 	    if (!mysqli_stmt_prepare($stmt,$sql)){
	 	        echo('view_booked.php ?stmt failed:could not cancel');
	 	    } 
	 
	 	    mysqli_stmt_bind_param($stmt,'ii',$status,$ID);
	 	    mysqli_stmt_execute($stmt);
	  		mysqli_stmt_close($stmt);
	  	}
//----------------------------
	  	function SelectAllRtype($conn){
                        
        $sql="SELECT * FROM room_type ";
        $stmt=mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt,$sql)){
            echo('failed to connect');
             exit();
        }
         
        mysqli_stmt_execute($stmt);
        $result=mysqli_stmt_get_result($stmt);
        $numr=mysqli_num_rows($result);
        if ($numr>0) {
          $row=mysqli_fetch_all($result,MYSQLI_ASSOC) ;    
           
            return $row  ;
       
        }else {
            echo('no room available');
            $result = false;
            return $result;
            exit();
        } 
         mysqli_stmt_close($stmt);
     }