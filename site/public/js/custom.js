




// Owl Carousel Start..................



$(document).ready(function(){
    var one = $("#one");
    var two = $("#two");

    $('#customNextBtn').click(function() {
        one.trigger('next.owl.carousel');
    })
    $('#customPrevBtn').click(function() {
        one.trigger('prev.owl.carousel');
    })
    one.owlCarousel({
        autoplay:true,
        loop:true,
        dot:true,
        autoplayHoverPause:true,
        autoplaySpeed:100,
        margin:10,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:2
            },
            1000:{
                items:4
            }
        }
    });

    two.owlCarousel({
        autoplay:true,
        loop:true,
        dot:true,
        autoplayHoverPause:true,
        autoplaySpeed:100,
        margin:10,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:1
            },
            1000:{
                items:1
            }
        }
    });


});




// Owl Carousel End..................







/* Contact Data Send or Insert on Database */

$('#contactSendBtnId').click(function(){

  var ContactName = $('#contactNameId').val();
  var ContactMobile = $('#contactMobileId').val();
  var ContactEmail = $('#contactEmailId').val();
  var ContactMsg = $('#contactMsgId').val();

   var url = '/contactSend';
   var data = {
      contact_name : ContactName,
      contact_mobile : ContactMobile,
      contact_email : ContactEmail,
      contact_msg : ContactMsg
   
    };


         if( ContactName.length == 0) {

             $('#contactSendBtnId').html('আপনার নাম লিখুন ।');
             setTimeout(function(){
                 $('#contactSendBtnId').html('পাঠিয়ে দিন');
             },2000);

         }else if(ContactMobile.length == 0) {

             $('#contactSendBtnId').html('আপনার মোবাইল নং লিখুন ।');
             setTimeout(function(){
                $('#contactSendBtnId').html('পাঠিয়ে দিন');
              },2000);

         }else if(ContactEmail.length == 0) {

             $('#contactSendBtnId').html('আপনার ইমেইল লিখুন ।');
             setTimeout(function(){
                $('#contactSendBtnId').html('পাঠিয়ে দিন');
             },2000);

         }else if(ContactMsg.length == 0) {
              
             $('#contactSendBtnId').html('আপনার মেসেজ লিখুন ।');
             setTimeout(function(){
                $('#contactSendBtnId').html('পাঠিয়ে দিন');
             },2000);

         }else {

            $('#contactSendBtnId').html('পাঠানো হচ্ছে...');

                axios.post(url, data)
               .then(function(response) {

                if (response.status == 200) {

                       if(response.data ==1) {

                          $('#contactSendBtnId').html('অনুরোধ সফল হয়েছে');
                          $('.inputDataReset').val(null);
                          setTimeout(function(){
                            $('#contactSendBtnId').html('পাঠিয়ে দিন');
                          },3000);                    
                       
                       }else {
        
                            $('#contactSendBtnId').html('অনুরোধ ব্যার্থ হয়েছে ! আবার চেষ্টা করুন');
                             setTimeout(function(){
                             $('#contactSendBtnId').html('পাঠিয়ে দিন');
                            },3000);   

                        }
        
                } else {
            
                    $('#contactSendBtnId').html('অনুরোধ ব্যার্থ হয়েছে ! আবার চেষ্টা করুন');
                    setTimeout(function(){
                    $('#contactSendBtnId').html('পাঠিয়ে দিন');
                   },3000);  

                }
        
               })
               .catch(function(error) {

                    $('#contactSendBtnId').html('আবার চেষ্টা করুন');
                    setTimeout(function(){
                    $('#contactSendBtnId').html('পাঠিয়ে দিন');
                    },3000);  
            
               });


        } /* else ended */


});



