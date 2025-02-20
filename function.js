//-----PREVENT-SUBMIT----------
  $(document).ready(function(){

$('.book').change(function (){  
   var po=this.id;
   var s=po.split('_');
  const cin=new Date($('#cin').val());
  const cout =new Date($('#cout').val());
  const today = new Date();
today.setHours(1,0,0,0);
   cin.getTime();
   cout.getTime();
   today.getTime();

  let a= cout - cin;
  // console.log(a);
   if ( a < 0 || cout < cin ||cin <today) {
     window.alert('please select a valid date');
    $(this).val("");
  } 
 else{
  const diffDays = Math.ceil(a / (1000 * 60 * 60 * 24)); 
  // console.log(diffDays,s);
  if( typeof s[1] == 'undefined'){     
     
      shownum(diffDays); 
  }
  else{
   shownum(diffDays,po);
  }
}
});

    $(".dropdown-btn").each(function() {
      $( this ).click(function() { 
      let dropdownContent = this.nextElementSibling;
    if (dropdownContent.className.indexOf("w3-show") == -1) {
      dropdownContent.className += " w3-show";
      this.className += " w3-green";
    } else { 
      dropdownContent.className = dropdownContent.className.replace(" w3-show", "");
      this.className = this.className.replace(" w3-green", "");
    }  
  });
    });

     $('.w3_open').click(function () {
    $("#main").css({'marginLeft':'15%'});
    $("#mySidebar").css({'width':'15%'});
    $("#mySidebar").css({'display':'block'});
    $("#openNav").css({'display':'none'});
  });

  $('.w3_close').click(function () {
    $("#main").css({'marginLeft':'0%'});
    $("#mySidebar").css({'display':'none'});
    $("#openNav").css({'display':'block'});
  });
  
    $("form#profile").submit(function(e) {
      e.preventDefault();
      //-----CHANGE-PROFILE-PICTURE----------
      var pre=$('#img').attr('src');
      console.log(pre);
      let formData = new FormData(this);
        $.ajax({
           url:$(this).attr('action'),
           type:'post',
           data:{formData,pre},
           enctype:$(this).attr('enctype'),//not neccesary
           cache: false,
           contentType: false,
          processData: false
         
      }).done(function(response){alert(response);$('.profileimg').attr('src',response);
    }).fail(function(response){alert('failed to submit')});
    });

      
    //-----SUBMIT-FORMS-APART-FROM-PROFILE----------     
    $("form").submit(function(e) {
    e.preventDefault();

    var formData = new FormData(this);
            $.ajax({
               url:$(this).attr('action'),
               type:'post',
               data:formData,
               enctype:$(this).attr('enctype'),//not neccesary
               cache: false,
               contentType: false,
              processData: false
               
            }).done(function( data){
              var res=$.parseJSON(data);

              alert( res.alert);
              window.location.replace(res.url);
            }).fail(function(response){alert('failed to submit')});
        
});
   
    //-------------------------DYNAMIC INPUT FORM-----------------------------------
    $("#addRow").click(function () {
 let ind = parseInt($('#indx').val()) + 1;

    var clone = $('#room').clone(true).appendTo('#newRow');
    clone.find('[id*="rtype"]').attr({"id":"rtype_"+ind+"","name":"room["+ind+"][rtype]"}).find('option[value=""]').prop({'selected':true});
    clone.find('[id*="numr"]').attr({"id":"numr_"+ind+"","name":"room["+ind+"][numr]"}).empty();
    clone.find('[id*="price"]').attr({"id":"price_"+ind+"","name":"room["+ind+"][price]"}).val("0");
    clone.removeAttr("id");
    $('#indx').val(ind);
       
      });
        // remove row
      $(document).on('click', '#removeRow', function () {
        $(this).closest('.w3-row-padding').remove();
        // $('#indx').val(ind-1);
      });

      $('.roomavail').change(function() {
        var a=$('#sortByStatus').val();
        var d=$("#d").val();
        var c=$("#availrtype").val();
        $.get('sortByStatus.php?avail='+a+'&dateavail='+d+'&availrtype='+c).done(function(response){$('#fm').html(response);
        }).fail(function(response){alert('failed to get room type')});
  });
      $('#rtypetable').click(function() {
        $( '#rtypeView' ).load( 'rtypegrid.php');
        // $.get('rtypegrid.php').done(function(response){$('#rtypeView').html(response);
        // }).fail(function(response){alert('failed to get room type')});
  });
      $('#rtypegrid').click(function() {
        $.get('rtypegrid.php').done(function(response){$('#rtypeView').html(response);
        }).fail(function(response){alert('failed to get room type')});
  });
      $('#roomtable').click(function() {
        $.get('roomgrid.php').done(function(response){$('#roomView').html(response);
        }).fail(function(response){alert('failed to get room type')});
  });
      $('#roomgrid').click(function() {
        $.get('roomgrid.php').done(function(response){$('#roomView').html(response);
        }).fail(function(response){alert('failed to get room type')});
  });
      // $('.editrtype').change(editDate);

    });
