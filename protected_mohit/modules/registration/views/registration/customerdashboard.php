<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/customerstyle.css" rel="stylesheet" type="text/css" media="all" />

<script>

$(document).ready(function(){
  
// validate password
 // validate signup form on keyup and submit
         //setInterval(function(){chkRelistJobActiveTab();}, 5000);
       
      


      $( "#datepicker" ).datepicker({
                minDate: 0,
      
        });

       /*relist ajaxk call*/

       $(".relist").live('click',function(){
               var loggedId    ="<?php echo Yii::app()->session['loggedId'];?>";
               var bookingId=$(this).attr('id');
                $.ajax({
                               type: 'POST',
                                url: '<?php echo Yii::app()->createAbsoluteUrl("registration/registration/relist"); ?>',
                               //data:{'data':data,'email':email},
                               data:{'bookingId':bookingId,'loggedId':loggedId},
                            success:function(data){

                                           //alert(data);
                                           $('.prev'+bookingId).hide();
                                           //location.reload();  
                                           //$('.a'+id).hide();
                                          
                                          },
                               error: function(data) { // if error occured
                                    // alert(data);
                                     return false;
                                },
                             
                              dataType:'html'
                    });    

       });

      /*onload show the inbox tab*/

      $("#messages").show();
      $("#sentbox").hide();
       
      $("#inbox").click(function(){
             
              $("#messages").show();
              $("#sentbox").hide();
           
      });  
      
      $("#sent").click(function(){
             
              $("#messages").hide();
              $("#sentbox").show();
           
      });
     
     $("#choose-inbox").click(function(){
        
           $("#messages").show();
            $("#sentbox").hide();
       });

      /*onload hide review div*/
      $(".hidenDiv").hide();

      /*show review div on click*/
      $(".endJob").live('click',function(){
 
            var id=$(this).attr('id');
            $('.hidenDiv').hide();
            $(".quotes").hide();
            $("#customermsglist"+id).hide();   
            $('#md-'+id).show();

            document.getElementById('mk').value=id;
           
      });

     
       /*show message in div*/
       $(".message").click(function(){

             var id=$(this).attr('id');
             $(".detailmsg"+id).toggle();
       });

      /*hide review div on cancel click*/
      $(".cancel").click(function(){
         
           var id=$(this).attr('id');
           $('#md-'+id).hide();
           $('.text'+id).css({

                    "border": "",

                    "background": ""

                });
      }); 
       
       /*code for edit job on click*/
       $('.search_outer').hide();
       $('.same').hide();
       $(".editJob").click(function(){
           
             var bookId=$(this).attr('id');
             $('#edit'+bookId).toggle();

             var type=$(".serviceType").val();
             
              $(".serviceType").change(function(){
                   
                   var type=$(this).val();
                   //alert(type)
                   if(type==3)
                   {
                      $('.same').show();
                   }
                   else{
                   	 $('.same').hide();
                   }   
              });      
             //alert(bookId);
                   
       });  
       
       /*chnage get divs like desk,property*/
       


        $(".stepper-button-up").click(function(){
            var id=$(this).closest('.controlHolder').find("input[type='text']").attr('id');
             
             var val=$(this).closest('.controlHolder').find("input[type='text']").attr('value');
             
             if(id=='Booking_Bedrooms' || id=='Booking_Bathrooms')
             {
                if(val==10)
                return false; 
             } 
             //var value = parseInt($("#"+id).val(), 10) + 1;
             var value = parseInt(val) + 1;
             //alert(value);

             $(this).closest('.controlHolder').find("input[type='text']").val(value);
                
    });

     $(".stepper-button-down").click(function(){

             var id=$(this).closest('.controlHolder').find("input[type='text']").attr('id');
      
             var val=$(this).closest('.controlHolder').find("input[type='text']").attr('value');
             if (val == 0)
             { 
              return false; 
             }
             else
             {
                var value = parseInt(val) - 1;
                $(this).closest('.controlHolder').find("input[type='text']").val(value);
             }  
     });
        /*reply to message*/
      $(".sndmsg").live('click',function(){

          var loggedId    ="<?php echo Yii::app()->session['loggedId'];?>";
          //var receiverId  ="<?php echo $msg->sender_id;?>";
          var replysectionBookingId=$('.replysection').attr('id');
           var sendIds  =$(this).attr('id');
           
           var res       =sendIds.split('-');
           var id        =res[0];
           var receiverId=res[1];       
           //alert(id);

           var subject   =$('.subject'+id).val();
           //alert(subject);           
           //alert(receiverId) 
           
           var text=$.trim($(".text"+id).val());

           if(text=='')
           { 
                  $(".text"+id).css({

                    "border": "1px solid red",

                    "background": "#FFCECE"

                });
                  return false;

           }
           else
           {
                  //alert(text);
                   $(".text"+id).css({

                    "border": "",

                    "background": ""

                });


                $.ajax({
                               type: 'POST',
                                url: '<?php echo Yii::app()->createAbsoluteUrl("registration/registration/replyfromCustomer"); ?>',
                               //data:{'data':data,'email':email},
                               data:{'conversionId':id,'loggedId':loggedId,'receiverId':receiverId,'subject':subject,'text':text,'replysectionBookingId':replysectionBookingId},
                            success:function(data){

                                           //alert(data);
                                           //$(".main").append(data);
                                           $("#"+id).append(data);
                                           $(".text"+id).val(' ');
                                           //$("#Text").val(' ');
                                           //location.reload();  
                                           //$('.a'+id).hide();
                                          
                                          },
                               error: function(data) { // if error occured
                                    // alert(data);
                                     return false;
                                },
                             
                              dataType:'html'
                    });   
           } 

        
      }); 
      

     // code to reply to admin from ticket tab
     $(".ticketsndmsgcutomer").live('click',function(){
              

          var loggedId    ="<?php echo Yii::app()->session['loggedId'];?>";
          //var receiverId  ="<?php echo $msg->sender_id;?>";
          var replysectionBookingId=$('.replysection').attr('id');

           var sendIds  =$(this).attr('id');
           
           var res       =sendIds.split('-');
           var id        =res[0];
           var receiverId=res[1];       
           //alert(id);

           var subject   =$('.subject'+id).val();
           //alert(subject);           
           //alert(receiverId) 
           
           var text=$.trim($(".text"+id).val());
           if(text!='')
           { 

                  $(".text"+id).css({

                    "border": "",

                    "background": ""

                });


                $.ajax({
                               type: 'POST',
                                url: '<?php echo Yii::app()->createAbsoluteUrl("registration/registration/replyticketfromCustomer"); ?>',
                               //data:{'data':data,'email':email},
                               data:{'conversionId':id,'loggedId':loggedId,'receiverId':receiverId,'subject':subject,'text':text,'replysectionBookingId':replysectionBookingId},
                            success:function(data){

                                           //alert(data);
                                           //$(".main").append(data);
                                           $("#"+id).append(data);
                                           //$("#Text").val(' ');
                                           $(".text"+id).val(' ');
                                           //location.reload();  
                                           //$('.a'+id).hide();
                                          
                                          },
                               error: function(data) { // if error occured
                                    // alert(data);
                                     return false;
                                },
                             
                              dataType:'html'
                    });  


                 

           }
           else
           {
                 $(".text"+id).css({

                    "border": "1px solid red",

                    "background": "#FFCECE"

                });
                  return false;      
           } 
     });


     

      $(".sndmsg1").live('click',function(){

          var loggedId    ="<?php echo Yii::app()->session['loggedId'];?>";
          //var receiverId  ="<?php echo $msg->sender_id;?>";
          
           var sendIds  =$(this).attr('id');
           
           var res       =sendIds.split('-');
           var id        =res[0];
           var receiverId=res[1];       
           //alert(id);

           var subject   =$('.subject'+id).val();
           //alert(subject);           
           //alert(receiverId) 
           
           var text=$(".text1"+id).val();
           if(text=='')
           { 
                  $(".text1"+id).css({

                    "border": "1px solid red",

                    "background": "#FFCECE"

                });
                  return false;

           }
           else
           {
                   $(".text1"+id).css({

                    "border": "",

                    "background": ""

                });


                $.ajax({
                               type: 'POST',
                                url: '<?php echo Yii::app()->createAbsoluteUrl("registration/registration/replyfromCustomer"); ?>',
                               //data:{'data':data,'email':email},
                               data:{'conversionId':id,'loggedId':loggedId,'receiverId':receiverId,'subject':subject,'text':text},
                            success:function(data){

                                           //alert(data);
                                           location.reload();  
                                           //$('.a'+id).hide();
                                          
                                          },
                               error: function(data) { // if error occured
                                    // alert(data);
                                     return false;
                                },
                             
                              dataType:'html'
                    });   
           } 

        
      });





       /*delete the checked messages*/
       $(".dlt").click(function(){
            var loggedId    ="<?php echo Yii::app()->session['loggedId'];?>";
             if(confirm('Are you sure you want to delete this?'))
            { 

                      var allVals = [];  
                      $('.message :checked').each(function() {
                         allVals.push($(this).val());
                               
                       });
                     
                     $.ajax({
                             type:'GET',  
                            url:"<?php echo Yii::app()->createUrl('registration/registration/deleteInboxMsgCustomerDashboard')?>",
           
                            data:{'ids':allVals,'loggedId':loggedId},
                             success:function(result)
                             {
                                 //$("#alert success").html(data);
                                //alert(result);
                                location.reload()
                                return true;
                               //alert(result);
                             
                             },
                             error: function (result) {
                              alert("Error.")
                            
                                  return false;
                            }
                       }); 


                      //alert(allVals);
             }         
       }); 

       $(".sentboxdlt").click(function(){

             var loggedId    ="<?php echo Yii::app()->session['loggedId'];?>";
             if(confirm('Are you sure you want to delete this?'))
            { 

                      var allVals = [];  
                      $('.message :checked').each(function() {
                         allVals.push($(this).val());
                               
                       });
                     
                     $.ajax({
                             type:'GET',  
                            url:"<?php echo Yii::app()->createUrl('registration/registration/dltSentboxCustomerDashboard')?>",
           
                            data:{'ids':allVals,'loggedId':loggedId},
                             success:function(result)
                             {
                                 //$("#alert success").html(data);
                                //alert(result);
                                location.reload()
                                return true;
                               //alert(result);
                             
                             },
                             error: function (result) {
                              alert("Error.")
                            
                                  return false;
                            }
                       }); 


                      //alert(allVals);
             }         
       }); 
      
      /*add review on submit click*/
      $(".addreview").click(function(){

             var id=$(this).attr('id');
             
             var text=$(".text"+id).val();

             var rate=$("#rate"+id).val();

             if(rate!='' && text!='')
             { 


                    $.ajax({
                               type: 'POST',
                                url: '<?php echo Yii::app()->createAbsoluteUrl("registration/registration/addreview"); ?>',
                               //data:{'data':data,'email':email},
                               data:{'text':text,'rate':rate,'bookingId':id},
                            success:function(data){


                                           $('.a'+id).hide();
                                          
                                          },
                               error: function(data) { // if error occured
                                     
                                     return false;
                                },
                             
                              dataType:'html'
                    });

          }
          else
          {
                 $('.text'+id).css({

                    "border": "1px solid red",

                    "background": "#FFCECE"

                });

                 return false;

          }  

      }); 

       
     /*create message to company from customer*/
     $("#createmsg").hide();
     $("#create").click(function(){
          //$("#mailbox-inbox").toggle();

          $("#createmsg").toggle();
     });
       
      /*code to decline the request from customer*/
      $('.decline').click(function(){
          var loggedId    ="<?php echo Yii::app()->session['loggedId'];?>"; 
          var id  =$(this).attr('id');
          //$('.req'+id).remove();

          $.ajax({
                               type: 'POST',
                                url: '<?php echo Yii::app()->createAbsoluteUrl("registration/registration/declineNewRequestsCustomer"); ?>',
                               //data:{'data':data,'email':email},
                               data:{'id':id,'loggedId':loggedId},
                            success:function(data){

                                           //alert(data);
                                           $('.req'+id).remove();
                                           //location.reload();  
                                           //$('.a'+id).hide();
                                          
                                          },
                               error: function(data) { // if error occured
                                    // alert(data);
                                     return false;
                                },
                             
                              dataType:'html'
                    }); 

          }); 
      /*code to accpet the job from customer*/
       $('.accept').click(function(){
             var loggedId    ="<?php echo Yii::app()->session['loggedId'];?>";
             var id          =$(this).attr('id');

              $.ajax({
                               type: 'POST',
                                url: '<?php echo Yii::app()->createAbsoluteUrl("registration/registration/statusForNewRequestsCustomer"); ?>',
                               //data:{'data':data,'email':email},
                               data:{'id':id,'loggedId':loggedId},
                            success:function(data){

                                           //alert(data);
                                           $('.req'+id).remove();
                                           //location.reload();  
                                           //$('.a'+id).hide();
                                          
                                          },
                               error: function(data) { // if error occured
                                    // alert(data);
                                     return false;
                                },
                             
                              dataType:'html'
                    }); 


                });



       $("#submit").click(function(){
   
        var isValid = true;

        $('input[type="text"]').each(function() {

            if ($.trim($(this).val()) == '') {

                isValid = false;

                $(this).css({

                    "border": "1px solid red",

                    "background": "#FFCECE"

                });



            }

            else {

                $(this).css({

                    "border": "",

                    "background": ""

                });

            }


            // confirm password
            if($('#password').val() != $('#cpassword').val()) {
            //alert("Password and Confirm Password don't match");
            $("#password").css({

                    "border": "1px solid red",

                    "background": "#FFCECE"

                });
             $("#cpassword").css({

                    "border": "1px solid red",

                    "background": "#FFCECE"

                });
            // Prevent form submission
            return false;
            //event.preventDefault();
        }

        });

        /*if (isValid == false)

            e.preventDefault();

        else

           document.getElementById("dashboard").submit();
         */
    });

     //validate email
     $("#email").blur(function(){
       
         var sEmail = $('#email').val();

        if(abc(sEmail))
        {
           

           return true;
           //alert("Email is correct format");
        } 
        else 
        {
           $("#email").css({

                    "border": "1px solid red",

                    "background": "#FFCECE"

                });
            alert("Email is not correct format.");
           return false;
           
        }


     });  
      // code to view the customer view quotes on the same page

       $('.customerQuotes').click(function(){
                var id=$(this).attr('id');
                $('.hidenDiv').hide();
                $(".quotes").hide();
                $("#customerquote"+id).toggle();  
                $("#customermsglist"+id).hide();          
         }); 
        
       // code to get the msg details in jobs requests tab
       $(".customerMsgDetailRequest").click(function(){
            
             var id=$(this).attr('id');
             //alert(id)
             
             $(".customerMsgDetail2").hide();
             $("#customermsglistReq"+id).toggle();
           
             var loggedId    ="<?php echo Yii::app()->session['loggedId'];?>";
               /*call ajax to get the listing of messages starts here*/
               $.ajax({
                               type: 'POST',
                                url: '<?php echo Yii::app()->createAbsoluteUrl("registration/registration/ActiveJobsCustomerMsgList"); ?>',
                               //data:{'data':data,'email':email},
                               data:{'bookingId':id,'loggedId':loggedId},

                               success:function(data){

                                          // alert(data);
                                           $("#msgrender"+id).html(data);
                                          
                                          
                                          },
                               error: function(data) { // if error occured
                                    // alert(data);
                                     return false;
                                },
                             
                              dataType:'html'
                    });

       });

       // code to get the customer message details
       $(".customerMsgDetail").click(function(){
          
             var id=$(this).attr('id');
             //alert(id)
             $('.hidenDiv').hide();
             $(".quotes").hide();
              $(".customerMsgDetail1").hide();
             $("#customermsglist"+id).toggle();
             $("#customerquote"+id).hide(); 




             var loggedId    ="<?php echo Yii::app()->session['loggedId'];?>";
               /*call ajax to get the listing of messages starts here*/
               $.ajax({
                               type: 'POST',
                                url: '<?php echo Yii::app()->createAbsoluteUrl("registration/registration/ActiveJobsCustomerMsgList"); ?>',
                               //data:{'data':data,'email':email},
                               data:{'bookingId':id,'loggedId':loggedId},

                               success:function(data){

                                          // alert(data);
                                           $("#msgrender"+id).html(data);
                                          
                                          
                                          },
                               error: function(data) { // if error occured
                                    // alert(data);
                                     return false;
                                },
                             
                              dataType:'html'
                    });
       });
        
      // messages listing on ticket tab click
      $(".ticket").click(function(){
            
             var loggedId    ="<?php echo Yii::app()->session['loggedId'];?>";
               /*call ajax to get the listing of messages starts here*/
               $.ajax({
                               type: 'POST',
                                url: '<?php echo Yii::app()->createAbsoluteUrl("registration/registration/TicketCustomerMsgList"); ?>',
                               //data:{'data':data,'email':email},
                               data:{'loggedId':loggedId},

                               success:function(data){

                                          // alert(data);
                                           $("#ticketmsgrender").html(data);
                                          
                                          
                                          },
                               error: function(data) { // if error occured
                                    // alert(data);
                                     return false;
                                },
                             
                              dataType:'html'
                    });



      });

      //code to create the message to admin
      $(".ticketmsg").click(function(){
           
           var id=$(this).attr('id');
           $("#ticketmsglist"+id).toggle();

           var loggedId    ="<?php echo Yii::app()->session['loggedId'];?>";
               /*call ajax to get the listing of messages starts here*/
               $.ajax({
                               type: 'POST',
                                url: '<?php echo Yii::app()->createAbsoluteUrl("registration/registration/TicketCustomerMsgList"); ?>',
                               //data:{'data':data,'email':email},
                               data:{'bookingId':id,'loggedId':loggedId},

                               success:function(data){

                                          // alert(data);
                                           $("#ticketmsgrender"+id).html(data);
                                          
                                          
                                          },
                               error: function(data) { // if error occured
                                    // alert(data);
                                     return false;
                                },
                             
                              dataType:'html'
                    });



      });
      
     // code to open the create message tab to admin
     $('.ticketmsgbtn').click(function(){
        
         var id=$(this).attr('id');
         $("#ticketcrtMsg"+id).toggle();

     }); 

       // code to create the new message here
       $('.msgbtn').click(function(){
             
              var id=$(this).attr('id');
             $("#crtMsg"+id).toggle();
             //$("#msglis"+id).toggle();

             /*var loggedId    ="<?php echo Yii::app()->session['loggedId'];?>";
               //call ajax to get the listing of messages starts here
               $.ajax({
                               type: 'POST',
                                url: '<?php echo Yii::app()->createAbsoluteUrl("registration/registration/ActiveJobsCustomerMsgList"); ?>',
                               //data:{'data':data,'email':email},
                               data:{'bookingId':id,'loggedId':loggedId},

                               success:function(data){

                                          // alert(data);
                                           $("#msgrender"+id).html(data);
                                          
                                          
                                          },
                               error: function(data) { // if error occured
                                    // alert(data);
                                     return false;
                                },
                             
                              dataType:'html'
                    }); */ 
      }); 
});



