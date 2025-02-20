//-----PREVENT-SUBMIT----------
  $(document).ready(function(){ 
  
    $("form#profile").submit(function(e) {
      e.preventDefault();
      //-----CHANGE-PROFILE-PICTURE----------
      let formData = new FormData(this);
        $.ajax({
           url:$(this).attr('action'),
           type:'post',
           data:formData,
           enctype:$(this).attr('enctype'),//not neccesary
           cache: false,
           contentType: false,
          processData: false
         
      }).done(function(response){alert('updated');$('.profileimg').attr('src',response);}).fail(function(response){alert('failed to submit')});
    });

      
    //-----SUBMIT-FORMS-APART-FROM-PROFILE----------     
    // $("form#form1").submit(function(e) {
    // e.preventDefault();

    // var formData = new FormData(this);
    //         $.ajax({
    //            url:$(this).attr('action'),
    //            type:'post',
    //            data:formData,
    //            enctype:$(this).attr('enctype'),//not neccesary
    //            cache: false,
    //            contentType: false,
    //           processData: false
               
    //         }).done(function(response){
    //          alert(response );}).fail(function(response){alert('failed to submit')});
    //      });

    //=================PROFILE DROP DOWN HIDE================

    $("#dd").css('z-index','1');
    $("#dd").hide();

    $("#img1").mouseover(function(){
      $("#dd").show();
    });
    $(".dropdown").mouseleave(function(){
      $("#dd").hide();
    });
    $("#dd").hover(function(){
      $(this).show();
    });
    $("#dd").mouseleave(function(){
      $(this).hide();
    });
    //-------------------------DYNAMIC INPUT FORM-----------------------------------
    $("#addRow").click(function () {
      let ind = parseInt($('#indx').val()) + 1;
      let html = '';

      html += '<div class="w3-row-padding">';

      html += '<div class="w3-half">';
      html += '<p><label class=" w3-padding-large ">Room Type</label>';
      html += '<select class="w3-select  w3-round-xxlarge w3-padding-large rtype " type="text" id="rtype'+ind+'" name="room['+ind+'][rtype]" required></select></p> ';             
      html += ' </div>';

      html += '<div class="w3-half">';
      html += '<p><label class=" w3-padding-large ">no of rooms</label>';
      html += '<select class="w3-select w3-round-xxlarge w3-padding-large"  type="text"  name="room['+ind+'][num]" id="rnum'+ind+'" required></select></p> ';             
      html += ' </div>';

      html +='<div class="w3-half">';
      html += '<p><label class=" w3-padding-large ">price</label>';
      html += '<input class="w3-input w3-round-xxlarge w3-padding-large"   type="text"  name="room['+ind+'][price]" id="price'+ind+'"  placeholder="price..." value="0" ></p>';
      html += ' </div>';
      
      html +='<div class="w3-half">';
      html += '<div class="input-group-append">';
      html += '<button id="removeRow" type="button" class="btn btn-danger">Remove</button>';
      html += '</div>';

      html += '</div>';

      $('#newRow').append(html);
        $('#indx').val(ind);
        $.ajax({
          url:'getrtype',
          type:'get',
          cache: false,
          contentType: false,
          processData: false
        }).done(function(response){
            const selectAllByClass= document.getElementsByClassName('rtype') ;
            for (var sac = 0; sac < selectAllByClass.length; sac++) {
              selectAllByClass[sac].addEventListener("focus",rtype);
              selectAllByClass[sac].addEventListener("blur",rtype);
              selectAllByClass[sac].addEventListener("change",CheckDate);
            }
            $('#rtype'+ind+'').html(response);}).fail(function(response){alert('failed to get room type')});   

      });
        // remove row
      $(document).on('click', '#removeRow', function () {
        $(this).closest('.w3-row-padding').remove();
        $('#indx').val(ind-1);
      });
  });

//================================================================
  function grtype(u){
    
      const selectAll= document.getElementsByClassName('rtype') ;
      for (var sa = 0; sa < selectAll.length; sa++) {
        selectAll[sa].addEventListener("focus",rtype);
        selectAll[sa].addEventListener("blur",rtype);
        selectAll[sa].addEventListener("change",CheckDate);
        } 
      $.ajax({
        url:'getrtype',
        type:'get',
        cache: false,
        contentType: false,
        processData: false
      }).done(function(response){$('#rtype0').html(response);
    if (u !=="") {
        $('#rtype0 option:contains('+u+')').prop('selected',true);
        // $('#test').val(u);
       } }).fail(function(response){alert('failed to get room type')});
       
        
        
  }
    
//-----DISPLAY-IMAGE-PREVIEW----------
  function showimg(){
      $(document).ready(function(){ 
      var formData = new FormData();
      formData.append("file", file.files[0]);
            $.ajax({
               url:'inc/showimg.php',
               type:'post',
               data:formData,
               enctype: 'multipart/form-data',//not neccesary
               cache: false,
               contentType: false,
              processData: false
               
            }).done(function(imgsrc){$('#img').attr('src',imgsrc);}).fail(function(imgsrc){alert('failed to get img file')});
         });
    }