//================================================================
  function grtype(rtypeid){
      $('.rtype').each(function(){
              $(this).on('focus',rtype);
              $(this).on('blur',rtype);
              $(this).addClass('book');
            });
      $.ajax({
        url:'getrtype',
        type:'get',
        cache: false,
      }).done(function(response){ $('#rtype_0').html(response);
    if (typeof rtypeid !== "undefined") {
     
        $('#rtype_0  option[value='+rtypeid+']').prop({'selected':true});
       
       }else{
       
       $('#rtype_0  option[value=""]').prop({'selected':true});}
        }).fail(function(response){alert('failed to get room type')});
       
  }

  function  grnum(checkin,checkout,roomid,rtypeid){    
      
      $.ajax({
        url:'geteditrnum.php',
        type:'get',
        data:{cin:checkin,cout:checkout,rid:roomid,rtid:rtypeid},
        cache: false
      }).done(function(response){$('#numr_0').html(response);  

        $('#numr_0 option[value='+roomid+']').prop({'selected':true,'disabled':true});

       }).fail(function(response){alert('failed to get room number')});
        
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

 function shownum(diffDays,s) {
  const b=$('#cin').val();
    const c=$('#cout').val();  
    const ridlen=$('#rid').length; 
    const roomid=$('#rid').val(); 
// console.log("ridlen: "+ridlen);
  if (typeof s === "undefined" && ridlen < 1) {
    $('.rtype').each(function(){
     var str= $(this).val();
     // console.log($(this).closest('.w3-row-padding').find('[id*="price"]').val());
     var price=$(this).closest('.w3-row-padding').find('[id*="price"]');
     var numr=$(this).closest('.w3-row-padding').find('[id*="numr"]'); 
             numr.load( 'getrnum.php',{q:str,r:b,s:c});
             // price.load( 'getprice.php',{str,diffDays});
   
    // $.get('getrnum.php',{q:str,r:b,s:c}).done(function (data) { numr.html(data);}).fail(function (data) {
    //  alert('failed');});
     $.get('getprice.php',{str,diffDays}).done(function (data) {price.val(data);console.log(price.val(data));}).fail(function (data) {
     aler
     t('failed');}); 
     });    
  } 
  else if((typeof s === "undefined" || typeof s !== "undefined") && ridlen > 0){
    const rtypeid=$("#rtype_0").val();
    if (rtypeid=="" || b=="" ||c=="") {
      $("#numr_0").html("");
      $("#price_0").val(0);
      return;
    }
    $("#numr_0").load( 'getrnum.php',{q:rtypeid,r:b,s:c,rid:roomid},function( response, status, xhr ) {
  if ( status == "error" ) {
    var msg = "Sorry but there was an error: ";
    $( "#error" ).html( msg + xhr.status + " " + xhr.statusText );
    return;
  }
  $('#numr_0 option[value='+roomid+']').prop({'disabled':true});

});

    // $.post('getrnum.php',{q:rtypeid,r:b,s:c,rid:roomid}).done(function (data) { $("#numr_0").html(data);
    //    $('#numr_0 option[value='+roomid+']').prop({'disabled':true});}).fail(function (data) {alert('failed');});
    // $.get('geteditrnum.php',{cin:b,cout:c,rid:roomid,rtid:rtypeid}).done(function (data) { $("#numr_0").html(data);
       // $('#numr_0 option[value='+roomid+']').prop({'disabled':true});}).fail(function (data) {alert('failed');});
     $.post('getprice.php',{str:rtypeid,diffDays}).done(function (data) {$("#price_0").val(data);}).fail(function (data) {
     alert('failed');});
  } 
  else if(typeof s !== "undefined" && ridlen < 1) {
    const str=$("#"+s+"").val();
     var price=$("#"+s+"").closest('.w3-row-padding').find('[id*="price"]');
     var numr=$("#"+s+"").closest('.w3-row-padding').find('[id*="numr"]');
    if (str=="" || b=="" || c=="") {
      numr.html("");
      price.val(0);
      return;
    }
    numr.load( 'getrnum.php',{q:str,r:b,s:c});

    // $.post('getrnum.php',{q:str,r:b,s:c}).done(function (data) { numr.html(data);}).fail(function (data) {
    //  alert('failed');});
     $.post('getprice.php',{str,diffDays}).done(function (data) {price.val(data);}).fail(function (data) {
     alert('failed');});

   }else{
    alert('error!:not successful')
   }
 }

//----------------------SORT-BOOKING-BY-DATE------
  function booksort() {
     const b=$('#from').val();
     const c =$('#to').val();
    $.get('bookdatesort.php',{b,c}).done(function (data) { $("#example23").html(data);}).fail(function (data) {
     alert('failed');});
  }

   function rtype() {
      var array=[]; 
$('.rtype').not(this).each(function(){array.push($(this).val())});
// console.log(array);
     $(this).children().each(function(){ 
      // console.log(this.innerText);
      // console.log($(this).children().nodeType+" in "+array+"="+ $.inArray($(this).prop('value'),array));
      var exist=$.inArray($(this).prop('value'),array);
      // var exist=array.indexOf($(this).prop('value'));
      if(exist === -1 ) {
        $(this).css('display','block');} 
      else {
        $(this).css('display','none');
      } });
  }


//----------------------------------------------------------------------
  // function rtype() {
    
  //   var selectAllByClass= document.getElementsByClassName('rtype') ;
  //   var csc=document.getElementById(this.id).children;
  //   var array=[];
  //   for (var m = 0; m < csc.length; m++) {
  //     array.push(csc[m].value);
  //   }

  //   for (var q = 0; q < selectAllByClass.length; q++) {
  //     var x = selectAllByClass[q].isSameNode(document.getElementById(this.id));
 
  //     var h= array.indexOf(selectAllByClass[q].value)
  //     if ((x===true)&&((h !== -1)||(h === -1))) {
  //      continue;
  //     }else if( (h !== -1) && (x===false)){
       
  //       if (csc[h].style.display ==='none') {
  //         csc[h].style.display='block';
  //       } else {
  //         csc[h].style.display='none';
  //       }
        
  //     }else if( (h === -1) && (x===false)){
        
  //         //document.getElementById('6').innerHTML +=' '+ selectAllByClass[q].value;   
  //     }
  //     else{
  //       alert('sum went wrong');
  //     }
  //   }
  // }


//   function editDate(){
//    const cin=new Date($('#cin').val());
//   const cout =new Date($('#cout').val());
//   const today = new Date();
// today.setHours(1,0,0,0);
//    cin.getTime();
//    cout.getTime();
//    today.getTime();

//   let a= cout - cin;
//   console.log(a);
//    if ( a < 0 || cout < cin ||cin <today) {
//      window.alert('please select a valid date');
//     $(this).val("");
//   } 
//  else{ 
//   const diffDays = Math.ceil(a / (1000 * 60 * 60 * 24)); 
//   console.log(diffDays);
//   showRnum(diffDays);
// }
  
   
  // }
 
  // function showRnum(diffDays) {
  //   const rtypeid=$("#rtype_0").val();
  //   const checkin=$('#cin').val();
  //   const checkout=$('#cout').val();
  //   const roomid=$('#rid').val();
  //   if (rtypeid=="" || checkin=="" ||checkout=="") {
  //     $("#numr").html("");
  //     $("#price").val(0);
  //     return;
  //   }
  //   $.get('geteditrnum.php',{cin:checkin,cout:checkout,rid:roomid,rtid:rtypeid}).done(function (data) { $("#numr_0").html(data);
  //      $('#numr_0 option[value='+roomid+']').prop({'disabled':true});

  // }).fail(function (data) {
  //    alert('failed');});
  //    $.get('getprice.php',{str:rtypeid,diffDays}).done(function (data) {$("#price_0").val(data);}).fail(function (data) {
  //    alert('failed');});
   
  // }


//----------------------VALDATE-DATE--------------------
//----------------------GET AVAILABLE ROOM NUMBER BASED ON DATE------
  // function shownumr(diffDays,s) {
    
  
  //   const str=$("#rtype_"+s+"").val();
  //   const b=$('#cin').val();
  //   const c=$('#cout').val();
  //   if (str=="" || b=="" || c=="") {
  //     $("#numr_"+s+"").html("");
  //     $("#price_"+s+"").val(0);
  //     return;
  //   }
  //   $.get('getrnum.php',{q:str,r:b,s:c}).done(function (data) { $("#numr_"+s+"").html(data);}).fail(function (data) {
  //    alert('failed');});
  //    $.get('getprice.php',{str,diffDays}).done(function (data) {$("#price_"+s+"").val(data);}).fail(function (data) {
  //    alert('failed');});
  //  }



//    $('.book').change(function (){
  
//    var po=this.id;
//    var s=po.split('_');
//   const cin=new Date($('#cin').val());
//   const cout =new Date($('#cout').val());
//   const today = new Date();
// today.setHours(1,0,0,0);
//    cin.getTime();
//    cout.getTime();
//    today.getTime();

//   let a= cout - cin;
//   console.log(a);
//    if ( a < 0 || cout < cin ||cin <today) {
//      window.alert('please select a valid date');
//     $(this).val("");
//   } 
//  else{
//   const diffDays = Math.ceil(a / (1000 * 60 * 60 * 24)); 
//   console.log(diffDays,s);
//   if( typeof s[1] == 'undefined'){
     
//   $('.rtype').each(function(){
//     var po=this.id;
//    var s=po.split('_');
//       shownumr(diffDays,s[1]);
//   });  
//   }
//   else{
//    shownumr(diffDays,s[1]);
//   }
// }
// });