$(function() {
$( "#tabs" ).tabs();
});
$(function() {
       var js_array = [<?php echo '"'.implode('","', $Post).'"' ?>];

      var availableTags = [];
        $( "#code" ).autocomplete({source: js_array});
});

/*function to send the message to comapny*/
function sendMessage()
 {
  
   var val =$("#ConversationMsg_subject").val();
   var msg =$("#MsgDetails_msg").val();
   //alert(val);return false;
   var data=$("#sendmessage").serialize();
  
  // var email="<?php echo $_SESSION['_registration__id'];?>";
      if(val!='' && msg!='')
       {
           $.ajax({
                       type: 'POST',
                        url: '<?php echo Yii::app()->createAbsoluteUrl("registration/registration/sendmessage"); ?>',
                       //data:{'data':data,'email':email},
                       data:data,
                    success:function(data){
                                  //alert(data);
                                    location.reload();
                                   // $(".flash-success").load(window.location + " .flash-success");

                                    //$("#flash-success").html(data);
                                     //$("#flash-success").hide(1000); 
                                    return true; 
                                  },
                       error: function(data) { // if error occured
                             //alert("Error occured.please try again");
                             //alert(data);
                             return false;
                        },
                     
                      dataType:'html'
            });
       } 
       else
       {

            $("#ConversationMsg_subject").css({

                    "border": "1px solid red",

                    "background": "#FFCECE"

                });
            $("#MsgDetails_msg").css({

                    "border": "1px solid red",

                    "background": "#FFCECE"

                });
          return false;
       }
             
 
              
 
}
/*function to send the message to company*/

