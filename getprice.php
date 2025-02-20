<?php
include'config.php';

 if (isset( $_REQUEST['str']) && isset($_REQUEST['diffDays'])) {
 //
    $q = $_REQUEST['str'];
    $diffDays= intval($_REQUEST['diffDays']);
                     
                     
    $sql="SELECT room_type.price FROM room_type WHERE room_type.RtypeID=?";
      $stmt=mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt,$sql)){
         echo('failed to connect');
        exit();
    }
    mysqli_stmt_bind_param($stmt,'s',$q);
    mysqli_stmt_execute($stmt);
    $result=mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result)>0) {
        while($row=mysqli_fetch_assoc($result)){
            $price=intval($row['price']); 
            $p=$diffDays * $price;
            echo $p;
            
           // <!-- <input type="text" name="price" id="price" placeholder="price..." value="<?php //echo $p >
        }      
    }else{echo 0;}     
 }
 else{echo "not set";}?>

