//-----PREVENT-SUBMIT----------
  $(document).ready(function(){
   $('.w3_open').click(function () {
    $("#main").css({'marginLeft':'15%'});
    $("#mySidebar").css({'width':'15%'});
    $("#mySidebar").css({'display':'block'});
  });

  $('.w3_close').click(function () {
    $("#headbar").css({'marginLeft':'0%'});
    $("#main").css({'marginLeft':'0%'});
    $("#mySidebar").css({'display':'none'});
   
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

    document.getElementsByClassName('imageForm').addEventListener('change', function() {
      var imageForm = getElementsByClassName('imageForm');
      var formData = new FormData(imageForm);
      var actionUrl = imageForm.getAttribute('action'); // Assuming the image upload URL is 'inc/profile_image.php'
  
      fetch(actionUrl, {
        method: 'POST',
        body: formData
      })
      .then(response => response.text())
      .then(data => {
        console.log(data); // Handle the response from the server
        // Optionally, you can show a success message or update the image preview
      })
      .catch(error => {
        console.error('Error:', error);
      });
    });
  
    // Handle text data form submission
    document.getElementsByClassName('textForm').addEventListener('submit', function(event) {
      event.preventDefault(); // Prevent the default form submission
      var textForm = document.getElementsByClassName('textForm');
      var formData = new FormData(textForm);
      var actionUrl = textForm.getAttribute('action'); // Assuming the text data URL is 'inc/profile_text.php'
  
      fetch(actionUrl, {
        method: 'POST',
        body: formData
      })
      .then(response => response.text())
      .then(data => {
        console.log(data); // Handle the response from the server
        // Optionally, you can show a success message
      })
      .catch(error => {
        console.error('Error:', error);
      });
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
//     $("form").submit(function(e) {
//     e.preventDefault();

//     var formData = new FormData(this);
//             $.ajax({
//                url:$(this).attr('action'),
//                type:'post',
//                data:formData,
//                enctype:$(this).attr('enctype'),//not neccesary
//                cache: false,
//                contentType: false,
//               processData: false
               
//             }).done(function( data){
//               var res=$.parseJSON(data);

//               alert( res.alert);
//               window.location.replace(res.url);
//             }).fail(function(response){alert('failed to submit')});
        
// });
   


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

    // Fetch room types and populate dropdowns


    });



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
    
function showimg() {
  var file = document.getElementById('file').files[0];
  if (file) {
      var reader = new FileReader();
      reader.onload = function(e) {
          var img = document.getElementById('img');
          var preview = document.getElementById('preview');
          preview.src = e.target.result;
      }
      reader.readAsDataURL(file);
  }
}

function showEditMenu() {
  document.getElementById('view_menu').style.display = 'none';
  document.getElementById('edit_menu').style.display = 'block';
}

function cancelUpload() {
  var img = document.getElementById('img');
  var preview = document.getElementById('preview');
  var fileInput = document.getElementById('file');
  fileInput.value = '';
  preview.src = img.src;
  document.getElementById('view_menu').style.display = 'block';
  document.getElementById('edit_menu').style.display = 'none';
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

  function fetchRoomTypes() {
    $.ajax({
      url: 'api/getRoomTypes.php',
      type: 'GET',
      dataType: 'json',
      success: function(data) {
        window.roomTypes = data;
        populateRoomTypes();
      },
      error: function() {
        alert('Failed to fetch room types');
      }
    });
  }

  function populateRoomTypes(index = 0) {
    var roomTypeSelect = $(`#rtype_${index}`);
    roomTypes.forEach(function(roomType) {
      var option = $('<option>', {
        value: roomType.RtypeID,
        text: roomType.rtype
      });
      roomTypeSelect.append(option);
    });
  }

  function updatePrice(target) {
    var row = $(target).closest('.room-row');
    var roomTypeSelect = row.find('.rtype');
    var numRoomsInput = row.find('.numr');
    var priceInput = row.find('.price');

    var selectedRoomType = roomTypes.find(function(roomType) {
      return roomType.RtypeID == roomTypeSelect.val();
    });

    var checkinDate = new Date($('#cin').val());
    var checkoutDate = new Date($('#cout').val());

    if (selectedRoomType && numRoomsInput.val() && checkinDate && checkoutDate && !isNaN(checkinDate) && !isNaN(checkoutDate)) {
      var pricePerRoom = selectedRoomType.price;
      var numRooms = numRoomsInput.val();
      var timeDiff = Math.abs(checkoutDate - checkinDate);
      var numDays = Math.ceil(timeDiff / (1000 * 60 * 60 * 24));
      var totalPrice = pricePerRoom * numRooms * numDays;
      priceInput.val(totalPrice);
    } else {
      priceInput.val(0);
    }
  }