//----------------------GET AVAILABLE ROOM NUMBER BASED ON DATE------
  function showRnum(diffDays,s) {
    const str=$("#rtype"+s+"").val();
    const b=$('#cin').val();
    const c=$('#cout').val();
    if (str=="" || b=="" || c=="") {
      $("#rnum"+s+"").html("");
      $("#price"+s+"").val(0);
      return;
    }
    $.get('getrnum.php',{q:str,r:b,s:c}).done(function (data) { $("#rnum"+s+"").html(data);}).fail(function (data) {
     alert('failed');});
    $.get('getprice.php',{str,diffDays}).done(function (data) {$("#price"+s+"").val(data);}).fail(function (data) {
     alert('failed');});
   
  }


//----------------------VALDATE-DATE--------------------
  function CheckDate(){
  
   var po=this.id;
   var s=po.slice(-1);
  const x=new Date($('#cin').val());
  const y =new Date($('#cout').val());
  const z = new Date();

  x.setHours(16);
  y.setHours(16);

   x.getTime()
   y.getTime()
   z.getTime()

  const a= y - x;
 //const w= z- x;
  console.log(a);
  //  if ( x<z || a < 1) {
  //    window.alert('please select a valid date');
    
  // } 
  const diffDays = Math.ceil(a / (1000 * 60 * 60 * 24)); 
  console.log(diffDays);
  //price(diffDays);
  showRnum(diffDays,s);
   
  }



//----------------------SORT-BOOKING-BY-DATE------
  function booksort() {
     const b=$('#from').val();
     const c =$('#to').val();
    $.get('bookdatesort.php',{b,c}).done(function (data) { $("#example23").html(data);}).fail(function (data) {
     alert('failed');});
  }

//----------------------VALDATE-CHECK-IN DATE--------------------
  function sortCheckinDate(){
  const x=new Date($('#from').val());
  const y =new Date($('#to').val());

   x.setHours(16);
   y.setHours(16);

   x.getTime()
   y.getTime()
   
  const a= y - x;

  console.log(a);
   if ( a < 0) {
     window.alert('please select a valid date');
    $('#from').val('');
  }
  booksort();
  
  }

  //----------------------VALDATE-CHECK-OUT DATE--------------------
  function checkoutDate(){
   const x=new Date($('#cin').val());
  const y =new Date($('#cout').val());
   x.setHours(16);
   y.setHours(16);
   
   const diffTime = y.getTime() - x.getTime();
   const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)); 
  console.log(diffDays);

   if (diffTime < 1) { //or diffDays
    window.alert('please select a valid date');
    $('#from').val('');;
   }
  booksort();
  }


  function checkDate(){
    const x=new Date($('#from').val());
  //  const y =new Date($('#cout').val());
    const z = new Date();
  $('#a').html(x);
  //$('#b').val(y);
  $('#c').html(z);
     x.setHours(16);
   //  y.setHours(16);

     $('#d').html(x);
  //$('#e').val(y);

     x.getTime()
     y.getTime()
     z.getTime()
     $('#f').html(x);
  //$('#g').val(y);
  $('#h').html(z);

    }
//============================
  function w3_open() {
    document.getElementById("main").style.marginLeft = "20%";
    document.getElementById("mySidebar").style.width = "20%";
    document.getElementById("mySidebar").style.display = "block";
    document.getElementById("openNav").style.display = 'none';
  }

  function w3_close() {
    document.getElementById("main").style.marginLeft = "0%";
    document.getElementById("mySidebar").style.display = "none";
    document.getElementById("openNav").style.display = "inline-block";
  }
//----------------------------------------------------
  function myAccFunc() {
    let x = document.getElementsByClassName("dropdown-btn");
    let i;

  for (i = 0; i < x.length; i++) {
    x[i].addEventListener("click", function() {
       
      let dropdownContent = this.nextElementSibling;
    if (dropdownContent.className.indexOf("w3-show") == -1) {
      dropdownContent.className += " w3-show";
      this.className += " w3-green";
    } else { 
      dropdownContent.className = dropdownContent.className.replace(" w3-show", "");
      this.className = this.className.replace(" w3-green", "");
    }
  });
  }
  }

//---------------------------------------------------------------
  function myFunction() {
    var x = document.getElementById("Demo");
    if (x.className.indexOf("w3-show") == -1) {
      x.className += " w3-show";
    } else { 
      x.className = x.className.replace(" w3-show", "");
    }
  }

//-----------------------------------------------------------------------



  
//----------------------------------------------------------------------
  function rtype() {
    
    var selectAllByClass= document.getElementsByClassName('rtype') ;
    var csc=document.getElementById(this.id).children;
    var array=[];
    for (var m = 0; m < csc.length; m++) {
      array.push(csc[m].value);
    }

    for (var q = 0; q < selectAllByClass.length; q++) {
      var x = selectAllByClass[q].isSameNode(document.getElementById(this.id));
 
      var h= array.indexOf(selectAllByClass[q].value)
      if ((x===true)&&((h !== -1)||(h === -1))) {
       continue;
      }else if( (h !== -1) && (x===false)){
       
        if (csc[h].style.display ==='none') {
          csc[h].style.display='block';
        } else {
          csc[h].style.display='none';
        }
        
      }else if( (h === -1) && (x===false)){
        
          document.getElementById('6').innerHTML +=' '+ selectAllByClass[q].value;   
      }
      else{
        alert('sum went wrong');
      }
    }
  }