function send()
 {

   var data=$("#cdashboard").serialize();
  
  // var email="<?php echo $_SESSION['_registration__id'];?>";

            $.ajax({
                       type: 'POST',
                        url: '<?php echo Yii::app()->createAbsoluteUrl("registration/registration/Profile"); ?>',
                       //data:{'data':data,'email':email},
                       data:data,
                    success:function(data){
                                  //alert(data);
                                    //location.reload();
                                   // $(".flash-success").load(window.location + " .flash-success");

                                    //$("#flash-success").html(data);
                                    $("#flash").show();
                                     $("#flash").hide(1000); 
                                    //return true; 
                                  },
                       error: function(data) { // if error occured
                             //alert("Error occured.please try again");
                             //alert(data);
                             return false;
                        },
                     
                      dataType:'html'
            });
 
              
 
}
/*edit job quote here*/
function editJobQuote(id)
{
        var data=$("#editquote").serialize();
        //var id=id; 
        //var id=$(this).attr('id');
       // alert(id) 
  // var email="<?php echo $_SESSION['_registration__id'];?>";

            $.ajax({
                       type: 'POST',
                        url: '<?php echo Yii::app()->createAbsoluteUrl("registration/registration/editJobQuoteCustomer"); ?>',
                       //data:{'id':id},
                       data:data,
                    success:function(data){
                                  alert(data);
                                    //location.reload();
                                   // $(".flash-success").load(window.location + " .flash-success");

                                    //$("#flash-success").html(data);
                                    $("#flash").show();
                                     $("#flash").hide(1000); 
                                    //return true; 
                                  },
                       error: function(data) { // if error occured
                             //alert("Error occured.please try again");
                             //alert(data);
                             return false;
                        },
                     
                      dataType:'html'
            });
}
function abc(sEmail)
{
  var emailReg = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
  var valid = emailReg.test(sEmail);

  if(!valid) {

        $("#email").css({

                    "border": "1px solid red",

                    "background": "#FFCECE"

                });
        return false;
    } else {
      return true;
    }
}
/*function validEmail(sEmail) {

 alert(sEmail)

    var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;

    if (filter.test(sEmail)) {

        return true;

    }

    else {

        return false;

    } 

}​*/

function chkRelistJobActiveTab()
{
    var loggedId    ="<?php echo Yii::app()->session['loggedId'];?>";

    $.ajax({
                               type: 'POST',
                                url: '<?php echo Yii::app()->createAbsoluteUrl("registration/registration/autoRelistJobActiveTab"); ?>',
                               //data:{'data':data,'email':email},
                               data:{'loggedId':loggedId},
                            success:function(data){

                                           //alert(data);
                                           $('.prev'+bookingId).hide();
                                           //location.reload();  
                                           //$('.a'+id).hide();
                                          
                                          },
                               error: function(data) { // if error occured
                                    // alert(data);
                                     return false;
                                },
                             
                              dataType:'html'
                    });  

}

function activeCustomerJobsMsg1(id)
{
     //var loggedId    ="<?php echo Yii::app()->session['loggedId'];?>";
     var sub     =$.trim($("#sub"+id).val());
     //var sub     =document.getElementById('ConversationMsg_subject').value;
     
     var msg1    =$.trim($("#msg"+id).val());    
     
     //$.trim($(".text"+id).val());
     var data=$("#Customer"+id).serialize();
     //alert(data);
     if(sub!='' && msg1!='')
     {	

            
            $.ajax({
                               type: 'POST',
                                url: '<?php echo Yii::app()->createAbsoluteUrl("registration/registration/ActiveJobsAddMsgCustomer"); ?>',
                               //data:{'data':data,'email':email},
                               data:data,

                            success:function(data){

                                           //alert(data);
                                           $("#mailbox-inbox").html(data);
                                           $("#msgrender"+id).html(data);
                                            
                                            $("#sub"+id).css({

                                							                    "border": "",

                                							                    "background": ""

                                							                });
                          								        	$("#msg"+id).css({

                          								                    "border": "",

                          								                    "background": ""

                          								                });

                                            $("#sub"+id).val(' ');
                                            $("#msg"+id).val(' ');                        
                                          },
                               error: function(data) { // if error occured
                                    // alert(data);
                                     return false;
                                },
                             
                              dataType:'html'
                    });

              

        }
        else
        {
           //alert("fsfsf");
        	$("#sub"+id).css({

                    "border": "1px solid red",

                    "background": "#FFCECE"

                });
        	$("#msg"+id).css({

                    "border": "1px solid red",

                    "background": "#FFCECE"

                });
             return false;
        }             
}

