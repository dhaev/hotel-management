//------------------SERIALIZATION-METHOD-------------------------------------    
 
      $(document).ready(function(){
         $('form').submit(function(e){
            event.preventDefault();
            var form=$(this);
            $.ajax({
               url:'inc/add_customer.php',
               type:'post',
               data:form.serialize()
            }).done(function(data){alert('successful')}).fail(function(data){alert('failed')});
         });
      });
   
//------------------JQUERY-AJAX($.AJAX)-METHOD-------------------------------------   
         
      $(document).ready(function(){
         $('form').submit(function(e){
            event.preventDefault();
            
            $.ajax({
               url:'inc/add_customer.php',
               type:'post',
               data:{

                  fname:$('#fname').val(),
                  lname:$('#lname').val(),
                  email:$('#email').val(),
                  phone:$('#phone').val(),
                  address:$('#address').val(),
                  country:$('#country').val(),
                  city:$('#city').val(),
                  pwd:$('#pwd').val(),
                  rpwd:$('#rpwd').val()
               }
            }).done(function(data){alert('successful')}).fail(function(data){alert('failed')});
         });
      });  

//------------------JQUERY-AJAX($.POST)-METHOD-------------------------------------         
      $(document).ready(function(){
         $('form').submit(function(e){
            event.preventDefault();
            
            $.post('inc/add_customer.php',
               {
                  fname:$('#fname').val(),
                  lname:$('#lname').val(),
                  email:$('#email').val(),
                  phone:$('#phone').val(),
                  address:$('#address').val(),
                  country:$('#country').val(),
                  city:$('#city').val(),
                  pwd:$('#pwd').val(),
                  rpwd:$('#rpwd').val()
               }
            ).done(function(data){alert('successful')}).fail(function(data){alert('failed')});      
         });
      });
      
 //-----------------------------------------------------------------------------------------


   function showimg(){
      $(document).ready(function(){ 
      var upimg = $('#file').val();
      var formData = new FormData();
      formData.append('file',upimg);  
            $.ajax({
               url:'inc/showimg.php',
               type:'GET',
               data:formData,
               enctype: 'multipart/form-data',
               cache: false,
               contentType: false,
              processData: false
               
            }).done(function(imgsrc){alert('jhjjk')}).fail(function(imgsrc){alert('failed')});
         });
   }


   function showimg(){
      $(document).ready(function(){ 
      var upimg = $('#file').val();
      var formData = new FormData();
      formData.append('file',upimg);  
            $.ajax({
               url:'inc/showimg.php',
               type:'post',
               data:formData,
               enctype: 'multipart/form-data',
               cache: false,
               contentType: false,
              processData: false
               
            }).done(function(imgsrc){window.location = "inc/showimg.php";}).fail(function(imgsrc){alert('failed')});
         });
   }


//===================xmlhhtprequest-working==============================================
 function showimg(){
      
      var formData = new FormData();
      formData.append("file", file.files[0]); 
   
      var xmlhttp=new XMLHttpRequest();
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("img").setAttribute("src", this.responseText);
    }
  }
xmlhttp.open("POST", "inc/showimg.php");
xmlhttp.send(formData);
        
   }
//=================SUBMIT=SHORT==================================
$("form#data").submit(function(e) {
    e.preventDefault();
    var formData = new FormData(this);    

    $.post($(this).attr("action"), formData, function(data) {
        alert(data);
    });
});
//===================================================================
function showUser(str) {
   const x=new Date($('#cin').val());
  const y =new Date($('#cout').val());
  if (str=="" || y==''|| x=='') {
    $("#rnum").html="";
    return;
  }
  $.get('getuser.php',{q:str,r:x,s:y}).done(function (data) { $("#rnum").html(data);}).fail(function (data) {
   alert('failed');});
}

//----------------------VALDATE-CHECK-IN DATE--------------------
  function checkinDate(){
   const x=new Date($('#cin').val());
  const y =new Date($('#cout').val());
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
    $('#cin').val(z);
  }
  //-------------------yet to confirm if working
  const b=$('#cin').val();
  const c =$('#cout').val();
  const str=$('#rtype').val();
  console.log(b);console.log(c);console.log(str);
  if (str=="" || b=='' || c=='') {
    $("#rnum").html("");
    return;
  }
  
 $.get('getuser.php',{q:str,r:b,s:c}).done(function (data) { $("#rnum").html(data);}).fail(function (data) {
   alert('failed');});

  }

//----------------------VALDATE-CHECK-OUT DATE--------------------
  function checkoutDate(){
   const x=new Date($('#cin').val());
  const y =new Date($('#cout').val());
   x.setHours(16);
   y.setHours(16);
   //const diffTime = b.getTime() - a.getTime(); -----------------------------------
   const diffTime = y.getTime() - x.getTime();
   const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)); 
  console.log(diffDays);

   if (diffTime < 1) { //or diffDays
    window.alert('please select a valid date');
    $('#cout').val('');;
   }

//-------------------yet to confirm if working
  const b=$('#cin').val();
  const c =$('#cout').val();
  const str=$('#rtype').val();
  console.log(b);
  console.log(c);
  console.log(str);
  if (str=="" || b==''|| c=='') {
    $("#rnum").html("");
    return;
  }
  
$.get('getuser.php',{q:str,r:b,s:c}).done(function (data) { $("#rnum").html(data);}).fail(function (data) {
   alert('failed');});

  }