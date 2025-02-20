function showUser(str) {
  if (str=="") {
    document.getElementById("rnum").innerHTML="";
    return;
  }
  const x=document.getElementById('cin').value;
  const y =document.getElementById('cout').value;
  var xmlhttp=new XMLHttpRequest();
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("rnum").innerHTML=this.responseText;
    }
  }
  xmlhttp.open("GET","getuser.php?q="+str+"&r="+x+"&s="+y,true);
  xmlhttp.send();
}

//----------------------VALDATE-CHECK-IN DATE--------------------
  function checkinDate(){
   const x=new Date(document.getElementById('cin').value);
   const y=new Date(document.getElementById('cout').value);
   const z = new Date();

   x.setHours(16);
   y.setHours(16);

   x.getTime()
   y.getTime()
   z.getTime()

  const a= y - x;

  //document.getElementById('show').innerHTML= 'cin: '+ a;
  console.log(a);

   if ( x<z || a < 1) {
     window.alert('please select a valid date');
     document.getElementById('cin').value= '';
  }

  }
//----------------------VALDATE-CHECK-OUT DATE--------------------
  function checkoutDate(){
   const x=new Date(document.getElementById('cin').value);
   const y = new Date(document.getElementById('cout').value); 
   x.setHours(16);
   y.setHours(16);
   //const diffTime = b.getTime() - a.getTime(); -----------------------------------
   const diffTime = y.getTime() - x.getTime();
   const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)); 
  console.log(diffDays);

   if (diffTime < 1) { //or diffDays
    window.alert('please select a valid date');
    document.getElementById('cout').value= '';
   }

  }

//----------------------TESTING DISPLAY OUTPUT--------------------
  function show(){


    const cin= new Date(document.getElementById('cin').value);
    const cout = new  Date(document.getElementById('cout').value);
     const y = new Date();

     document.getElementById('show1').innerHTML= 'cin: '+ cin +'cout: '+ cout +'today: '+y;

    const date1 = cin;
  const date2 = cout;
  const date3 = y;

  document.getElementById('show7').innerHTML= 'd1: '+ date1 +'d2: '+ date2 +'d3: '+date3;


  var a=cin.getTime()
  var b=cout.getTime()
  var c=y.getTime()

  document.getElementById('show2').innerHTML= 'a: '+ a +'b: '+ b +'c: '+c;
  const diffTime = b - a;
  document.getElementById('show3').innerHTML= 'timediff: '+ diffTime;
  const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)); 
  console.log(diffDays);

  const s1 = cin.setHours(16);
  const s2 = cout.setHours(16);
  const s3 = y.setHours(16);

  document.getElementById('show4').innerHTML= 's1: '+ s1 +'s2: '+ s2 +'s3: '+s3;

  const p1 = new Date(s1);
  const p2 = new Date(s2);
  const p3 = new Date(s3);

  document.getElementById('show6').innerHTML= 'p1: '+ p1 +'p2: '+ p2 +'p3: '+p3;


    if (11 > 10) {
     document.getElementById("show9").innerHTML = "hipitiiskibiti pop pop";
    }

    
  }




function myFunction() {
  // Get the value of the input field with id="numb"
  let x = document.getElementById("numb").value;
  // If x is Not a Number or less than one or greater than 10
  let text;
  if (isNaN(x) || x < 1 || x > 10) {
    text = "Input not valid";
  } else {
    text = "Input OK";
  }
  document.getElementById("demo").innerHTML = text;
}


 
  