function ticketCustomerJobsMsg(id)
{
        
        var subject=$("#ticketsubject").val();
       var msg    =$("#ticketmsg").val();    
      // alert(msg)
      var loggedId    ="<?php echo Yii::app()->session['loggedId'];?>";
     var data=$("#TicketCustomerMsg"+id).serialize();
     //alert(data)

     if(subject!='' && msg!='')
     {	

            
            $.ajax({
                               type: 'POST',
                                url: '<?php echo Yii::app()->createAbsoluteUrl("registration/registration/TicketAddCustomer"); ?>',
                               //data:{'data':data,'email':email},
                               data:data,

                            success:function(data){

                                          // alert(data);
                                           $("#mailbox-inbox").html(data);
                                           $("#ticketmsgrender"+id).html(data);
                                            
                                            $("#ticketsubject").css({

							                    "border": "",

							                    "background": ""

							                });
								        	$("#ticketmsg").css({

								                    "border": "",

								                    "background": ""

								                });

                  $("#ticketsubject").val(' ');
                  $("#ticketmsg").val(' ');                        
                                          },
                               error: function(data) { // if error occured
                                    // alert(data);
                                     return false;
                                },
                             
                              dataType:'html'
                    });

              

        }
        else
        {
        	$("#ticketsubject").css({

                    "border": "1px solid red",

                    "background": "#FFCECE"

                });
        	$("#ticketmsg").css({

                    "border": "1px solid red",

                    "background": "#FFCECE"

                });
             return false;
        } 
}
function CreateTicketCustomer()
{

        var subject=$.trim($("#ticketsubject").val());
       var msg    =$.trim($("#ticketmsg").val());    
       //alert(subject)
       //var loggedId    ="<?php echo Yii::app()->session['loggedId'];?>";
       var data=$("#Ticket").serialize();
     if(subject!='' && msg!='')
     {  

            
            $.ajax({
                               type: 'POST',
                                url: '<?php echo Yii::app()->createAbsoluteUrl("registration/registration/TicketAddCustomer"); ?>',
                               //data:{'loggedId':loggedId},
                               data:data,

                            success:function(data){

                                           //alert(data);
                                           $("#mailbox-inbox").html(data);
                                           $("#ticketmsgrender").html(data);
                                            
                                            $("#ticketsubject").css({

                                              "border": "",

                                              "background": ""

                                          });
                                          $("#ticketmsg").css({

                                                    "border": "",

                                                    "background": ""

                                                });

                                          $("#ticketsubject").val(' ');
                                          $("#ticketmsg").val(' ');                        
                                          },
                               error: function(data) { // if error occured
                                    // alert(data);
                                     return false;
                                },
                             
                              dataType:'html'
                    });

              

        }
        else
        {
          $("#ticketsubject").css({

                    "border": "1px solid red",

                    "background": "#FFCECE"

                });
          $("#ticketmsg").css({

                    "border": "1px solid red",

                    "background": "#FFCECE"

                });
             return false;
        } 
}
/*
var auto_refresh = setInterval(
function ()
{
$('#previous').load('<?php echo Yii::app()->createAbsoluteUrl("registration/registration/customerdashboard"); ?>').fadeIn("slow");
}, 10000); // refresh every 10000 milliseconds
*/
</script>

<div class="profile_outer">
    <div class="detail_outer sign_2"> 
      <!-- <h4> Detail </h4> -->
      
      <div id="tabs">
        <ul>
          <li><a href="#request"> Jobs Requests</a></li>
          <li><a href="#active">Active Jobs</a></li>
          
          <li><a href="#previous">Previous Jobs</a></li>
          <li><a href="#profile">Profile</a></li>
          <li><a href="#messages" class="ticket">Ticket</a></li>
        </ul>

        <!--Job Requests from customer starts here -->
        <?php foreach($companyRequest as $companyRequest) { ?>
        <div id="request" class="req<?php echo $companyRequest['id'];?>">
          <div class="active_left">
            <div class="left-1"> <img src="<?php echo Yii::app()->request->baseUrl; ?>/banner/<?php echo $companyRequest->booking->serviceType['image']; ?>" alt=""> </div>
            <div class="right-2">
              <h4> <?php echo $companyRequest->booking->customer['cname']." ".$companyRequest->booking->customer['clname']?> </h4>
              <p><?php echo $companyRequest->service['city'];?> to <?php echo $companyRequest->booking->customerAddress['address'];?></p>
             <!-- <p><span>254 miles</span></p> -->
            </div>
          </div>
          <div class="active_left active_right">
            
            <div class="right-02">
               
               <p class="quote1">
                   <a href="#">
                      <span class="ng-binding">£<?php echo $companyRequest->booking['price'];?></span>
                   </a>
               </p>
             
                   <a class="login_in greenbtn customerMsgDetailRequest" id="<?php echo $companyRequest->booking['id'];?>" href="javascript:void(0)">Message</a>
                  <!--<a class="login_in greenbtn accept" href="javascript:void(0)" id="<?php //echo $companyRequest['id'] ?>">Accept</a>
                  <a class="login_in greenbtn decline" href="javascript:void(0)" id="<?php //echo $companyRequest['id'] ?>">Decline</a> 
                  -->
              </div>
          </div>

                <div class="customerMsgDetail2" id="customermsglistReq<?php echo $companyRequest->booking['id'];?>" style="display:none;">
                            <!-- messaging div to open on click starts here-->
               <div id="msglist<?php echo $book->id;?>">
                          

                          <div id="msgrender<?php echo $companyRequest->booking['id'];?>">
                               </div>
                             <div class="msgbtn" id="<?php echo $companyRequest->booking['id'];?>">
                                <h5>Create Message</h5>
                             </div>

                                            <div id="crtMsg<?php echo $companyRequest->booking['id'];?>" style="display:none;" class="form">
                                                    <?php $form=$this->beginWidget('CActiveForm', array(
                                                        'id'=>'Customer'.$companyRequest->booking['id'],
                                                        'enableAjaxValidation'=>false,
                                                        'htmlOptions'=>array(
                                                        'onsubmit'=>"return false;",/* Disable normal form submit */
                                                        'onkeypress'=>" if(event.keyCode == 13){ activeCustomerJobsMsg(); } " /* Do ajax call when user presses enter key */
                                                       ),
                                                     )); ?> 
                                                      <?php  $loggedId= Yii::app()->session['loggedId'];?>
                                                     <input type="hidden" name="reciverId" value="<?php echo $book->service['id'];?>"> 
                                                     <input type="hidden" name="senderId" value="<?php echo $loggedId;?>"> 
                                                      <input type="hidden" name="bookingId" value="<?php echo $companyRequest->booking['id'];?>">
                                                         <div class="pref_form" id="activesub">
                                                        <p>
                                                              <?php  echo $form->labelEx($msg,'subject',array('label'=>'Subject')); ?>
                                                              <?php  echo $form->textField($msg,'subject',array('id'=>'sub'.$companyRequest->booking['id'])); ?>                                                   
                                                           
                                                        </p>
                                                        </div>
                                                        <div class="pref_form" id="activemsg">
                                            
                                                            
                                                                 <?php echo $form->labelEx($msgDetail,'msg',array('label'=>'Message')); ?>
                                                                 <?php echo $form->TextArea($msgDetail,'msg',array('id'=>'msg'.$companyRequest->booking['id'])); ?>
                                                                     
                                                            
                                                        </div>

                                                       <div class="pref_form" id="button">
                                                        <?php echo CHtml::submitButton('Send',array('class'=>'login_in greenbtn snd ','id'=>$companyRequest->booking['id'],'onclick'=>'activeCustomerJobsMsg1(id);')); ?>
                                                       </div> 
                                                    <?php $this->endWidget(); ?>

                                           </div>

                               
                         
                      </div>
               </div>
        </div>
        <?php } ?>
        <!-- Job requests from customer ends here-->
        <!-- active -->
        <?php 
              
               //foreach($bookingDetails['bookings'] as $book) { 
                 foreach(array_reverse($bookingDetails['bookings']) as $book) {

                  if(!empty($request))
                  {  
                    if(in_array($book->id,$request))
                    { 
                      
                      if(!in_array($book->id,$bookIds))
                       { 
                             
        	?>
        <div id="active" class="a<?php echo $book->id;?>">
          <div class="active_left">
            <div class="left-1"> <img src="<?php echo Yii::app()->request->baseUrl; ?>/banner/<?php echo $book->serviceType['image']; ?>" alt=""> </div>
            <div class="right-2">
              <h4> <?php echo $book->service['company_name'];?> </h4>
              <p><?php echo $book->service['city'];?> to <?php echo $bookingDetails['city'];?></p>
              <!--<p><span>254 miles</span></p> -->
            </div>
          </div>
          <div class="active_left active_right">
            <!-- <div class="right-2 left-01">
              <h4> Home </h4>
              <p>from</p>
              <p><span>254 miles</span></p>
            </div> -->
            <div class="right-02">
              <p class="quote"> <a href="#"><span class="ng-binding">£ <?php echo $book->price;?></span></a></p>
              <!--<a class="login_in greenbtn editJob" id="<?php //echo $book->id;?>" href="javascript:void(0)">Edit Job</a>
              -->
              <a class="login_in greenbtn endJob" id="<?php echo $book->id;?>" href="javascript:void(0);">End Job</a>
              <a class="login_in greenbtn customerQuotes" id="<?php echo $book->id;?>" href="javascript:void(0);">View Quotes</a>
              <a class="login_in greenbtn customerMsgDetail" id="<?php echo $book->id;?>" href="javascript:void(0)">Message</a>
              <!--<a class="login_in greenbtn viewQuotes" id="<?php //echo $book->id;?>" href="<?php //echo Yii::app()->createUrl('registration/registration/viewquotes',array('id'=>$book->id))?>">View Quotes</a>
               -->
               <input type="hidden" id="mk" value="">
              <!--<a class="login_in greenbtn" href="#">VIEW QUOTES</a> -->
              <!-- star rating--> 
              <div class="hidenDiv" id="md-<?php echo $book->id;?>">
              Give Review 
              <div class="clear"></div>
              <?php
                      $iD=$book->id;
                      //$this->widget('CStarRating',array('name'=>'rating'));
                      echo CHtml::beginForm();
                      $this->widget('CStarRating',array(
                          'name'=>'ratingAjax',
                          'minRating'=>1,
                          'maxRating'=>5,
                          'allowEmpty'=>true,
                          'callback'=>'
                              function(){
                                      $.ajax({
                                          type: "POST",
                                          url: "'.Yii::app()->createUrl('registration/registration/rating').'",
                                          data: "'.Yii::app()->request->csrfTokenName.'='.Yii::app()->request->getCsrfToken().'&rate=" + $(this).val(),
                                          success: function(msg){
                                                     

                                                      var a="#result";
                                                      var b=document.getElementById("mk").value;
                                                       
                                                      var c= a+b;
                                                               

                                                      var res=msg.split(":");
                                                      var r=res[1];
                                                      var star="rate";
                                                      var s=star+b;
                                                      
                                                      document.getElementById(s).value=r;
                                                     
                                                      $(c).html(msg);
                                              }})}'

                        ));

                      echo "<br/>";
                      echo "<div id=result".$iD.">No Result</div>";
                     echo CHtml::endForm();

              ?>

              <input type="hidden" id="rate<?php echo $book->id; ?>" value="">
              <div class="clear"></div>
              <?php echo CHtml::textArea('Text','',array('class'=>'text'.$book->id,'id'=>$book->id));  ?>
              <div class="clear"></div>
              <?php echo CHtml::submitButton('Submit',array('class'=>'addreview','id'=>$book->id)); ?>

              <?php echo CHtml::submitButton('Cancel',array('class'=>'cancel','id'=>$book->id)); ?>
              </div>
              

              </div>
                        </div>
             
              <div class="customerview quotes" id="customerquote<?php echo $book->id;?>" style="display:none;">
                            
                              <!--  view quotes detils here starts-->

          
                 <div class="about_in1" id="abt">
                     <div class="clean">
                      <div class="extouter">
                      <h5>Details</h5> 
                      <div class="ext">
                              <span class="extra">Name:<?php echo " ".$book->customer['cname']." ".$book->customer['clname'];?>
                                    
                            </span>
                              <!--<p >Time:       <?php //echo $d->companyRequests['cleaningtime'];?></p> -->
                      </div>
                      <div class="ext">
                              <span class="extra">Address:<?php echo " ".$book->customerAddress['address'];?>                                 
                            </span>
                            
                              <!--<p >Time:       <?php //echo $d->companyRequests['cleaningtime'];?></p> -->
                      </div>
                       <div class="ext">
                            
                            <span class="extra">Zip code:<?php echo " ".$book->customerAddress['zipcode'];?>
                                    
                            </span>
                              <!--<p >Time:       <?php //echo $d->companyRequests['cleaningtime'];?></p> -->
                      </div>
                      <!--<div class="ext">
                              <span class="extra">ServiceType:<?php //echo " ".$book->serviceType['service_name'];?>
                                    
                            </span>
                              
                      </div> -->
                       <div class="ext">
                              <span class="extra">
                                    Address:    <?php echo " ".$book->customerAddress['address'];?>
                                
                            </span>
                              <!--<p >Time:       <?php //echo $d->companyRequests['cleaningtime'];?></p> -->
                      </div>
                       <div class="ext">
                              <span class="extra">
                                    Price:      <?php echo " ".$book['price'];?>
                            </span>
                              <!--<p >Time:       <?php //echo $d->companyRequests['cleaningtime'];?></p> -->
                      </div>

                     </div>
                     <div class="extouter">
                     <h5>Service </h5> 
                           <span class="extra">ServiceType:<?php echo " ".$book->serviceType['service_name'];?>
                                    
                            </span>
                     </div>  




                      <div class="right_outer">

                      <?php 
                          $res=$book['cleaningDetail'];
                          if(!empty($res))
                          {

                            echo "<div class='right1'>";
                            echo "<h5>Cleaning Services</h5>";
                            echo "</div>";      
                          }  
                          $r=explode(",",$res);

                          foreach($r as $result)
                          {
                             $val=explode("-",$result);
                              
                               $no=$val[0];
                               $name=$val[1];
                             if(!empty($res))
                             { 
                                echo "<div class='right1'>";
                                echo "<span class='cleaning'>";
                                echo $name." : ".$no."  ";
                                echo "</span>";
                                echo "</div>";
                             }
                          }   //echo "<pre>";print_r($final);die;
                     ?>

                     
                     
                      <?php 
                        $res1=$book['additional'];
                        if(!empty($res1))
                        {
                            echo "<div class='right2'>";
                            echo "<h5>Additional Services</h5>";
                            echo "</div>"; 
                        }  

                        $r2=explode(",",$res1);

                        foreach($r2 as $resul)
                        {
                           $val1=explode("-",$resul);
                           
                             $n=$val1[0];
                             $nam=$val1[1];
                              if(!empty($res1))
                             {  
                                echo "<div class='right2'>";
                                
                                echo "<span class='cleaningDetail'>";
                                echo $nam." : ".$n." ";
                                echo "</span>";
                                echo "</div>";
                             }
                        }   //echo "<pre>";print_r($final);die;
                   ?>
                   </div>
                
                </div>
            </div>
     

           <!-- -view quotes details ends here-->

              


              </div>

                <div class="customerMsgDetail1" id="customermsglist<?php echo $book->id;?>" style="display:none;">
                            <!-- messaging div to open on click starts here-->
               <div id="msglist<?php echo $book->id;?>">
                          

                          <div id="msgrender<?php echo $book->id;?>">
                               </div>
                             <div class="msgbtn" id="<?php echo $book->id;?>">
                                <h5>Create Message</h5>
                             </div>

                                            <div id="crtMsg<?php echo $book->id;?>" style="display:none;" class="form">
                                                    <?php $form=$this->beginWidget('CActiveForm', array(
                                                        'id'=>'Customer'.$book->id,
                                                        'enableAjaxValidation'=>false,
                                                        'htmlOptions'=>array(
                                                        'onsubmit'=>"return false;",/* Disable normal form submit */
                                                        'onkeypress'=>" if(event.keyCode == 13){ activeCustomerJobsMsg(); } " /* Do ajax call when user presses enter key */
                                                       ),
                                                     )); ?> 
                                                      <?php  $loggedId= Yii::app()->session['loggedId'];?>
                                                     <input type="hidden" name="reciverId" value="<?php echo $book->service['id'];?>"> 
                                                     <input type="hidden" name="senderId" value="<?php echo $loggedId;?>"> 
                                                      <input type="hidden" name="bookingId" value="<?php echo $book->id;?>">
                                                         <div class="pref_form" id="activesub">
                                                        <p>
                                                              <?php  echo $form->labelEx($msg,'subject',array('label'=>'Subject')); ?>
                                                              <?php  echo $form->textField($msg,'subject',array('id'=>'sub'.$book->id)); ?>                                                   
                                                           
                                                        </p>
                                                        </div>
                                                        <div class="pref_form" id="activemsg">
                                            
                                                            
                                                                 <?php echo $form->labelEx($msgDetail,'msg',array('label'=>'Message')); ?>
                                                                 <?php echo $form->TextArea($msgDetail,'msg',array('id'=>'msg'.$book->id)); ?>
                                                                     
                                                            
                                                        </div>

                                                       <div class="pref_form" id="button">
                                                        <?php echo CHtml::submitButton('Send',array('class'=>'login_in greenbtn snd ','id'=>$book->id,'onclick'=>'activeCustomerJobsMsg1(id);')); ?>
                                                       </div> 
                                                    <?php $this->endWidget(); ?>

                                           </div>

                               
                         
                      </div>
               </div>

             
        </div>
         

         <!-- edit section -->
          <?php //echo "<pre>";print_r($book->companyRequests);die;?>
		  <div class="wrap view">
		    <div class="quote_outer2 viewinput">
		      <div class="cont">
             <div class="search_outer" style="display:none" id="edit<?php echo $book->id;?>">
             <?php $form=$this->beginWidget('CActiveForm', array(
			        'action'=> Yii::app()->createUrl('registration/registration/edit',array('id'=>$_REQUEST['id'])),
					'id'=>'quotes',
					'enableClientValidation'=>true,
					'clientOptions'=>array(
					'validateOnSubmit'=>true,

					),
				)); ?>
                 
				<?php /*$form=$this->beginWidget('CActiveForm', array(
                            'id'=>'editquote',
                            'enableAjaxValidation'=>false,
                                'htmlOptions'=>array(
                               'onsubmit'=>"return false;",
                               'onkeypress'=>" if(event.keyCode == 13){ editJobQuote(); } " 
                             ),
                    )); */?> 
                            <input type="hidden" id="editJob" value="<?php echo $book->id;?>" name="book">
				          <?php  echo CHtml::textField('CleaningTime[PostCode]',$book->companyRequests[0]['postcode'],array('placeholder'=>'Property Post Code or Area' ,'class'=>'required','id'=>'code'));?>
				         
				          <?php echo CHTML::textField('CleaningTime[CleaningDate]',date('m/d/Y',strtotime($book->companyRequests[0]['cleaningdate'])),array('id'=>'datepicker' ,));?>
                          
                          <?php foreach($list as $l) {   	?>
                           
                            <?php $t[]=$l->time; 

                                  $res=array_combine($t,$t);

                            ?>

                            <?php }  ?>

                           <?php  echo $form->dropDownList($mod,'time',$res,array('options'=>array($book->companyRequests[0]['cleaningtime']=>array('selected'=>true)))); ?>
                            
                              <?php/* foreach($serName as $l) {   	?>
                           
                            <?php $t[]=$l->service_name; 
                                  
                                  $re=array_combine($t,$t);
                                  //echo "<pre>";print_r($res);die;
                            ?>

                            <?php }  */?>
                            
                              
                            <?php  echo $form->dropDownList($service,'service_name',$serName,array('class'=>'serviceType','options'=>array($book['service_type_id']=>array('selected'=>true)))); ?>
                            
                           

                            <?php  

                                   

                                if(!empty($book['cleaningDetail'])) { 
                                     

                            ?>
                                
                                   <?php    $r2=explode(",",$book['cleaningDetail']);
                                    // echo "<pre>";print_r($r2);
                                    foreach($r2 as $resul)
                                    {
                                       $val1=explode("-",$resul);
                                       
                                         $n=$val1[0];
                                         $nam=$val1[1];
                                     ?>     
                                     <div class="controlHolder">
                                     
                                           <div class="btnouter">  
                                           <button class="stepper-button-down" data-direction="down" type="button"></button>
                                            
                                            <label><?php echo $nam;?></label>
                                            <?php echo CHtml::textField('Booking['.$nam.']',$n,array('class'=>'count1' ));?>
                                      
                                             <button class="stepper-button-up" data-direction="up" type="button"></button>
                                            </div>
                                        </div>  
                                  <?php   }   ?>
                                    
                            <?php } ?>
                            
                                <div class="same" style="display:none;">
                                <div class="controlHolder">
                                     
                                           <div class="btnouter">  
                                           <button class="stepper-button-down" data-direction="down" type="button"></button>
                                            
                                            <label>Property</label>
                                            <?php echo CHtml::textField('Booking[Property]',0,array('class'=>'count1 prop' ));?>
                                      
                                             <button class="stepper-button-up" data-direction="up" type="button"></button>
                                            </div>
                                        </div>
                                <div class="controlHolder">
                                     
                                           <div class="btnouter">  
                                           <button class="stepper-button-down" data-direction="down" type="button"></button>
                                            
                                            <label>Desk</label>
                                            <?php echo CHtml::textField('Booking[Desk]',0,array('class'=>'count1 desk' ));?>
                                      
                                             <button class="stepper-button-up" data-direction="up" type="button"></button>
                                            </div>
                                        </div>


                                    </div>

                            <?php 
                               // echo "<pre>";
                                //print_r($book['additional']);
                                //print_r($addnlSer);
                                foreach($addnlSer as $addnlSerVal){
                                	$addSerArr[$addnlSerVal] = 0;
                                }
                              if(!empty($book['additional'])) { 
                                     

                            ?>
                                   
                                   <?php    $r2=explode(",",$book['additional']);
                                    // echo "<pre>";print_r($r2);
                                    foreach($r2 as $resul)
                                    {
                                       $val1 = explode("-",$resul);
                                       
                                         $n=$val1[0];
                                         $nam=$val1[1];
                                         $addSerArr[$nam] = $n;
                                    }
                                       foreach($addSerArr as $value=>$num)
                                       {
                                     ?>  
                                    <div class="controlHolder"> 

                                     <div class="btnouter">
                                      <label><?php echo $value;?></label>    
                                      <button class="stepper-button-down" data-direction="down" type="button"></button>
                                     
                                   <?php echo CHtml::textField('Additional['.$value.']',$num,array('class'=>'count1' ));?>
                         
                                     <button class="stepper-button-up" data-direction="up" type="button"></button>
                                         </div>
                                         </div>
                                  <?php   }  //echo "<pre>";print_r($addSerArr); ?>
                                  

                            <?php } ?>
                              

				          <?php echo CHtml::submitButton('Submit',array('class'=>'button' ,'value'=>'Confirm Quotes','id'=>$book->id));?>
			              <!--   <input type="text" placeholder="Property Post Code or Area">
					          <input type="text" placeholder="Cleaning Date" id="datepicker">
					          <input type="text" placeholder="Cleaning Time">
					          <input type="button" value="Confirm Quotes" class="button"> -->



          <?php $this->endWidget(); ?>
         </div>
          </div>
          </div>
          </div>
          

        <?php }  }  }  } ?>
        <?php 
                    /*$this->widget('CLinkPager', array(
                        'pages'=>$pages,
                      
                      ));*/
              ?>
         <?php 
              
                 /*$this->widget('CLinkPager', array(
                        'pages'=>$pages,
                      
                      ));*/

                  /*$this->widget('zii.widgets.CListView', array(
                  'dataProvider' => $dataProvider,
                  'itemView' => 'customerdashboard',
                  'ajaxUpdate'=>false,
                  'enablePagination'=>true,
                  'pagerCssClass' => 'result-list',
                  'summaryText' => 'Total '. $pages->itemCount .' Results Found',
                  )); */
                

          ?> 
         
        <!-- active end-->
        <div class="clear"></div>
        <!-- messages ticket-->
         <div id="messages" class=" " aria-labelledby="ui-id-1" role="tabpanel" aria-hidden="false" style="display: block;">
                  <div id="ticketmsgrender<?php //echo $book->id;?>"> </div>
                         
                            <div class="ticketmsgbtn" id="<?php //echo $book->id;?>">
                                <h5>Create New Ticket</h5>
                             </div>
                       
                                            <div id="ticketcrtMsg<?php //echo $book->id;?>" style="display:none;" class="form">
                                                    <?php $form=$this->beginWidget('CActiveForm', array(
                                                        'id'=>'Ticket',
                                                        'enableAjaxValidation'=>false,
                                                        'htmlOptions'=>array(
                                                        'onsubmit'=>"return false;",/* Disable normal form submit */
                                                        'onkeypress'=>" if(event.keyCode == 13){ CreateTicketCustomer(); } " /* Do ajax call when user presses enter key */
                                                       ),
                                                     )); ?> 
                                                      <?php  $loggedId= Yii::app()->session['loggedId'];?>
                                                     <input type="hidden" name="reciverId" value="0"> 
                                                     <input type="hidden" name="senderId" value="<?php echo $loggedId;?>"> 
                                                      <input type="hidden" name="bookingId" value="0">
                                                         <div class="pref_form" id="activesub">
                                                        <p>
                                                              <?php  echo $form->labelEx($msg,'subject',array('label'=>"Subject")); ?>
                                                              <?php  echo $form->textField($msg,'subject',array('id'=>'ticketsubject')); ?>                                                   
                                                           
                                                        </p>
                                                        </div>
                                                        <div class="pref_form" id="activemsg">
                                            
                                                           
                                                                 <?php echo $form->labelEx($msgDetail,'msg',array('label'=>"Message")); ?>
                                                                 <?php echo $form->TextArea($msgDetail,'msg',array('id'=>'ticketmsg')); ?>
                                                                     
                                                     
                                                        </div>

                                                       <div class="pref_form" id="button">
                                                        <?php echo CHtml::submitButton('Send',array('class'=>'login_in greenbtn snd ','onclick'=>'CreateTicketCustomer();')); ?>
                                                       </div> 
                                                    <?php $this->endWidget(); ?>

                                           </div>
         </div>
        <!-- messages ends here ticket-->
        
       <?php /* <div id="messages" class="ui-tabs ui-tabs-panel messg">

                 <a id="create" href="javascript:void(0)">Create Message</a>
                 <div class="clear"></div>
           
           <!-- Create MEssage here starts here-->
            
                    <?php $form=$this->beginWidget('CActiveForm', array(
                            'id'=>'sendmessage',
                            'enableAjaxValidation'=>false,
                                'htmlOptions'=>array(
                               'onsubmit'=>"return false;",
                               'onkeypress'=>" if(event.keyCode == 13){ send(); } "
                             ),
                    )); ?> 
              <div class="pref_right" id="createmsg">
                      <div class="pref_form">
                         <p>
                              <?php  echo $form->labelEx($msg,'reciver_id',array('label'=>'To')); ?>
                              <?php echo $form->dropDownList($msg,'reciver_id',$finalTo,array('class'=>'msgsnd')); ?>
                                  
                              <?php  //echo $form->dropDownList($finalTo,'reciver_id',array()); ?>                                                   
                              <?php  echo $form->error($msg,'reciver_id'); ?>
                          
                        </p>
                           <p>
                             <?php  echo $form->labelEx($msgDetail,'msg'); ?>
                             <?php echo $form->TextArea($msgDetail,'msg',array()); ?>
                             <?php echo $form->error($msgDetail,'msg'); ?>
                          </p>
                         </div>
                         <div class="pref_form">
                        <p>
                             <?php  echo $form->labelEx($msg,'subject'); ?>
                             <?php  echo $form->textField($msg,'subject',array()); ?>                                                   
                             <?php  echo $form->error($msg,'subject'); ?>
                        </p>
                        </div>

                       <div class="pref_form" id="button">
                    
                        <?php echo CHtml::submitButton('Submit',array('class'=>'login_in greenbtn ','id'=>'sendMsg','onclick'=>'sendMessage();')); ?>
                         
                        <?php //echo CHtml::submitButton('Submit',array('class'=>'login_in greenbtn ','id'=>'submit','onclick'=>'send();')); ?>
                      </div>
                      <div id="flash-success" style="display:none">Changes Saved</div>
                       
                      


                    </div>
                    <?php $this->endWidget(); ?>
           <!-- Create Message ends here -->


          <div id="mailbox-inbox" class="ajax-paged"><!-- class ajax-paged required to make pagination work -->
            <div id="mailbox-selector">
              <p><a id="inbox" href="javascript:void(0)">Inbox</a> | <a id="sent" href="javascript:void(0)">Sent</a></p>
            </div>
            <div class="grid-header-row"> <span class="subject">Subject</span> <span class="username">From</span><!-- <span class="lowest_bid">Quote</span> --><span class="date"><a href="/ajax-dashboard-customer-messages/sort-field-created_at/sort-direction-asc" class="">Received</a></span> <span class="delete-message bluebtn dlt">Delete</span> </div>
                  <!--convMsg -->
                 <?php 

                      $loggedId       =Yii::app()->session['loggedId'];
                     foreach($inbox as $msg) { 
                        
                       
                           
                  ?>
                  <div class="message close has-more read- first-row unread" id="<?php echo $msg->id;?>" data-id="17602932">
                    <div class="status read"></div>
                    <div class="subject"><?php echo $msg->conversation['subject']?></div>
                    <div class="username"><span class="provider accredited"> 
                     <?php 
                           if(!empty($companyName))
                           {
                           foreach($companyName as $name)   
                          { 
                     ?>
                     <?php echo $name['company_name'];?>
                    <?php }  } else { ?>

                       <?php echo "Admin";?>
                    <?php } ?>
                    <span class="badge_container"> <!--<img title="" alt="" src="images/badge_provider_accredited.png" class="accredited">--></span> 
                    <span class="jobs">
                     (<?php 

                     $count=MsgDetails::model()->findAll(array('condition'=>'conversation_id=:conversation_id AND tomsg=:tomsg','params'=>array(
                                 
                                   ':conversation_id'=>$msg->conversation_id,
                                   ':tomsg'          =>$loggedId, 
                    )));
                     echo count($count);?>)

                    </span></span></div>
                    <!-- <div class="lowest_bid"><a href="/view-quotes/1849850" class="accept_bid">£525</a></div> -->
                    <div class="date">
                    <span title="2014-09-29 23:40:05" class="time-label">
                      <!--14 days ago -->

                      <?php  
                   

                            $date1 = $msg->date;
                            $date2 = date("Y-m-d");

                            $diff = abs(strtotime($date2) - strtotime($date1));

                            $years = floor($diff / (365*60*60*24));
                            $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
                            $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

                           echo   $days;
                           echo " ";
                           echo "Days";
                       ?>

                    </span></div>
                    <div class="delete">
                     <input type="checkbox" name="check[]" value="<?php echo $msg->conversation['id'];?>" id="delete-comment-17602932">

                    </div>
                  </div>

                <div class="detailmsg<?php echo $msg->id;?>" style="display:none;">
                 
                 <input type="hidden" class="subject<?php echo $msg->conversation['id'];?>" value="<?php echo $msg->conversation['subject'];?>">
                
                <label>Reply Now</label>
                <div class="clear"></div> 
                <input type="hidden" id="recv<?php echo $msg->conversation['sender_id'];?>" value="<?php echo $msg->conversation['sender_id'];?>">
                <?php echo CHtml::textArea('Text','',array('class'=>'text'.$msg->conversation['id'])); ?>
                 <div class="clear"></div> 
                <?php echo CHtml::submitButton('Send',array('class'=>'login_in greenbtn sndmsg ','id'=>$msg->conversation['id'].'-'.$msg['user_id'])); ?>
                     
                <div class="clear"></div>  
               
               <?php 
                     echo "Message Detail."."</br>";
                     echo "<div class='clear'></div>";
                     foreach($inboxDtal as $detail)
                     {  
                        foreach($detail as $d)
                        {  
                           if($msg->conversation_id==$d['conversation_id'])
                          {

                           //echo "<pre>";print_r($detail); 
                           echo $d['msg']."<br>";
                          }
                       }
                     } 
               ?>


            </div>



                  <?php } //}  ?>

                  
          </div>
        </div> */ ?>
        <!-- messages end-->
        
        <!-- Sent box div starts here -->
   <?php /*  <div id="sentbox" class="ui-tabs ui-tabs-panel messg">               


          <div id="mailbox-inbox" class="ajax-paged"><!-- class ajax-paged required to make pagination work -->
            <div id="mailbox-selector">
              <p> <a id="choose-inbox" href="javascript:void(0)">Inbox</a> | <a id="choose-sent" href="javascript:void(0)">Sent</a></p>
            </div>
            <div class="grid-header-row"> <span class="subject">Subject</span> <span class="username">To</span><!-- <span class="lowest_bid">Quote</span> --><span class="date"><a href="/ajax-dashboard-customer-messages/sort-field-created_at/sort-direction-asc" class="">Received</a></span> <span class="delete-message bluebtn sentboxdlt">Delete</span> </div>
                  
                 <?php 
                           

                           foreach($sentBox as $msg) { 
                           
                                  if($msg['sent_dlt_status']!=1)
                                   { 
                       
                            
                  ?>
                  <div class="message close has-more read- first-row unread" id="<?php echo $msg->id;?>" data-id="17602932">
                    <div class="status read"></div>
                    <div class="subject"><?php echo $msg->conversation['subject']; ?></div>
                    <div class="username"><span class="provider accredited"> 
                    <?php   
                             if(!empty($companyName)) 
                             foreach($companyName as $name)
                             { 
                    ?>   
                             <?php echo $name['company_name'];?>
                    <?php } else { ?>

                          <?php echo "Admin"; ?>
                    <?php } ?> 
                    <span class="badge_container"> <!--<img title="" alt="" src="images/badge_provider_accredited.png" class="accredited">--></span> <span class="jobs">(<?php //echo $count;?>)</span></span></div>
                    <!-- <div class="lowest_bid"><a href="/view-quotes/1849850" class="accept_bid">£525</a></div> -->
                    <div class="date">
                       <span title="2014-09-29 23:40:05" class="time-label">

                         <!--14 days ago -->
                         <?php  
                
                            $date1 = $msg->date;
                            $date2 = date("Y-m-d");

                            $diff = abs(strtotime($date2) - strtotime($date1));

                            $years = floor($diff / (365*60*60*24));
                            $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
                            $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

                           echo   $days;
                           echo " ";
                           echo "Days";
                      ?>


                       </span></div>
                    <div class="delete">
                     <input type="checkbox" name="check[]" value="<?php echo $msg->conversation['id'];?>" id="delete-comment-17602932">

                    </div>
                  </div>

                     <div class="detailmsg<?php echo $msg->id;?>" style="display:none;">
                 
                 <input type="hidden" class="subject<?php echo $msg->conversation['id'];?>" value="<?php echo $msg->conversation['subject'];?>">
                
                <label>Reply Now</label>
                <div class="clear"></div> 
                <input type="hidden" id="recv<?php echo $msg->conversation['sender_id'];?>" value="<?php echo $msg->conversation['sender_id'];?>">
                <?php echo CHtml::textArea('Text','',array('class'=>'text1'.$msg->conversation['id'])); ?>
                 <div class="clear"></div> 
                 <?php if($msg->conversation['reciver_type']=='company') { ?>
                        <?php echo CHtml::submitButton('Send',array('class'=>'login_in greenbtn sndmsg1 ','id'=>$msg->conversation['id'].'-'.$msg->conversation['reciver_id'])); ?>
                 <?php } else { ?>
                         <?php echo CHtml::submitButton('Send',array('class'=>'login_in greenbtn sndmsg1 ','id'=>$msg->conversation['id'].'-'.$msg->conversation['sender_id'])); ?>
 
                 <?php } ?>      
                <div class="clear"></div>  
               
               <?php 
                     echo "Message Detail."."</br>";
                     echo "<div class='clear'></div>";
                     foreach($sentBoxDtl as $detail)
                     {  
                         foreach($detail as $d)
                         {
                           if($msg->conversation_id==$d['conversation_id'])
                           {
                             echo $d['msg']."<br>";
                            } 
                         } 
                     } 
               ?>


            </div>



                  <?php }  } //} ?>

                  
          </div>
        </div>  */?>

        <!-- Sent box div ends here-->



        <div class="clear"></div>
        
        <!-- previous -->
        <?php 

              //$res=array_combine(keys, values)
           foreach($bookingDetails['bookings'] as $book) { 
                
                  //echo "<pre>";print_r($book->serviceReviews);
               
                  if(in_array($book->id,$bookIds) )
                   { 

                    
          ?>
        <div id="previous" class="prev<?php echo $book->id;?>">
         <div class="active_left">
            <div class="left-1"> <img src="<?php echo Yii::app()->request->baseUrl; ?>/banner/<?php echo $book->serviceType['image']; ?>" alt=""> </div>
            <div class="right-2 jobs">
              <h4> <?php echo $book->service['company_name'];?> </h4>
              <p><?php echo $book->service['city'];?> to <?php echo $bookingDetails['city'];?></p>
              <!--<p><span>254 miles</span></p> -->
            </div>
          </div>
          <div class="active_left active_right">
            <div class="right-2 left-01 job">
            
              <!--<p>Expired Job with no quotes</p> -->
            
            </div>
            <div class="button_right">
            <div class="right-02">
                <!--<a class="login_in greenbtn save_button" href="#">VIEW QUOTES</a> --> 
                


               </div>
               <div class="right-02">
              <a class="login_in greenbtn save_button bluebtn relist" id="<?php echo $book->id;?>" href="javascript:void(0);"> RELIST </a> </div>
              </div>
          </div>
        </div>

        <?php } }  ?>
       
        <div class="clear"></div>
        
        <!-- profile -->
        <div id="profile">
                  <div class="active_left pref">
                    <?php /*<div class="pref_left"> 
                          <?php if(!empty($dashboard->company_logo)) { ?>
                               <img src="<?php echo Yii::app()->request->baseUrl; ?>/CompanyLogo/<?php echo $dashboard->company_logo;?>" alt=""> 
                          <?php } else { ?>
                               
                                 <img src="<?php echo Yii::app()->request->baseUrl; ?>/CompanyLogo/download.jpg?>" alt=""> 

                          <?php }?> 

                    </div> */?>
                    
                    <?php /*$form=$this->beginWidget('CActiveForm', array(
                        'action'=> Yii::app()->createUrl('registration/registration/dashboard',array('id'=>$dashboard->id)),
                        'id'=>'dashboard',
                         
                        'enableClientValidation'=>true,
                        'clientOptions'=>array(
                        'validateOnSubmit'=>true,

                      ),
                    )); */?>   

                     <?php $form=$this->beginWidget('CActiveForm', array(
                            'id'=>'cdashboard',
                            'enableAjaxValidation'=>false,
                                'htmlOptions'=>array(
                               'onsubmit'=>"return false;",/* Disable normal form submit */
                               'onkeypress'=>" if(event.keyCode == 13){ send(); } " /* Do ajax call when user presses enter key */
                             ),
                    )); ?>

                    <div class="pref_right">
                      <div class="pref_form">
                        <p>
                          <?php echo $form->labelEx($model,'cname',array('label'=>'First Name')); ?>
                          <?php //echo $form->textField($model,'cname',array('value'=>$bookingDetails->cname." ".$bookingDetails->clname,'class'=>'same')); ?>
                          <?php echo $form->textField($model,'cname',array('value'=>$bookingDetails->cname,'class'=>'')); ?>
                          
                          <?php echo $form->error($model,'cname'); ?>
                        </p>
                        <p>
                          <?php echo $form->labelEx($model,'clname',array('label'=>'Last Name')); ?>
                          <?php //echo $form->textField($model,'cname',array('value'=>$bookingDetails->cname." ".$bookingDetails->clname,'class'=>'same')); ?>
                          <?php echo $form->textField($model,'clname',array('value'=>$bookingDetails->clname,'class'=>'')); ?>
                          
                          <?php echo $form->error($model,'clname'); ?>
                        </p>
                        <p>
                          <?php echo $form->labelEx($model,'email',array('label'=>'E-mail address:')); ?>
                          <?php echo $form->textField($model,'email',array('value'=>$bookingDetails->email,'class'=>'','id'=>'email')); ?>
                          <?php echo $form->error($model,'email'); ?>
        
                        </p>
                        <p>
                          <?php echo $form->labelEx($model,'city',array('label'=>'County:')); ?>
                          <?php echo $form->textField($model,'city',array('value'=>$bookingDetails->city,'class'=>'')); ?>
                          <?php echo $form->error($model,'city'); ?>
        
                        </p>
                         <p>
                          <?php echo $form->labelEx($model,'phone',array('label'=>'Phone No:')); ?>
                          <?php echo $form->textField($model,'phone',array('value'=>$bookingDetails->phone,'class'=>'')); ?>
                          <?php echo $form->error($model,'phone'); ?>
        
                        </p>
                         <p>
                          <?php echo $form->labelEx($model,'caddress',array('label'=>'Address:')); ?>
                          <?php echo $form->textField($model,'caddress',array('value'=>$bookingDetails->caddress,'class'=>'')); ?>
                          <?php echo $form->error($model,'caddress'); ?>
        
                        </p>
                      </div>
                      <div class="pref_form">
                        
                        <p>
                          <?php echo $form->labelEx($model,'password',array('label'=>'New Password:')); ?>
                          <?php echo $form->passwordField($model,'password',array('id'=>'password')); ?>
                          <?php echo $form->error($model,'password'); ?>
                        </p>
                        <p>
                        <label>Confirm Password:</label>
                         <input type="password" name="CustomerUser[cpassword]" id="cpassword" >
                          <?php //echo $form->labelEx($model,'cpassword',array('label'=>'Confirm Password:')); ?>
                          <?php //echo $form->passwordField($model,'cpassword'); ?>
                          <?php //echo $form->error($model,'cpassword'); ?>
                        </p>
                      </div>
                      <!--<a href="#" class="login_in greenbtn save">Save</a> -->
                      <?php echo CHtml::submitButton('Submit',array('class'=>'Send','id'=>'submitSend','onclick'=>'send();')); ?>
                       
                      
                       
                      
                       
                      


                    </div>
                  
                   <?php $this->endWidget(); ?>
                    
                  </div>
                  <div id="flash" style="display:none;">Changes Saved</div>
        </div>
      </div>
    </div>
  </div>
    </div>
</div>
<div class="clear"> </div>