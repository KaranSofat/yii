<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/providerstyle.css" rel="stylesheet" type="text/css" media="all" />

<script>

$(document).ready(function(){
  
// validate password
 // validate signup form on keyup and submit
       
      /*time out fn to chek the notification for msg in inbox*/
         // setTimeout('msgNotification()', 1000);
      //setInterval(function(){msgNotification();}, 5000);
      //setInterval(function(){activeJobsInCompany();}, 5000);
      
      //setInterval(function(){ chkInboxMsgNoti();}, 5000); 
     
      //clearTimeout(timeout);
      
       $(".boxHours").attr("disabled", "true");
     

       // show seleted tab
       $('.activate').click(function(){
           
            var typeId    =$(this).attr('id');
            var loggedId  ="<?php echo Yii::app()->session['loggedId'];?>";
            
             $.ajax({
                             type:'GET',  
                            url:"<?php echo Yii::app()->createUrl('registration/registration/changestatusServiceByCompany')?>",
           
                            data:{'typeId':typeId,'loggedId':loggedId},
                             success:function(result)
                             {
                                 //$("#alert success").html(data);
                                alert(result);
                                //location.reload()
                                return true;
                               //alert(result);
                             
                             },
                             error: function (result) {
                             // alert("Error.")
                            
                                  return false;
                            }
                       });   

       });


       //$("#createmsg").hide();
       $("#create").click(function(){
       	     //$("#createmsg").show();
            $("#createmsg").toggle();
       }); 
       /*onload show inbox tab*/
       $("#messages").show();
       $("#sentdiv").hide();

       $("#inbox").click(function(){
               
               $("#messages").show();
               $("#sentdiv").hide();             
       }); 
       

       $("#sent").click(function(){
               
               $("#messages").hide();
               $("#sentdiv").show();             
       }); 

       $("#choose-inbox").click(function(){
                $("#messages").show();
                $("#sentdiv").hide();
       });

       /*show message in div*/
       $(".message").click(function(){

             var id=$(this).attr('id');
             $(".detailmsg"+id).toggle();
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
                            url:"<?php echo Yii::app()->createUrl('registration/registration/deleteMsgCompDashboard')?>",
           
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
                             // alert("Error.")
                            
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
                            url:"<?php echo Yii::app()->createUrl('registration/registration/dltSentboxCompanyDashboard')?>",
           
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
                   $(".text"+id).css({

                    "border": "",

                    "background": ""

                });


                $.ajax({
                               type: 'POST',
                                url: '<?php echo Yii::app()->createAbsoluteUrl("registration/registration/replyfromCompany"); ?>',
                               //data:{'data':data,'email':email},
                               data:{'conversionId':id,'loggedId':loggedId,'receiverId':receiverId,'subject':subject,'text':text,'replysectionBookingId':replysectionBookingId},
                            success:function(data){
                                           
                                            //$(".main").append(data);
                                           // $(".text"+id).val(); 
                                           $("#"+id).append(data);
                                           $(".text"+id).val(' ');

                                           //alert(data);
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
           
           var text=$(".text12"+id).val();
           if(text=='')
           { 
                  $(".text12"+id).css({

                    "border": "1px solid red",

                    "background": "#FFCECE"

                });
                  return false;

           }
           else
           {
                   $(".text12"+id).css({

                    "border": "",

                    "background": ""

                });


                $.ajax({
                               type: 'POST',
                                url: '<?php echo Yii::app()->createAbsoluteUrl("registration/registration/replyfromCompany"); ?>',
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
      
      /*code to edit the price for quote */
      $(".editQuotes").click(function(){
           var id=$(this).attr('id');
           $('.quote'+id).hide();
           $('.price'+id).show();
           $('.quot'+id).hide();
           $('.update'+id).show();
      });
      
      $('.updateQuotes').click(function(){
           var updateId=$(this).attr('id');
           var val=$("#text"+updateId).val();
          

           $.ajax({
                               type: 'POST',
                                url: '<?php echo Yii::app()->createAbsoluteUrl("registration/registration/updatePriceforspecificCustomer"); ?>',
                               //data:{'data':data,'email':email},
                               data:{'val':val,'updateId':updateId,},
                            success:function(data){

                                          //alert(data);
                                          location.reload();  
                                           //$('.a'+id).hide();
                                           //$('#active').tabs( "load" , 2 );
                                          
                                          },
                               error: function(data) { // if error occured
                                    // alert(data);
                                     return false;
                                },
                             
                              dataType:'html'
                    });   

      });
      
      $('.cancel').click(function(){
          
           var id=$(this).attr('id');
           $('.quot'+id).show();
           $('.update'+id).hide();
           $('.price'+id).hide();
            $('.quote'+id).show();
      });

      /*code to decline the request from customer*/
      $('.decline').click(function(){
          var loggedId    ="<?php echo Yii::app()->session['loggedId'];?>"; 
          var id  =$(this).attr('id');
          //$('.req'+id).remove();

          $.ajax({
                               type: 'POST',
                                url: '<?php echo Yii::app()->createAbsoluteUrl("registration/registration/declineNewRequestsCompany"); ?>',
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
                                url: '<?php echo Yii::app()->createAbsoluteUrl("registration/registration/statusForNewRequestsCompany"); ?>',
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


                    $.ajax({
                               type: 'POST',
                                url: '<?php echo Yii::app()->createAbsoluteUrl("registration/registration/activeJobsInCompany"); ?>',
                               //data:{'data':data,'email':email},
                               data:{'ajaxlogId':loggedId,'id':id},

                            success:function(data){

                                           //alert(data);
                                           $("#ajax").append(data);
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
       /*code to accept the job from company*/
        
       /*save status of service type for company*/
       $('.saveStatusCompany').click(function(){
            var id=$(this).attr('id');
            var loggedId    ="<?php echo Yii::app()->session['loggedId'];?>";

             $.ajax({
                               type: 'POST',
                                url: '<?php echo Yii::app()->createAbsoluteUrl("registration/registration/StatusTypeCompany"); ?>',
                               //data:{'data':data,'email':email},
                               data:{'loggedId':loggedId,'id':id},

                            success:function(data){

                                           alert(data);
                                          
                                          // location.reload();  
                                            
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

     /*code to save the global info starts here*/
      $(".saveGlobalInfo").click(function(){
            var id=$(this).attr('id');
             var loggedId    ="<?php echo Yii::app()->session['loggedId'];?>";
            //alert(id)
             var data=$("#g"+id).serialize();
             //alert(data)
               $.ajax({
                               type: 'POST',
                                url: '<?php echo Yii::app()->createAbsoluteUrl("registration/registration/updateGlobalPriceByCompany"); ?>',
                               //data:{'data':data,'email':email},
                              // data:{'loggedId':loggedId,'id':id},
                                 data:data,
                            success:function(data){

                                           //alert(data);
                                           $("#services").show();
                                           $("#services").hide(1000); 
                                          // location.reload();  
                                            
                                           //$('.a'+id).hide();
                                          
                                          },
                               error: function(data) { // if error occured
                                    // alert(data);
                                     return false;
                                },
                             
                              dataType:'html'
                    }); 
      });

     /*code to save the global info ends here*/

     /*code to save the additional service starts here*/
      $(".saveGlobalAddiSer").click(function(){
            
              var loggedId    ="<?php echo Yii::app()->session['loggedId'];?>";
          
              var data=$("#additionalService").serialize();
              $.ajax({
                               type: 'POST',
                                url: '<?php echo Yii::app()->createAbsoluteUrl("registration/registration/saveGlobalAddiSer"); ?>',
                               //data:{'data':data,'email':email},
                              // data:{'loggedId':loggedId,'id':id},
                                 data:data,
                            success:function(data){

                                           //alert(data);
                                           //location.reload();
                                             $("#additional").show();
                                             $("#additional").hide(1000);                                     
                                          
                                          },
                               error: function(data) { // if error occured
                                    // alert(data);
                                     return false;
                                },
                             
                              dataType:'html'
                    }); 
      });
     /*code to save the additional services ends here*/
      /*code to add the price for additional service by company*/
      $(".additionalservices").click(function(){
           
            var id=$(this).attr('id');
            //alert(id)

            //var loggedId    ="<?php echo Yii::app()->session['loggedId'];?>";
          
              var data=$("#adnl"+id).serialize();
              $.ajax({
                               type: 'POST',
                                url: '<?php echo Yii::app()->createAbsoluteUrl("registration/registration/saveAdnlPriceCompany"); ?>',
                               //data:{'data':data,'email':email},
                              // data:{'loggedId':loggedId,'id':id},
                                 data:data,
                            success:function(data){

                                          // alert(data);
                                           //location.reload();
                                             $("#additional").show();
                                             $("#additional").hide(1000);                                     
                                          
                                          },
                               error: function(data) { // if error occured
                                    // alert(data);
                                     return false;
                                },
                             
                              dataType:'html'
                    }); 
      });
      /*code to upload the image*/
      $(".imgupload").click(function() {
                $("input[id='uploadImage']").click();
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
            $('#imagePreview1').attr('src', e.target.result);
         }
        reader.readAsDataURL(input.files[0]);
                }	

        });

      /*code to add price for services from dashboard*/
        var val=$( ".serviceType option:selected" ).text();
        var serviceTypeId=$( ".serviceType option:selected" ).val();
        var chk=$(".serviceType option:selected").val();
        if(chk !='3')
        { 
           $(".abc").hide();
        }
    
                  
           

            var companyId="<?php echo Yii::app()->session['loggedId'];?>";

         $.ajax({
                             type:'GET',  
                         url:"<?php echo Yii::app()->createUrl('registration/registration/ajaxServiceTypeFieldName')?>",
           
                          data:{'serviceTypeId':serviceTypeId,'companyId':companyId},
                          dataType: "json",
                   success:function(data)
                   {

                      
                      document.getElementById("formId").value = data['id'];
                      document.getElementById("bedroom").value = data['bedroom'];
                      document.getElementById("bathroom").value = data['bathroom'];
                      document.getElementById("PriceAdmin_property").value = data['property'];
                      document.getElementById("PriceAdmin_desk").value = data['desk'];
                      document.getElementById("PriceAdmin_cleaning_material_price").value=data['cleaning_material_price'];
                      
                      document.getElementById("PriceAdmin_living_room").value                =data['living_room'];
                      document.getElementById("PriceAdmin_kitchen_staircases").value         =data['kitchen_staircases'];
                      document.getElementById("PriceAdmin_carpets_interior_windows").value   =data['carpets_interior_windows'];
                      document.getElementById("PriceAdmin_cupboards").value                  =data['cupboards'];
                      document.getElementById("PriceAdmin_kitchen").value                    =data['kitchen'];
                      document.getElementById("PriceAdmin_staircases").value                 =data['staircases'];
                      document.getElementById("PriceAdmin_elevator").value                   =data['elevator'];
                

                      return true;
                     
                   
                   },
                   error: function (result) {
                    //alert("Error.")
                  
                        return false;
                  }
             });


        $(".serviceType").change(function(){

            var val=$( ".serviceType option:selected" ).text();

            
            var serviceTypeId=$( ".serviceType option:selected" ).val();

            var companyId="<?php echo Yii::app()->session['loggedId'];?>";

           

            if(val=="Office cleaning")
            {
                $(".abc").show();
                $(".notofc").hide();        
            }
            else
            {
                $(".abc").hide();
                $(".notofc").show();    
                //$("span").removeClass("error required");

            }

            //get the newly added field name 

            $.ajax({
                             type:'GET',  
                         url:"<?php echo Yii::app()->createUrl('registration/registration/ajaxServiceTypeFieldName')?>",
           
                          data:{'serviceTypeId':serviceTypeId,'companyId':companyId},
                          dataType: "json",
                   success:function(data)
                   {

                      
                      document.getElementById("formId").value = data['id'];
                      document.getElementById("bedroom").value = data['bedroom'];
                      document.getElementById("bathroom").value = data['bathroom'];
                      document.getElementById("PriceAdmin_property").value = data['property'];
                      document.getElementById("PriceAdmin_desk").value = data['desk'];
                      document.getElementById("PriceAdmin_cleaning_material_price").value=data['cleaning_material_price'];
                      
                      
                      document.getElementById("PriceAdmin_living_room").value                =data['living_room'];
                      document.getElementById("PriceAdmin_kitchen_staircases").value         =data['kitchen_staircases'];
                      document.getElementById("PriceAdmin_carpets_interior_windows").value   =data['carpets_interior_windows'];
                      document.getElementById("PriceAdmin_cupboards").value                  =data['cupboards'];
                      document.getElementById("PriceAdmin_kitchen").value                    =data['kitchen'];
                      document.getElementById("PriceAdmin_staircases").value                 =data['staircases'];
                      document.getElementById("PriceAdmin_elevator").value                   =data['elevator'];
                 

                      return true;
                     
                   
                   },
                   error: function (result) {
                    //alert("Error.")
                  
                        return false;
                  }
             });




        });

       $(".addPriceCompany").click(function(){
             var data=$("#formId").serialize();
             $.ajax({
                               type: 'POST',
                                url: '<?php echo Yii::app()->createAbsoluteUrl("registration/registration/AddCompanyPrice"); ?>',
                               //data:{'data':data,'email':email},
                               data:data,

                            success:function(data){

                                           //alert(data);
                                          
                                          // location.reload();  
                                            
                                           //$('.a'+id).hide();
                                          
                                          },
                               error: function(data) { // if error occured
                                    // alert(data);
                                     return false;
                                },
                             
                              dataType:'html'
                    }); 
       });

       /*code to open the message div listing here */
       $(".MsgDetail").click(function(){
          
             var id=$(this).attr('id');
             
             $(".dashmsglist").hide();
             $(".dashquote").hide();
             $("#msglist"+id).toggle();

             var loggedId    ="<?php echo Yii::app()->session['loggedId'];?>";
               /*call ajax to get the listing of messages starts here*/
               $.ajax({
                               type: 'POST',
                                url: '<?php echo Yii::app()->createAbsoluteUrl("registration/registration/ActiveJobsMsgList"); ?>',
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
       

       /*code to open the view quotes detail starts here*/
         $('.viewQuo').click(function(){
                var id=$(this).attr('id');

                $(".dashquote").hide();
                $(".dashmsglist").hide();
                $("#quote"+id).toggle();

                $("#msglis"+id).hide();

                //$(".msgbtn")            
         }); 
       /*code to open the view quotes detilas ends here*/ 

       //code to add the ticket tab
       // code to open the create message tab to admin
     $('.ticketmsgbtn').click(function(){
        
         var id=$(this).attr('id');
         $("#ticketcrtMsg"+id).toggle();

     }); 
      
     // code to get the listing for messages listing for ticket
      // messages listing on ticket tab click
      $(".ticket").live('click',function(){
            
             var loggedId    ="<?php echo Yii::app()->session['loggedId'];?>";
               /*call ajax to get the listing of messages starts here*/
               $.ajax({
                               type: 'POST',
                                url: '<?php echo Yii::app()->createAbsoluteUrl("registration/registration/TicketProviderMsgList"); ?>',
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

       // reply to admin from provider dashboard
        $(".ticketsndmsgprovider").live('click',function(){
              

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
                                url: '<?php echo Yii::app()->createAbsoluteUrl("registration/registration/replyticketfromProvider"); ?>',
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

     // code to update the price for end of tenancy cleaning
     $(".endOfTenancy").click(function(){
            
            var data=$("#formid1").serialize();
            $.ajax({
                               type: 'POST',
                                url: '<?php echo Yii::app()->createAbsoluteUrl("registration/registration/AddCompanyPriceEndTenancy"); ?>',
                               //data:{'data':data,'email':email},
                               data:data,

                            success:function(data){

                                           //alert(data);
                                          $("#endcleaning").show();
                                          $("#endcleaning").hide(5000);
                                          // location.reload();  
                                            
                                           //$('.a'+id).hide();
                                          
                                          },
                               error: function(data) { // if error occured
                                    // alert(data);
                                     return false;
                                },
                             
                              dataType:'html'
                    }); 


     });

    // code to update the price for domestic cleaning
    $('.domestic').click(function(){
          
            var data=$("#formid2").serialize();
            $.ajax({
                               type: 'POST',
                                url: '<?php echo Yii::app()->createAbsoluteUrl("registration/registration/AddCompanyPriceDomestic"); ?>',
                               //data:{'data':data,'email':email},
                               data:data,

                            success:function(data){

                                           //alert(data);
                                          $("#domst").show();
                                          $("#domst").hide(5000);
                                          // location.reload();  
                                            
                                           //$('.a'+id).hide();
                                          
                                          },
                               error: function(data) { // if error occured
                                    // alert(data);
                                     return false;
                                },
                             
                              dataType:'html'
                    }); 
    });

    // code to update the price for office cleaning
    $(".office").click(function(){
        var data=$("#formid3").serialize();
            $.ajax({
                               type: 'POST',
                                url: '<?php echo Yii::app()->createAbsoluteUrl("registration/registration/AddCompanyPriceOffice"); ?>',
                               //data:{'data':data,'email':email},
                               data:data,

                            success:function(data){

                                           //alert(data);
                                          $("#ofc").show();
                                          $("#ofc").hide(5000);
                                          // location.reload();  
                                            
                                           //$('.a'+id).hide();
                                          
                                          },
                               error: function(data) { // if error occured
                                    // alert(data);
                                     return false;
                                },
                             
                              dataType:'html'
                    }); 
    });
    
    // code to show the details for jobs requests on same page
    $(".jobsReq").click(function(){

         var id=$(this).attr('id');
         //alert(id);
         $('.request').hide();

         $('#reqjob'+id).toggle();

         
         var loggedId    ="<?php echo Yii::app()->session['loggedId'];?>";
         var ids         =$(".msgbooklst"+id).attr('id'); 
         $('.masgrender').hide();
         $("#msgrender"+ids).show();
         //$("#msgrender"+ids).hide();

         $.ajax({
                               type: 'POST',
                                url: '<?php echo Yii::app()->createAbsoluteUrl("registration/registration/jobRequestResPage"); ?>',
                               //data:{'data':data,'email':email},
                               data:{'id':id,'loggedId':loggedId},
                            success:function(data){
                                           //alert(data)
                                           $("#reqjob"+id).html(data);                                         
                                          },
                               error: function(data) { // if error occured
                                    // alert(data);
                                     return false;
                                },
                             
                              dataType:'html'
                    }); 

                // var ids=$(".msgbooklst"+id).attr('id');
                // ajax to show the updated quote price message list.
                 $.ajax({
                                                 type: 'POST',
                                                  url: '<?php echo Yii::app()->createAbsoluteUrl("registration/registration/ActiveJobsMsgList"); ?>',
                                                 //data:{'data':data,'email':email},
                                                 data:{'bookingId':ids,'loggedId':loggedId},

                                                 success:function(data){

                                                            // alert(data);
                                                             $("#msgrender"+ids).html(data);                                        
                                                            
                                                            },
                                                 error: function(data) { // if error occured
                                                      // alert(data);
                                                       return false;
                                                  },
                                               
                                                dataType:'html'
                     });

    });

   // code to add the distance price for companies
      $('.distance').click(function(){
            
             var data=$("#dist").serialize();
            $.ajax({
                               type: 'POST',
                                url: '<?php echo Yii::app()->createAbsoluteUrl("registration/registration/DistanceCoverage"); ?>',
                               //data:{'data':data,'email':email},
                               data:data,

                            success:function(data){

                                           //alert(data);
                                          $("#distcoverage").show();
                                          $("#distcoverage").hide(6000);
                                          // location.reload();  
                                            
                                           //$('.a'+id).hide();
                                          
                                          },
                               error: function(data) { // if error occured
                                    // alert(data);
                                     return false;
                                },
                             
                              dataType:'html'
                    }); 
      });
         
       $(".relistCompltdJob").click(function(){
             var id= $(this).attr('id');
             $(".list").hide();
             $(".relist"+id).toggle();
       });  
        
       // code to feedback by company
       $(".relistfeed").click(function(){
             
               var id=$(this).attr('id');
               var data=$("#feed"+id).serialize();
               $.ajax({
                               type: 'POST',
                                url: '<?php echo Yii::app()->createAbsoluteUrl("registration/registration/RelistJobCompany"); ?>',
                               //data:{'data':data,'email':email},
                               data:data,

                            success:function(data){

                                           //alert(data);
                                           $(".relist"+id).remove();
                                         // $("#distcoverage").show();
                                          //$("#distcoverage").hide(6000);
                                          // location.reload();  
                                            
                                           //$('.a'+id).hide();
                                          
                                          },
                               error: function(data) { // if error occured
                                    // alert(data);
                                     return false;
                                },
                             
                              dataType:'html'
                    });

                // show the updated record on Jobs Request
                /* var loggedId    ="<?php echo Yii::app()->session['loggedId'];?>";
                 $.ajax({
                               type: 'POST',
                                url: '<?php echo Yii::app()->createAbsoluteUrl("registration/registration/JobsRequestTabRelistJob"); ?>',
                               data:{'loggedId':loggedId},
                               //data:data,

                            success:function(data){

                                           //alert(data);
                                           $("#request").append(data);
                                        
                                          
                                          },
                               error: function(data) { // if error occured
                                    // alert(data);
                                     return false;
                                },
                             
                              dataType:'html'
                    }); */
       });

       /*code to open the inner div in active jobs message*/
        $('.msgbtn').click(function(){
             
              var id=$(this).attr('id');
             $("#crtMsg"+id).toggle();
            // $("#msglis"+id).toggle();
             
             //var loggedId    ="<?php echo Yii::app()->session['loggedId'];?>";
               /*call ajax to get the listing of messages starts here*/
              /* $.ajax({
                               type: 'POST',
                                url: '<?php echo Yii::app()->createAbsoluteUrl("registration/registration/ActiveJobsMsgList"); ?>',
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
                    });*/ 
        }); 

       
});



$(function() {
$( "#tabs" ).tabs();

});


/*function to send the message to comapny*/
function createmsgFromCompany()
 {
  
   var val =$("#ConversationMsg_subject").val();
   var msg =$("#MsgDetails_msg").val();

   var data=$("#sendmessage").serialize();
  
  // var email="<?php echo $_SESSION['_registration__id'];?>";
       if(val!='' && msg!='')
       { 
            $.ajax({
                       type: 'POST',
                        url: '<?php echo Yii::app()->createAbsoluteUrl("registration/registration/createmsgFromCompany"); ?>',
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

function send()
 {
        
    $('#dashboard').on('submit',(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
       // alert(formData)
        $.ajax({
            type:'POST',
            url: '<?php echo Yii::app()->createAbsoluteUrl("registration/registration/updateprofile"); ?>',
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            success:function(data){
              //alert(data);
              $("#flash").show();
              $("#flash").hide(1000); 
              //$("#imagePreview1").html(data);
              //$(".image").attr("src",data);

               // console.log("success");
                //console.log(data);
            },
            error: function(data){
                //console.log("error");
                //console.log(data);
                return false;
            }
        });
    }));



   

/*   var data=$("#dashboard").serialize();
   var val=$("#my_file").val();
   
  // var email="<?php echo $_SESSION['_registration__id'];?>";

            $.ajax({
                       type: 'POST',
                        url: '<?php echo Yii::app()->createAbsoluteUrl("registration/registration/updateprofile"); ?>',
                       //data:{'data':data,'email':email},
                       data:data,

                     success:function(data){
                                  alert(data);
                                    //location.reload();
                                   // $(".flash-success").load(window.location + " .flash-success");

                                    //$("#flash").html(data);
                                    $("#flash").show();
                                     $("#flash").hide(1000); 
                                    //return true; 
                                  },
                       error: function(data) { // if error occured
                             //alert("Error occured.please try again");
                            // alert(data);
                             return false;
                        },
                     
                      dataType:'html'
            });*/
                                   
 
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
function msgNotification()
{
        var loggedId    ="<?php echo Yii::app()->session['loggedId'];?>";
        var last       =$("#msgnotify").val();
          
        $.ajax({
                               type: 'POST',
                                url: '<?php echo Yii::app()->createAbsoluteUrl("registration/registration/msgNotiCompany"); ?>',
                               //data:{'data':data,'email':email},
                               data:{'loggedId':loggedId,'last':last},
                               //dataType: "json",
                            success:function(data){

                                          // alert(data);
                                           //document.getElementById("msgcount").innerHTML = data[0];
                                           

                                           $("#msgcount").html(data);
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

function chkInboxMsgNoti()
{
       var loggedId    ="<?php echo Yii::app()->session['loggedId'];?>";
        

        $.ajax({
                               type: 'POST',
                                url: '<?php echo Yii::app()->createAbsoluteUrl("registration/registration/autoChkMsgNotiComp"); ?>',
                               //data:{'data':data,'email':email},
                               data:{'loggedId':loggedId},

                            success:function(data){

                                           alert(data);
                                           //$("#msgcount").html(data);
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

/*add the message for particular booking detail in active jobs provider dashboard*/
function activeJobsMsg(id)
{    
     var sub     =$.trim($("#sub"+id).val());
     
     var msg1    =$.trim($("#msg"+id).val());   
     
     var data=$("#CretMsg"+id).serialize();
     
     if(sub!='' && msg1!='')
     {
        $.ajax({
                               type: 'POST',
                                url: '<?php echo Yii::app()->createAbsoluteUrl("registration/registration/ActiveJobsAddMsgCompany"); ?>',
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
function activeJobsInCompany()
{
     var loggedId    ="<?php echo Yii::app()->session['loggedId'];?>";
   
        $.ajax({
                               type: 'POST',
                                url: '<?php echo Yii::app()->createAbsoluteUrl("registration/registration/activeJobsInCompany"); ?>',
                               //data:{'data':data,'email':email},
                               data:{'ajaxlogId':loggedId},

                            success:function(data){

                                           //alert(data);
                                           //$("#msgcount").html(data);
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
 $(function() {
       var js_array = [<?php echo '"'.implode('","', $uniquePost).'"' ?>];

      //var availableTags = [];
        $( "#ServiceUser_zipcode" ).autocomplete({source: js_array});
});
// function to create ticket 
 function CreateTicketProvider()
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
                                url: '<?php echo Yii::app()->createAbsoluteUrl("registration/registration/TicketAddProvider"); ?>',
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
function showimagepreview()
{

   if (input.files && input.files[0]) 
            {
                var filerdr = new FileReader();
                filerdr.onload = function(e) 
                {
                    $('#imgprvw').attr('src', e.target.result);
                }
                filerdr.readAsDataURL(input.files[0]);
            }	
}

function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('.image')
                        .attr('src', e.target.result)
                        .width(136)
                        .height(77);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
        
        function showHideFields(id)
        {
        	if( id == 'price')
        	{
        		$(".boxPrice").attr("disabled", false);
        		$(".boxHours").attr("disabled", true);
        	}
        	else
        	{
        		$(".boxPrice").attr("disabled", true);
        		$(".boxHours").attr("disabled", false);
        	}
        }
</script>

<div class="profile_outer">
    <div class="detail_outer sign_2"> 
      <!-- <h4> Detail </h4> -->
      
      <div id="tabs">
        <ul>
          <li><a href="#request"> Jobs Request</a></li>
          <li><a href="#active">Active Jobs</a></li>
          
          <li><a href="#previous">Completed Jobs</a></li>
          <li><a href="#profile">Profile </a></li>
           <li><a href="#Price" id="re" >Services</a></li>
           <li><a href="#messages" class="ticket">Ticket <span id="msgcount"></span></a></li>
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
               <p class="quote">
              
                  <?php if(empty($companyRequest->booking->additionalParticularPrices) && empty($companyRequest->booking->particularPrices))  { ?>
                   <a href="javascript:void(0)">
                      <span class="ng-binding">£<?php echo $companyRequest->booking['price'];?></span>
                   </a>
                  <?php } else {  

                           if(!empty($companyRequest->booking->additionalParticularPrices)) {
                         foreach(array_slice($companyRequest->booking->additionalParticularPrices,0,1) as $total)
                         {
                         	   $tot=$total['total_price'];
                        	
                         //echo "<pre>";print_r($tot);die;
                          
                          //echo "<pre>";print_r($companyRequest->booking->particularPrices[0]['particular_price']);die;
                  	?>
                            
                                 <a href="#">
                                     <span class="ng-binding">£<?php echo $tot; ?></span>
                                </a>
                              
                              
                                         
                                

                   <?php }  } else { ?>
                            <a href="#">
                                              <span class="ng-binding">£<?php echo $companyRequest->booking->particularPrices[0]['particular_price'];?></span>
                                         </a>
                   <?php } } ?>
               </p>
              <span class=""><?php //echo $companyRequest['cleaningtime'];?></span>
              <span class=""><?php //echo date('y-m-d',strtotime($companyRequest['cleaningdate']));?></span> 
              <!--<a class="login_in greenbtn MsgDetail" id="<?php //echo $companyRequest->booking['id'];?>" href="javascript:void(0)">Message</a>
               -->
              <a class="login_in greenbtn accept" href="javascript:void(0)" id="<?php echo $companyRequest['id'] ?>">Accept</a>
              <a class="login_in greenbtn decline" href="javascript:void(0)" id="<?php echo $companyRequest['id'] ?>">Decline</a> 
             <!-- <a class="login_in greenbtn viewQuotes" id="<?php //echo $companyRequest['id'];?>" href="<?php //echo Yii::app()->createUrl('registration/registration/chnagequotesDashboardSpeciUser',array('id'=>$companyRequest['id'],'booking_id'=>$companyRequest->booking['id']))?>">View Quotes</a>
              -->
              <input type ="hidden" name="bookingid" value="<?php echo $companyRequest['booking_id'];?>" class="msgbooklst<?php echo $companyRequest['id'];?>" id="<?php echo $companyRequest['booking_id'];?>">
              <a class="login_in greenbtn  jobsReq" id="<?php echo $companyRequest['id'];?>" href="javascript:void(0)">View Quotes</a>
                
              </div>
               
          </div>
            <div class="request" id="reqjob<?php echo $companyRequest['id'];?>" style="display:none;">  </div>

             <div id="msgrender<?php echo $companyRequest->booking['id'];?>" class="masgrender">
                               </div> 
             <!-- div to show the message section here-->
             <?php /* <div id="msglist<?php echo $companyRequest->booking['id'];?>" style="display:none;" class="dashmsglist">
                          
                       <div id="msgrender<?php echo $companyRequest->booking['id'];?>">
                               </div> 

                             <div class="msgbtn" id="<?php echo $companyRequest->booking['id'];?>">
                                <h5>Create New Message</h5>
                             </div>

                                            <div id="crtMsg<?php echo $companyRequest->booking['id'];?>" style="display:none;" class="form">
                                                    <?php $form=$this->beginWidget('CActiveForm', array(
                                                        'id'=>'CretMsg'.$companyRequest->booking['id'],
                                                        'enableAjaxValidation'=>false,
                                                        'htmlOptions'=>array(
                                                        'onsubmit'=>"return false;",
                                                       
                                                       ),
                                                     )); ?> 
                                                      <?php  $loggedId= Yii::app()->session['loggedId'];?>
                                                     <input type="hidden" name="reciverId" value="<?php echo $d->customer['id'];?>"> 
                                                     <input type="hidden" name="senderId" value="<?php echo $loggedId;?>"> 
                                                      <input type="hidden" name="bookingId" value="<?php echo $companyRequest->booking['id'];?>">
                                                         <div class="pref_form" id="activesub">
                                                        <p>
                                                              <?php  echo $form->labelEx($msg,'subject',array('label'=>'Subject')); ?>
                                                              <?php  echo $form->textField($msg,'subject',array('id'=>'sub'.$companyRequest->booking['id'])); ?>                                                   
                                                           <!--input type="text" name="subject" value="/-->
                                                        </p>
                                                        </div>
                                                        <div class="pref_form" id="activemsg">
                                            
                                                            
                                                                 <?php echo $form->labelEx($msgDetail,'msg',array('label'=>'Message')); ?>
                                                                 <?php echo $form->TextArea($msgDetail,'msg',array('id'=>'msg'.$companyRequest->booking['id'])); ?>
                                                                     
                                                            
                                                        </div>

                                                       <div class="pref_form" id="button">
                                                        <?php echo CHtml::submitButton('Send',array('class'=>'login_in5 greenbt ','id'=>$companyRequest->booking['id'],'onclick'=>'activeJobsMsg(id);')); ?>
                                                       </div> 
                                                    <?php $this->endWidget(); ?>

                                           </div>

                              
                         
                      </div>  */ ?>

        </div>
         
         
      
        <?php } ?>
        <!-- Job requests from customer ends here-->


        <!-- active -->
        <div id="ajax">
        <?php foreach(array_reverse($dashboard['bookings']) as $d) { 
                 
                  
                 //echo "<pre>";print_r($d);
                 //echo $d->companyRequests['job_status'];
                  if(!empty($request))
                  {  
                    if(in_array($d->id,$request))
                    { 
          ?>
        <div id="active">
          <div class="active_left">
            <div class="left-1"> <img src="<?php echo Yii::app()->request->baseUrl; ?>/banner/<?php echo $d->serviceType['image']; ?>" alt=""> </div>
            <div class="right-2">
              <h4> <?php echo $d->customer['cname']." ".$d->customer['clname']?> </h4>
              <p><?php echo $dashboard['city'];?> to <?php echo $d->customerAddress['address'];?></p>
             <!-- <p><span>254 miles</span></p> -->
            </div>
          </div>
          <div class="active_left active_right">
            <!--<div class="right-2 left-01">
              <h4> Home </h4>
              <p>from</p>
              <p><span>254 miles</span></p>
            </div> -->
            <div class="right-02">
              <p class="quote quote<?php echo $d->id; ?>"> 
                <a href="#"><span class="ng-binding">£<?php echo $d->price;?></span></a>
              </p>
              <p class="price<?php echo $d->id; ?>" style="display:none;"> <input type="text" class="sizeinput" name="price" value="<?php echo $d->price;?>" id="text<?php echo $d->id;?>"></p>
              <!--<a class="login_in greenbtn" href="#">VIEW QUOTES</a> -->
              <a class="login_in greenbtn MsgDetail" id="<?php echo $d->id;?>" href="javascript:void(0)">Message</a>
               
              <a class="login_in greenbtn viewQuo" id="<?php echo $d->id;?>" href="javascript:void(0)">View Quotes</a>
              <!--<a class="login_in greenbtn viewQuo" id="<?php //echo $d->id;?>" href="<?php //echo Yii::app()->createUrl('registration/registration/viewquotesDashboard',array('id'=>$d->id))?>">View Quotes</a>
               -->
               <!--
               <a class="login_in greenbtn editQuotes quot<?php //echo $d->id;?>" id="<?php //echo $d->id;?>" href=" javascript:void(0)">Edit Price</a>
               -->
               <div class="update<?php echo $d->id;?>" style="display:none">
                    <a class="login_in greenbtn updateQuotes" id="<?php echo $d->id;?>" href="javascript:void(0)">Udpate</a>
                    <a class="login_in greenbtn cancel" id="<?php echo $d->id;?>" href="javascript:void(0)">Cancel</a>
            
               </div>

              </div>
          </div>
           <!--  view quotes detils here starts-->

            <div id="quote<?php echo $d->id;?>" style="display:none;" class="dashquote">
                 <div class="about_in1" id="abt">
                     <div class="clean">
                      <div class="extouter">
                                  <h5>Details</h5> 
                                  <div class="ext">
                                          <span class="extra">Name:<?php echo " ".$d->customer['cname']." ".$d->customer['clname'];?>
                                                
                                        </span>
                                          <!--<p >Time:       <?php //echo $d->companyRequests['cleaningtime'];?></p> -->
                                  </div>
                                  <div class="ext">
                                          <span class="extra">Address:<?php echo " ".$d->customerAddress['address'];?>                                 
                                        </span>
                                        
                                          <!--<p >Time:       <?php //echo $d->companyRequests['cleaningtime'];?></p> -->
                                  </div>
                                   <div class="ext">
                                        
                                        <span class="extra">Zip code:<?php echo " ".$d->customerAddress['zipcode'];?>
                                                
                                        </span>
                                          <!--<p >Time:       <?php //echo $d->companyRequests['cleaningtime'];?></p> -->
                                  </div>
                                 
                                   <div class="ext">
                                          <span class="extra">
                                                Address:    <?php echo " ".$d->customerAddress['address'];?>
                                            
                                        </span>
                                          <!--<p >Time:       <?php //echo $d->companyRequests['cleaningtime'];?></p> -->
                                  </div>
                                   <div class="ext">
                                          <span class="extra">
                                                Price:      <?php echo " ".$d['price'];?>
                                        </span>
                                    </div>

                     </div>
                      <div class="extouter">
                             <h5>Service Type</h5> 
                             <div class="ext">
                                 <span class="extra">ServiceType:<?php echo " ".$d->serviceType['service_name'];?></span>
                                                
                            </div>
                      </div>

                      <div class="right_outer">

                      <?php 
                          $res=$d['cleaningDetail'];
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
                        $res1=$d['additional'];
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
            </div> 

           <!-- -view quotes details ends here->


             <!-- messaging div to open on click starts here-->
               

               <div id="msglist<?php echo $d->id;?>" style="display:none;" class="dashmsglist">
                          
                       <div id="msgrender<?php echo $d->id;?>">
                               </div> 

                             <div class="msgbtn" id="<?php echo $d->id;?>">
                                <h5>Create New Message</h5>
                             </div>

                                            <div id="crtMsg<?php echo $d->id;?>" style="display:none;" class="form">
                                                    <?php $form=$this->beginWidget('CActiveForm', array(
                                                        'id'=>'CretMsg'.$d->id,
                                                        'enableAjaxValidation'=>false,
                                                        'htmlOptions'=>array(
                                                        'onsubmit'=>"return false;",/* Disable normal form submit */
                                                       
                                                       ),
                                                     )); ?> 
                                                      <?php  $loggedId= Yii::app()->session['loggedId'];?>
                                                     <input type="hidden" name="reciverId" value="<?php echo $d->customer['id'];?>"> 
                                                     <input type="hidden" name="senderId" value="<?php echo $loggedId;?>"> 
                                                      <input type="hidden" name="bookingId" value="<?php echo $d->id;?>">
                                                         <div class="pref_form" id="activesub">
                                                        <p>
                                                              <?php  echo $form->labelEx($msg,'subject',array('label'=>'Subject')); ?>
                                                              <?php  echo $form->textField($msg,'subject',array('id'=>'sub'.$d->id)); ?>                                                   
                                                           <!--input type="text" name="subject" value="/-->
                                                        </p>
                                                        </div>
                                                        <div class="pref_form" id="activemsg">
                                            
                                                            
                                                                 <?php echo $form->labelEx($msgDetail,'msg',array('label'=>'Message')); ?>
                                                                 <?php echo $form->TextArea($msgDetail,'msg',array('id'=>'msg'.$d->id)); ?>
                                                                     
                                                            
                                                        </div>

                                                       <div class="pref_form" id="button">
                                                        <?php echo CHtml::submitButton('Send',array('class'=>'login_in5 greenbt ','id'=>$d->id,'onclick'=>'activeJobsMsg(id);')); ?>
                                                       </div> 
                                                    <?php $this->endWidget(); ?>

                                           </div>

                              
                         
                      </div>
                      

      
             <!-- messaging div to open on click ends here  -->
        </div>
        <?php }  } } ?>
        </div>
        <!-- active end-->
        <div class="clear"></div>
        <!-- messages -->
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
                                                              <?php  echo $form->labelEx($msg,'subject'); ?>
                                                              <?php  echo $form->textField($msg,'subject',array('id'=>'ticketsubject')); ?>                                                   
                                                           
                                                        </p>
                                                        </div>
                                                        <div class="pref_form" id="activemsg">
                                            
                                                            
                                                                 <?php echo $form->labelEx($msgDetail,'msg',array('label'=>'Message')); ?>
                                                                 <?php echo $form->TextArea($msgDetail,'msg',array('id'=>'ticketmsg')); ?>
                                                                     
                                                           
                                                        </div>

                                                       <div class="pref_form" id="button">
                                                        <?php echo CHtml::submitButton('Send',array('class'=>'login_in greenbtn snd ','onclick'=>'CreateTicketProvider();')); ?>
                                                       </div> 
                                                    <?php $this->endWidget(); ?>

                                           </div>
         </div>
        <?php /*<div id="messages" class="ui-tabs ui-tabs-panel messg">
              

               <?php  if(!empty($finalTo)) { ?>
                  <a id="create" href="javascript:void(0)">Create Message</a>
                <?php } ?> 
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
               <?php 
                 //echo "<pre>";print_r($finalTo);die;
                if(!empty($finalTo)) { ?>     
              <div class="pref_right" id="createmsg" style="display:none;">
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

                    
                      <?php echo CHtml::submitButton('Submit',array('class'=>'login_in greenbtn ','id'=>'sendMsg','onclick'=>'createmsgFromCompany();')); ?>
                       
                      <?php //echo CHtml::submitButton('Submit',array('class'=>'login_in greenbtn ','id'=>'submit','onclick'=>'send();')); ?>
                       
                      <div id="flash-success"></div>
                       
                      


                    </div>
                    <?php  } ?>
                    <?php $this->endWidget(); ?>
           <!-- Create Message ends here -->



          <div id="mailbox-inbox" class="ajax-paged"><!-- class ajax-paged required to make pagination work -->
            <div id="mailbox-selector">
              <p><a id="inbox" href="javascript:void(0)">Inbox </a>| <a id="sent" href="javascript:void(0)">Sent</a></p>
            </div>
            <div class="grid-header-row"> <span class="subject">Subject</span> <span class="username">From</span> <!--<span class="lowest_bid">Quote</span> --> <span class="date"><a href="/ajax-dashboard-customer-messages/sort-field-created_at/sort-direction-asc" class="">Received</a></span> <span class="delete-message bluebtn dlt">Delete</span> </div>
            <?php 
                 $loggedId =Yii::app()->session['loggedId'];
                 
                 $lastId =end($inbox);
                  $last  =$lastId['id'];
                  echo "<input type='hidden' id='msgnotify' value='". $last ."'>";  
                 foreach($inbox as $msg) { 
                     
                       //foreach($companyN as $name)
                       //{ 
                         //    foreach($numInbox as $count)
                           //    { 
              ?>
            <div class="message close has-more read- first-row unread" id="<?php echo $msg->id;?>" data-id="17602932">
              <div class="status read"></div>
              <div class="subject"><?php echo $msg->conversation['subject'];?></div>
              <div class="username"><span class="provider accredited">
               <?php 
                   if(!empty($companyN)) {
                        foreach($companyN as $name)
                       { 
                ?>
                           <?php echo $name['cname'].' '.$c['clname'];?>
               <?php } } else { ?>

               <?php echo "Admin";?>
              <?php } ?> 
              <!--<span class="badge_container"> 
                  <img title="" alt="" src="images/badge_provider_accredited.png" class="accredited">
              </span> --> 
              <span class="jobs">
                      
                        
                     (<?php 

                     $count=MsgDetails::model()->findAll(array('condition'=>'conversation_id=:conversation_id AND tomsg=:tomsg AND inbox_dlt_status=:status','params'=>array(
                                 
                                   ':conversation_id'=>$msg->conversation_id,
                                   ':tomsg'          =>$loggedId, 
                                   ':status'         =>0,
                    )));
                     echo count($count);?>)
                     
              </span>
              </span></div>
              <!--<div class="lowest_bid"><a href="/view-quotes/1849850" class="accept_bid">£525</a></div> -->
              <div class="date"><span title="2014-09-29 23:40:05" class="time-label"><!-- 14 days ago --> 
              <?php  //$dt=strtotime($msg->date); echo date("D", $dt);?>
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
                <?php 
                      $dateTime = new DateTime($msg->date); 
                      echo "(";
                      echo $dateTime->format('d-M-Y H:i:s');
                      echo ")"; 
                ?>
              </span></div>
              <div class="delete">
                <input type="checkbox" name="check[]" value="<?php echo $msg->conversation['id'];?>" id="delete-comment-17602932">
              </div>
            </div>
            
            <div class="message close has-more read- first-row unread detailmsg<?php echo $msg->id;?>" style="display:none;">
                 
                 <input type="hidden" class="subject<?php echo $msg->conversation['id'];?>" value="<?php echo $msg->conversation['subject'];?>">
                 <div class="rply">
                   <label>Reply Now</label>
                 </div>  
                <div class="replysection">
                         
                          
                             <input type="hidden" id="recv<?php echo $msg->conversation['sender_id'];?>" value="<?php echo $msg->conversation['sender_id'];?>">
                          <?php echo CHtml::textArea('Text','',array('class'=>'text'.$msg->conversation['id'])); ?>
                               <div class="clear"></div> 
                          <?php echo CHtml::submitButton('Send',array('class'=>'login_in greenbtn sndmsg ','id'=>$msg->conversation['id'].'-'.$msg['user_id'])); ?>
                          
                 </div>
                 <?php //echo "<pre>";print_r($inboxDtal);die;?>     
                <div class="clear"></div>  
               <div id="conversationmsgdiv">
               <div class="main" id="<?php echo $msg->conversation['id'];?>">
                         <?php 
                              
                               
                               echo "Message Detail."."</br>";
                               echo "<div class='clear'></div>";
                              
                               foreach($inboxDtal as $detail)
                               {  
                                   
                                   foreach($detail as $d)
                                   {  
                                       if($msg->conversation_id==$d['conversation_id'])
                                       {   
                                                 if(Yii::app()->session['loggedId']==$d['tomsg'])
                                                 { 
                                                     echo "<input type='hidden' id='".$d['conversation_id']."' class='append'>";
                                                     echo "<div class='bubbledLight appendmsg".$d['id']."'>";    
                                                          echo $d['msg'];
                                                     echo "</div>"."</br>";
                                                 }
                                                 else
                                                 {
                                                     echo "<input type='hidden' id='".$d['conversation_id']."' class='append'>";
                                                     echo "<div class='bubbledRight appendmsg".$d['id']."'>";    
                                                          echo $d['msg'];
                                                     echo "</div>"."</br>";
                                                 }     
                                       } 
                                   }  
                               } 
                         ?>
               </div>
               </div>

            </div>

            <?php } //} //} ?>
            
          </div>


        </div> */?>
        <!-- messages end-->


        <!-- sent box div starts here -->
         <?php /* <div id="sentdiv" class="ui-tabs ui-tabs-panel messg">

            
          <div id="mailbox-inbox" class="ajax-paged"><!-- class ajax-paged required to make pagination work -->
            <div id="mailbox-selector">
              <p><a id="choose-inbox" href="javascript:void(0)">Inbox</a> | <a id="choose-sent" href="javascript:void(0)">Sent</a></p>
            </div>
            <div class="grid-header-row"> <span class="subject">Subject</span> <span class="username">To</span> <!--<span class="lowest_bid">Quote</span> --> <span class="date"><a href="/ajax-dashboard-customer-messages/sort-field-created_at/sort-direction-asc" class="">Received</a></span> <span class="delete-message bluebtn sentboxdlt">Delete</span> </div>
            <?php 
                    //echo "<pre>";print_r($companyName);die;  
                 foreach($sentBox as $msg) { 
                    
                         // if($msg['sent_dlt_status']==0)
                         // { 
                        //foreach($companyName as $name)
                        //{
                           
              ?>
            <div class="message close has-more read- first-row unread" id="<?php echo $msg->id;?>" data-id="17602932">
              <div class="status read"></div>
              <div class="subject"><?php echo $msg->conversation['subject'];?></div>
              <div class="username">
              <span class="provider accredited">
                       <?php echo $name['cname']." ".$name['clname'];?>
              <span class="badge_container"> <img title="" alt="" src="images/badge_provider_accredited.png" class="accredited"></span> 
              <span class="jobs">
                        

                        (<?php 

                     $count=MsgDetails::model()->findAll(array('condition'=>'conversation_id=:conversation_id AND user_id=:user_id AND sent_dlt_status=:status','params'=>array(
                                 
                                   ':conversation_id'=>$msg->conversation_id,
                                   ':user_id'          =>$loggedId, 
                                   ':status'           =>0,
                    )));
                     echo count($count);?>)

              </span>
              </span></div>
              
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
                <?php echo CHtml::textArea('Text','',array('class'=>'text12'.$msg->conversation['id'])); ?>
                 <div class="clear"></div> 
                <?php //if($msg->conversation['reciver_type']=='customer')?> 
                <?php echo CHtml::submitButton('Send',array('class'=>'login_in greenbtn sndmsg1 ','id'=>$msg->conversation['id'].'-'.$msg->conversation['reciver_id'])); ?>
                      
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

            <?php } //} ?>
            <!--<div class="message close has-more read- first-row unread" id="ajax-get-message-thread-17602932" data-id="17602932">
              <div class="status unread"></div>
              <div class="subject">House</div>
              <div class="username"><span class="provider accredited">RRunnerT<span class="badge_container"> <img title="" alt="" src="images/badge_provider_accredited.png" class="accredited"></span> <span class="jobs">(17)</span></span></div>
              <div class="lowest_bid"><a href="/view-quotes/1849850" class="accept_bid">£525</a></div>
              <div class="date"><span title="2014-09-29 23:40:05" class="time-label">14 days ago</span></div>
              <div class="delete">
                <input type="checkbox" name="delete-comment-17602932" value="17602932" id="delete-comment-17602932">
              </div>
            </div> -->
          </div>
        </div> */?>



        <!-- sent box div ends here    -->
        <div class="clear"></div>
        
        <!-- previous -->
          <?php 

              //$res=array_combine(keys, values)
           //foreach($bookingDetails['bookings'] as $book) { 
                
                  //echo "<pre>";print_r($book->serviceReviews);
                  
                  
                 // if(in_array($book->id,$bookIds) )
                 //  { 

                    foreach($comRest as $reqst)
                    {	
          ?>
        <div id="previous" class="prev<?php //echo $book->id;?>">
         <div class="active_left">
            <div class="left-1"> <img src="<?php echo Yii::app()->request->baseUrl; ?>/banner/<?php echo $reqst->booking->serviceType['image']; ?>" alt=""> </div>
            <div class="right-2 jobs">
              <h4> <?php echo $reqst->customer['cname']." ".$reqst->customer['clname'];?> </h4>
              <p><?php echo $reqst->service['city'];?> to <?php echo $reqst->customer['city'];?></p>
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
              <a class="login_in greenbtn save_button bluebtn relistCompltdJob" id="<?php echo $reqst->booking['id'];?>" href="javascript:void(0);"> RELIST </a> </div>
              </div>

                  
          </div>
                  <div class="clear"></div>
                    <!-- relist the job by comment section-->
                 <div class="list relist<?php echo $reqst->booking['id'];?>" id="<?php echo $reqst->booking['id'];?>" style="display:none;">
                         
                                   <div class="formjob">
					                  <?php  $form=$this->beginWidget('CActiveForm', array(
					                              'action'=> Yii::app()->createUrl('registration/registration/RelistCompanyJob'),
					                              'id'=>'feed'.$reqst->booking['id'],
					                              'enableClientValidation'=>true,
					                              'htmlOptions'=>array('onsubmit'=>'return false'),
					                              'clientOptions'=>array(
					                              'validateOnSubmit'=>true,
					                              ),
					                          )); ?>
			                          <?php $loggedId= Yii::app()->session['loggedId'];?>
			                         <input type="hidden" name="loggedId" value="<?php echo $loggedId; ?>"> 
			                         <input type="hidden" name="booking_id" value="<?php echo $reqst->booking['id'];?>">
			                         
			                         <input type="hidden" name="customer_id" value="<?php echo $reqst->customer['id'];?>">
                                       <div class="labeljob">
                                         <?php echo $form->labelEx($msgDetail,'msg',array('label'=>'Comment')); ?>
					                          <div class="fieldjob"> 
					                          <?php echo $form->TextArea($msgDetail,'msg',array('id'=>'msgRlist','value'=>'Please review again.')); ?>
					                   </div>
					                   </div>                                               
					                    <?php echo CHtml::submitButton('Feedback',array('class'=>'relistfeed' ,'id'=>$reqst->booking['id'])); ?>
					             <?php $this->endWidget(); ?>
					           </div>
                 </div>  
               
        </div>
            
           

        <?php  } //} }  ?>
       
        <div class="clear"></div>
        
        <!-- profile -->
        <div id="profile">
                  <div class="active_left pref">
                  <div id="imagePreview54"></div>
                  
                   <?php $form=$this->beginWidget('CActiveForm', array(
                            'id'=>'dashboard',
                            'enableAjaxValidation'=>false,
                                'htmlOptions'=>array('enctype'=>'multipart/form-data',
                               'onsubmit'=>"return false;",
                               'onkeypress'=>" if(event.keyCode == 13){ send(); } " 
                             ),
                    )); ?>
                    <div class="pref_left" id="imagePreview1"> 
                          <?php if(!empty($dashboard->company_logo)) { ?>
                               
                               <img class="image" src="<?php echo Yii::app()->request->baseUrl; ?>/CompanyLogo/<?php echo $dashboard->company_logo;?>" alt="" class="imgupload1"> 
                          <?php } else { ?>
                               
                                 <img class="image" src="<?php echo Yii::app()->request->baseUrl; ?>/CompanyLogo/download.jpg?>" alt="" class="imgupload1" > 

                          <?php }?> 
                           <?php echo CHtml::submitButton('Upload',array('class'=>'imgupload','id'=>'upload')); ?>
                         
                    </div>
                    
                   

                     <?php /*$form=$this->beginWidget('CActiveForm', array(
                            'id'=>'dashboard',
                            'enableAjaxValidation'=>false,
                                'htmlOptions'=>array('enctype'=>'multipart/form-data',
                               'onsubmit'=>"return false;",
                               'onkeypress'=>" if(event.keyCode == 13){ send(); } " 
                             ),
                    )); */?>
                 <!-- <input id="uploadFile" type="file" name="image" class="upload" style="display:none;"/> 
                     -->
                     <div class="uploadFile" style="display:none">
                      <?php echo $form->fileField($model,'company_logo',array('id'=>'uploadImage','onchange'=>"readURL(this);")); ?>
                    </div>
                    <div class="pref_right">
                      <div class="pref_form">
                        <p>
                          <?php echo $form->labelEx($model,'company_name',array('label'=>'Company Name')); ?>
                          <?php echo $form->textField($model,'company_name',array('value'=>$dashboard->company_name,'class'=>'same')); ?>
                          <?php echo $form->error($model,'company_name'); ?>
                        </p>
                        <p>
                          <?php echo $form->labelEx($model,'email',array('label'=>'E-mail address:')); ?>
                          <?php echo $form->textField($model,'email',array('value'=>$dashboard->email,'class'=>'same','id'=>'email')); ?>
                          <?php echo $form->error($model,'email'); ?>
        
                        </p>
                        <p>
                          <?php echo $form->labelEx($model,'city',array('label'=>'City:')); ?>
                          <?php echo $form->textField($model,'city',array('value'=>$dashboard->city,'class'=>'same')); ?>
                          <?php echo $form->error($model,'city'); ?>
        
                        </p>
                        <p>
                          <?php echo $form->labelEx($model,'phone',array('label'=>'Mobile no:')); ?>
                          <?php echo $form->textField($model,'phone',array('value'=>$dashboard->phone,'class'=>'same')); ?>
                          <?php echo $form->error($model,'phone'); ?>
        
                        </p>
                        <p>
                          <?php echo $form->labelEx($model,'zipcode',array('label'=>'Post Code:')); ?>
                          <?php echo $form->textField($model,'zipcode',array('value'=>$dashboard->zipcode,'class'=>'same')); ?>
                          <?php echo $form->error($model,'zipcode'); ?>
        
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
                         <input type="password" name="ServiceUser[cpassword]" id="cpassword" >
                          <?php //echo $form->labelEx($model,'cpassword',array('label'=>'Confirm Password:')); ?>
                          <?php //echo $form->passwordField($model,'cpassword'); ?>
                          <?php //echo $form->error($model,'cpassword'); ?>
                        </p>
                      </div>
                      <!--<a href="#" class="login_in greenbtn save">Save</a> -->
                      <?php echo CHtml::submitButton('Submit',array('class'=>'login_in1 greenbtn1 ','id'=>'submit','onclick'=>'send();')); ?>
                       
                      
                       
                      <div id="flash" style="display:none">Changes Saved</div>
                       
                      


                    </div>
                  
                   <?php $this->endWidget(); ?>

                  </div>
        </div>
              <!-- Services edit statrts here-->
              <?php 

              ?>
              <div id="Price">
                   
                   

                  <div class="active_left pref">
                    <div class="pref_left"> 
                          
                                   Service Types
                    </div>                   
                       
                         <div class="pref_right">
                    
                               <!-- code to change the status for service types-->
                                  <div class="activate">
                                  <?php  /* foreach($serviceTy as $service) {  ?>
                                 

                                    <b>
                                        <a href="javascript:void(0)" class="login_insave"><?php echo $service['service_name'];?></a>
                                        <?php 
                                             if(!empty($service->servicestatusBycompanies)) 
                                              {
                                                   foreach($service->servicestatusBycompanies as $status)
                                                    {   
                                                        //echo $status['status'];
                                                          if($status['status']==1 && $status['service_id']==$loggedId)
                                                          { ?>
                                                                       <a href="javascript:void(0)" class="login_insave activate" id="<?php echo $service['id']?>">Deactivate</a>
                                                                           
                                                           
                                                    <?php }  else  { ?> 
                                                            <a href="javascript:void(0)" class="login_insave activate" id="<?php echo $service['id']?>">Activate</a>
                                                           
                                                       <?php } ?>
                                              <?php } } else { ?>
                                               <a href="javascript:void(0)" class="login_insave activate" id="<?php echo $service['id']?>">Activate</a>
                                              <?php } ?>

                                         </b>
                                  
                                   <?php }  */?>
                                    </div>
                                   <div class="clear"></div>
                              <!--                                                                                       
                              <a href="javascript:void(0)" class="login_in greenbtn saveStatusCompany" id="<?php echo $service['id']?>">Deactivate</a>    
                               -->
                              <div id="services" style="display:none">Chnages Saved</div>
                    
                                
                                   <?php /*
                                          $loggedId   =Yii::app()->session['loggedId']; 
                                         foreach($serviceTy as $serv) {

                                                     if(!empty($serv->servicestatusBycompanies)) 
                                                     {
                                                       foreach($serv->servicestatusBycompanies as $stat)
                                                        { 
                                                          //echo "<pre>";print_r($stat);
                                                         if($stat['status']==1 && $stat['service_id']==$loggedId)
                                                          { 
                                                               
                                                              foreach($serv->priceAdmins as $k=>$price) { 

                                                               
                                                               if($price['service_id']==$loggedId)
                                                               
                                                                {
                                                                      //echo "<pre>";print_r($price);
                                    ?>
                                      
                                               <b class="bbc">
                                                     <a href="javascript:void(0)" class="login_insave"><?php echo $serv['service_name'];?></a>
                                               </b>
                                               <div class="pref_form mk">
                                              <div class="inn">
                                               <?php $form=$this->beginWidget('CActiveForm', array(
                                                        'id'=>'g'.$price->id,
                                                        'enableAjaxValidation'=>false,
                                                            'htmlOptions'=>array(
                                                           'onsubmit'=>"return false;",
                                                           'onkeypress'=>" if(event.keyCode == 13){ send(); } " 
                                                         ),
                                                )); ?>
                                                   <input type="hidden" name="priceadminId" value="<?php echo $price->id;?>">    
                                                <p>
                                                  <?php echo $form->labelEx($admnPrice,'bedroom',array('class'=>'hlo')); ?>
                                                  <?php echo $form->textField($admnPrice,'bedroom',array('value'=>$price->bedroom,'class'=>'same')); ?>
                                                  <?php //echo $form->error($model,'city'); ?>
                                
                                                </p> 
                                                <p>
                                                  <?php echo $form->labelEx($admnPrice,'bathroom',array('class'=>'hlo')); ?>
                                                  <?php echo $form->textField($admnPrice,'bathroom',array('value'=>$price->bathroom,'class'=>'same')); ?>
                                                  <?php //echo $form->error($model,'city'); ?>
                                
                                                </p>
                                                <?php if($price->service_type_id==3) { ?> 
                                                <p>
                                                  <?php echo $form->labelEx($admnPrice,'property',array('class'=>'hlo')); ?>
                                                  <?php echo $form->textField($admnPrice,'property',array('value'=>$price->property,'class'=>'same')); ?>
                                                  <?php //echo $form->error($model,'city'); ?>
                                
                                                </p>
                                                <p>
                                                  <?php echo $form->labelEx($admnPrice,'desk',array('class'=>'hlo')); ?>
                                                  <?php echo $form->textField($admnPrice,'desk',array('value'=>$price->desk,'class'=>'same')); ?>
                                                  <?php //echo $form->error($model,'city'); ?>
                                
                                                </p>
                                                <?php } ?> 
                                                 
                                                  <!-- code to get all the additional services starts here--> 
                                                <?php
                                                      //echo "<pre>";print_r($price->service->additionalServicePrices); 
                                                    /*foreach($price->service->additionalServicePrices as $add) { 
                                                          // echo "<pre>";print_r($add);  
                                                      ?> 
                                                        <p>
                                                            <?php echo $form->labelEx($addnal,$add->additionalService['service_name'],array()); ?>
                                                            <?php echo $form->textField($addnal,$add->additionalService['id'],array('value'=>$add['price'],'class'=>'same')); ?>
                                                            <?php //echo $form->error($model,'city'); ?>
                                                       </p> 
                                                 <?php } *///} ?>   

                                                 <!-- code to get all the additional services ends here-->    
  


                                                <?php /*echo CHtml::submitButton('Submit',array('class'=>'login_in greenbtn saveGlobalInfo','id'=>$price->id)); ?>
                                                <?php $this->endWidget(); ?>
                                                </div>
                                        <?php } } } } } }  */?>                                                             
                                       </div>
                                       <style>
                                       	.boxPrice
                                       	{
                                       		
                                       	}
                                       </style>
                                       
                                       	<div style="width: 100% ! important; float: left; margin-left: 200px; margin-bottom: 20px;">
                                       		Criteria : 
                                       		<input type="radio" id="price" name="criteria" checked onclick="showHideFields(this.id);">Price
                                   			<input type="radio" id="hours" name="criteria" onclick="showHideFields(this.id);">Hours
                               			</div>
                                      
                                     <div class="head pref_form reload" id="ref">
                                       <!-- Add Price for Service Types -->

                                        <div id="additional" style="display:none">Chnages Saved</div>
                                            <?php /*$form=$this->beginWidget('CActiveForm', array(
                                                        'id'=>'additionalService',
                                                        'enableAjaxValidation'=>false,
                                                            'htmlOptions'=>array(
                                                           'onsubmit'=>"return false;",
                                                           'onkeypress'=>" if(event.keyCode == 13){ send(); } " 
                                                         ),
                                                )); */?>

                                                    
                                                     <?php
                                                    /*if(!empty($additionSerPrice))
                                                    {  */ 
                                                  	     
                                                         /*foreach($additionSerPrice as $addPrice) {
                                                            
                                                      ?> 
                                                        <p>
                                                            <?php echo $form->labelEx($addnal,$addPrice->additionalService['service_name'],array()); ?>
                                                            <?php echo $form->textField($addnal,$addPrice->additionalService['id'],array('value'=>$addPrice['price'],'class'=>'same')); ?>
                                                           
                                                       </p> 
                                                 <?php } */  //} else { 
                                                                                                                                                                                  
                                                    ?>
                                                <?php /*
                                                    <div class=" servicetypes">
                                                     <?php $form=$this->beginWidget('CActiveForm', array(
                                                        'id'=>'formId',
                                                        'enableAjaxValidation'=>false,
                                                            'htmlOptions'=>array(
                                                           'onsubmit'=>"return false;",
                                                           'onkeypress'=>" if(event.keyCode == 13){ send(); } " 
                                                         ),
                                                )); ?>

                                                    Add Price for Service Types
                                                   <!-- code for adding new prices starts here-->
                                                  <?php foreach($serviceTy as $res)  { ?>

                                                          <?php 
                                                                $arr[]    =$res->service_name;
                                                                
                                                                $id[]     =$res->id;
                                                                 
                                                                //$status[] =$res->servicestatusBycompanies['status'];

                                                                //$st=array_combine($id, $status);               
                                                                $types=array_combine($id,$arr);  
                                                                
                                                               
                                                                //echo "<pre>";print_r($res->servicestatusBycompanies);   
                                                          ?>
                                                <?php } ?>
                                                
                                                                                              

                                                <?php //if($st!==0) { ?> 
                                                <?php  echo $form->dropDownList($admnPrice,'service_type_id',$types,array('class'=>'serviceType')); ?>
                                                                                             
                                                 <?php echo $form->error($admnPrice,'service_id'); ?>
                                                 <?php //} ?>   
                                                  <section><?php echo $form->labelEx($model,'bedroom',array('label'=>' Bed Price/hr')); ?>
                                                   <div>

                                                          <?php echo $form->textField($admnPrice,'bedroom',array('class'=>'integer','id'=>'bedroom','value'=>'0','type'=>'number','min'=>'1','max'=>'2')); ?>
                                                        <?php echo $form->error($admnPrice,'bedroom'); ?>

                                                      </div>
                                                    </section>
                                                  <section><?php echo $form->labelEx($admnPrice,'bathroom',array('label'=>' Bathroom Price/hr')); ?>
                                                          <div>

                                                              <?php echo $form->textField($admnPrice,'bathroom',array('class'=>'integer','id'=>'bathroom','type'=>'number','value'=>'0')); ?>
                                                              <?php echo $form->error($admnPrice,'bathroom'); ?>

                                                          </div>
                                                  </section>
                                                 <!-- extras field added not for office cleaning-->
                                                  <section class="notofc"><?php echo $form->labelEx($admnPrice,'living_room',array('label'=>'Living Room Price/hr')); ?>
                                                    <div>

                                                                        <?php echo $form->textField($admnPrice,'living_room',array('class'=>'integer','type'=>'number')); ?>
                                                                      <?php echo $form->error($admnPrice,'living_room'); ?>

                                                    </div>
                                                  </section>
                                                  <section class="notofc"><?php echo $form->labelEx($admnPrice,'kitchen_staircases',array('label'=>'Kitchen Staircases Price/hr')); ?>
                                                    <div>

                                                                        <?php echo $form->textField($admnPrice,'kitchen_staircases',array('class'=>'integer','type'=>'number')); ?>
                                                                      <?php echo $form->error($admnPrice,'kitchen_staircases'); ?>

                                                    </div>
                                                  </section>
                                                  <section class="notofc"><?php echo $form->labelEx($admnPrice,'carpets_interior_windows',array('label'=>'Carpets Interior Windows Price/hr')); ?>
                                                    <div>

                                                                        <?php echo $form->textField($admnPrice,'carpets_interior_windows',array('class'=>'integer','type'=>'number')); ?>
                                                                      <?php echo $form->error($admnPrice,'carpets_interior_windows'); ?>

                                                    </div>
                                                  </section>
                                                 <!-- extras field added not for office cleaning --> 
                                                  
                                                  <!--Extra ofc fields  -->
                                                      <section class="abc"><?php echo $form->labelEx($admnPrice,'cupboards',array('label'=>' CupBoards Price/hr')); ?>
                                                        <div>

                                                                            <?php echo $form->textField($admnPrice,'cupboards',array('class'=>'integer','type'=>'number')); ?>
                                                                          <?php  echo $form->error($admnPrice,'cupboards'); ?>

                                                        </div>
                                                      </section>

                                                        <section class="abc"><?php echo $form->labelEx($admnPrice,'kitchen',array('label'=>'Kitchen Price/hr')); ?>
                                                        <div>

                                                                            <?php echo $form->textField($admnPrice,'kitchen',array('class'=>'integer','type'=>'number')); ?>
                                                                          <?php  echo $form->error($admnPrice,'kitchen'); ?>

                                                        </div>
                                                      </section>
                                                                 

                                                        <section class="abc"><?php echo $form->labelEx($admnPrice,'staircases',array('label'=>'StairCases Price/hr')); ?>
                                                        <div>

                                                                            <?php echo $form->textField($admnPrice,'staircases',array('class'=>'integer','type'=>'number')); ?>
                                                                          <?php  echo $form->error($admnPrice,'staircases'); ?>

                                                        </div>
                                                      </section>
                                                      <section class="abc"><?php echo $form->labelEx($admnPrice,'elevator',array('label'=>'Elevator Price/hr')); ?>
                                                        <div>

                                                                            <?php echo $form->textField($admnPrice,'elevator',array('class'=>'integer','type'=>'number')); ?>
                                                                          <?php  echo $form->error($admnPrice,'elevator'); ?>

                                                        </div>
                                                      </section>
                                                      <!-- Extra ofc fields --> 




                                                <section class="abc"><?php echo $form->labelEx($admnPrice,'property',array('label'=>' Property(in sq feet/hr)')); ?>
                                                  <div>

                                                  <?php echo $form->textField($admnPrice,'property',array('class'=>'integer','type'=>'number','value'=>'0')); ?>
                                                <?php  echo $form->error($admnPrice,'property');   ?>

                                                  </div>
                                                </section>
            
            
                                              <section class="abc"><?php echo $form->labelEx($admnPrice,'desk',array('label'=>' Desk Price/hr')); ?>
                                                <div>

                                                  <?php echo $form->textField($admnPrice,'desk',array('class'=>'integer','type'=>'number','value'=>'0')); ?>
                                                <?php  echo $form->error($admnPrice,'desk'); ?>

                                                </div>
                                              </section>
                                              <section><?php echo $form->labelEx($admnPrice,'cleaning_material_price',array('label'=>'Cleaning Material Price/hr')); ?>
                                                    <div>

                                                    <?php echo $form->textField($admnPrice,'cleaning_material_price',array('class'=>'integer','type'=>'number','value'=>'0')); ?>
                                                  <?php echo $form->error($admnPrice,'cleaning_material_price'); ?>

                                                    </div>
                                                  </section>
                                                  <!-- code for adding new prices ends here--> 
                                                  
                                                 
                                          <?php echo CHtml::submitButton('Submit',array('class'=>'login_in greenbtn addPriceCompany')); ?>
                                          <?php $this->endWidget(); ?>

                                                 <?php //}  ?> 

                                          <?php //echo CHtml::submitButton('Submit',array('class'=>'login_in greenbtn addPriceCompany')); ?>
                                          <?php //$this->endWidget(); ?>
                                         </div>
                                          */ ?>

                                               <div class="form1">

                                               <h5>End of tenancy cleaning</h5> 
                                               <?php $form=$this->beginWidget('CActiveForm', array(
                                                        'id'=>'formid1',
                                                        'enableAjaxValidation'=>false,
                                                            'htmlOptions'=>array(
                                                           'onsubmit'=>"return false;",
                                                           'onkeypress'=>" if(event.keyCode == 13){ send(); } " 
                                                         ),
                                                )); ?>
                                                <?php $loggedId    =  Yii::app()->session['loggedId']; ?>
                                                <input type="hidden" name="loggedId" value="<?php echo $loggedId?>">
                                                <input type="hidden" name="service_type_id" value="1">
                                                       <div class="field">
		                                                <?php echo $form->labelEx($model,'bedroom',array('label'=>' Bedroom')); ?>
		                                                        
		                                                $ <?php echo $form->textField($admnPrice,'bedroom',array('value'=>isset($endofTenancy['bedroom']) ? $endofTenancy['bedroom'] : 0, 'class'=>'boxPrice')); ?>
		                                                OR 
		                                                <?php echo $form->textField($admnPrice,'bedroom_hr',array('value'=>isset($endofTenancy['bedroom_hr']) ? $endofTenancy['bedroom_hr'] : 0, 'class'=>'boxHours')); ?> hour(s)
                                                    </div> 
		                                                <div class="field">
		                                                <?php echo $form->labelEx($model,'bathroom',array('label'=>' Bathroom')); ?>
		                                                        
		                                                $ <?php echo $form->textField($admnPrice,'bathroom',array('value'=>isset($endofTenancy['bathroom']) ? $endofTenancy['bathroom'] : 0,  'class'=>'boxPrice')); ?>
		                                                OR 
		                                                <?php echo $form->textField($admnPrice,'bathroom_hr',array('value'=>isset($endofTenancy['bathroom_hr']) ? $endofTenancy['bathroom_hr'] : 0, 'class'=>'boxHours')); ?> hour(s)
		                                                </div>
		                                                <div class="field">
		                                                <?php echo $form->labelEx($model,'kitchen_staircases',array('label'=>' Kitchen Stair Case')); ?>
		                                                        
		                                                $ <?php echo $form->textField($admnPrice,'kitchen_staircases',array('value'=>isset($endofTenancy['kitchen_staircases']) ? $endofTenancy['kitchen_staircases'] : 0,  'class'=>'boxPrice')); ?>
		                                                OR 
		                                                <?php echo $form->textField($admnPrice,'kitchen_staircases_hr',array('value'=>isset($endofTenancy['kitchen_staircases_hr']) ? $endofTenancy['kitchen_staircases_hr'] : 0, 'class'=>'boxHours')); ?> hour(s)
		                                                </div>
		                                                <div class="field">
		                                                <?php echo $form->labelEx($model,'carpets_interior_windows',array('label'=>'Carpets Int Window')); ?>
		                                                        
		                                                $ <?php echo $form->textField($admnPrice,'carpets_interior_windows',array('value'=>isset($endofTenancy['carpets_interior_windows']) ? $endofTenancy['carpets_interior_windows'] : 0,  'class'=>'boxPrice')); ?>
		                                                OR 
		                                                <?php echo $form->textField($admnPrice,'carpets_interior_windows_hr',array('value'=>isset($endofTenancy['carpets_interior_windows_hr']) ? $endofTenancy['carpets_interior_windows_hr'] : 0, 'class'=>'boxHours')); ?> hour(s)
		                                                </div>
		                                                <div class="field">
		                                                <?php echo $form->labelEx($model,'cleaning_material_price',array('label'=>'Cleaning Material')); ?>
		                                                        
		                                                $ <?php echo $form->textField($admnPrice,'cleaning_material_price',array('value'=>isset($endofTenancy['cleaning_material_price']) ? $endofTenancy['cleaning_material_price'] : 0,  'class'=>'boxPrice')); ?>
		                                                OR 
		                                                <?php echo $form->textField($admnPrice,'cleaning_material_price_hr',array('value'=>isset($endofTenancy['cleaning_material_price_hr']) ? $endofTenancy['cleaning_material_price_hr'] : 0, 'class'=>'boxHours')); ?> hour(s)
		                                                </div>   
		                                                



		                                                <?php echo CHtml::submitButton('Update',array('id'=>'addPriceCompIndividual' ,'class'=>'endOfTenancy' )); ?>
                                                    <?php $this->endWidget(); ?>
                                                    <div id="endcleaning" style="display:none">Changes Saved.</div>
                                              </div>
                                               <div class="form2">
                                               <h5>Domestic cleaning</h5>
                                               <?php $form=$this->beginWidget('CActiveForm', array(
                                                        'id'=>'formid2',
                                                        'enableAjaxValidation'=>false,
                                                            'htmlOptions'=>array(
                                                           'onsubmit'=>"return false;",
                                                           'onkeypress'=>" if(event.keyCode == 13){ send(); } " 
                                                         ),
                                                )); ?>
                                                <?php $loggedId    =  Yii::app()->session['loggedId']; ?>
                                                <input type="hidden" name="loggedId" value="<?php echo $loggedId?>">
                                                <input type="hidden" name="service_type_id" value="2">
                                                       <div class="field">
		                                                <?php echo $form->labelEx($model,'bedroom',array('label'=>' Bedroom')); ?>
		                                                        
		                                                $ <?php echo $form->textField($admnPrice,'bedroom',array('value'=>isset($domesticCleaning['bedroom']) ? $domesticCleaning['bedroom'] : 0,  'class'=>'boxPrice')); ?>
		                                                OR 
		                                                <?php echo $form->textField($admnPrice,'bedroom_hr',array('value'=>isset($domesticCleaning['bedroom_hr']) ? $domesticCleaning['bedroom_hr'] : 0, 'class'=>'boxHours')); ?> hour(s)
                                                    </div> 
		                                                <div class="field">
		                                                <?php echo $form->labelEx($model,'bathroom',array('label'=>' Bathroom')); ?>
		                                                        
		                                                $ <?php echo $form->textField($admnPrice,'bathroom',array('value'=>isset($domesticCleaning['bathroom']) ? $domesticCleaning['bathroom'] : 0,  'class'=>'boxPrice')); ?>
		                                                OR 
		                                                <?php echo $form->textField($admnPrice,'bathroom_hr',array('value'=>isset($domesticCleaning['bathroom_hr']) ? $domesticCleaning['bathroom_hr'] : 0, 'class'=>'boxHours')); ?> hour(s)
		                                                </div>
		                                                <div class="field">
		                                                <?php echo $form->labelEx($model,'kitchen_staircases',array('label'=>' Kitchen Stair Case')); ?>
		                                                        
		                                                $ <?php echo $form->textField($admnPrice,'kitchen_staircases',array('value'=>isset($domesticCleaning['kitchen_staircases']) ? $domesticCleaning['kitchen_staircases'] : 0,  'class'=>'boxPrice')); ?>
		                                                OR 
		                                                <?php echo $form->textField($admnPrice,'kitchen_staircases_hr',array('value'=>isset($domesticCleaning['kitchen_staircases_hr']) ? $domesticCleaning['kitchen_staircases_hr'] : 0, 'class'=>'boxHours')); ?> hour(s)
		                                                </div>
		                                                <div class="field">
		                                                <?php echo $form->labelEx($model,'carpets_interior_windows',array('label'=>'Carpets Int Window')); ?>
		                                                        
		                                                $ <?php echo $form->textField($admnPrice,'carpets_interior_windows',array('value'=>isset($domesticCleaning['carpets_interior_windows']) ? $domesticCleaning['carpets_interior_windows'] : 0,  'class'=>'boxPrice')); ?>
		                                                OR 
		                                                <?php echo $form->textField($admnPrice,'carpets_interior_windows_hr',array('value'=>isset($domesticCleaning['carpets_interior_windows_hr']) ? $domesticCleaning['carpets_interior_windows_hr'] : 0, 'class'=>'boxHours')); ?> hour(s)
		                                                </div>
		                                                <div class="field">
		                                                <?php echo $form->labelEx($model,'cleaning_material_price',array('label'=>'Cleaning Material')); ?>
		                                                        
		                                                $ <?php echo $form->textField($admnPrice,'cleaning_material_price',array('value'=>isset($domesticCleaning['cleaning_material_price']) ? $domesticCleaning['cleaning_material_price'] : 0,  'class'=>'boxPrice')); ?>
		                                                OR 
		                                                <?php echo $form->textField($admnPrice,'cleaning_material_price_hr',array('value'=>isset($domesticCleaning['cleaning_material_price_hr']) ? $domesticCleaning['cleaning_material_price_hr'] : 0, 'class'=>'boxHours')); ?> hour(s)
		                                                </div>   

		                                                <?php echo CHtml::submitButton('Update',array('id'=>'addPriceCompIndividual' ,'class'=>'domestic')); ?>
                                              <?php $this->endWidget(); ?>
                                              <div id="domst" style="display:none">Changes Saved.</div>
                                              </div>
                                               <div class="form3">
                                               <h5>Office cleaning</h5>
                                               <?php $form=$this->beginWidget('CActiveForm', array(
                                                        'id'=>'formid3',
                                                        'enableAjaxValidation'=>false,
                                                            'htmlOptions'=>array(
                                                           'onsubmit'=>"return false;",
                                                           'onkeypress'=>" if(event.keyCode == 13){ send(); } " 
                                                         ),
                                                )); ?>
                                                <?php $loggedId    =  Yii::app()->session['loggedId']; ?>
                                                <input type="hidden" name="loggedId" value="<?php echo $loggedId?>">
                                                <input type="hidden" name="service_type_id" value="3">
                                                      <div class="field">
		                                                <?php echo $form->labelEx($model,'bedroom',array('label'=>' Bedroom')); ?>
		                                                        
		                                                $ <?php echo $form->textField($admnPrice,'bedroom',array('value'=>isset($officeCleaning['bedroom']) ? $officeCleaning['bedroom'] : 0,  'class'=>'boxPrice')); ?>
		                                                OR 
		                                                <?php echo $form->textField($admnPrice,'bedroom_hr',array('value'=>isset($officeCleaning['bedroom_hr']) ? $officeCleaning['bedroom_hr'] : 0, 'class'=>'boxHours')); ?> hour(s)
                                                    </div> 
		                                                <div class="field">
		                                                <?php echo $form->labelEx($model,'bathroom',array('label'=>' Bathroom')); ?>
		                                                        
		                                                $ <?php echo $form->textField($admnPrice,'bathroom',array('value'=>isset($officeCleaning['bathroom']) ? $officeCleaning['bathroom'] : 0,  'class'=>'boxPrice')); ?>
		                                                OR 
		                                                <?php echo $form->textField($admnPrice,'bathroom_hr',array('value'=>isset($officeCleaning['bathroom_hr']) ? $officeCleaning['bathroom_hr'] : 0, 'class'=>'boxHours')); ?> hour(s)
		                                                </div>
		                                                <div class="field">
		                                                <?php echo $form->labelEx($model,'property',array('label'=>' Property(sqft)')); ?>
		                                                        
		                                                $ <?php echo $form->textField($admnPrice,'property',array('value'=>isset($officeCleaning['property']) ? $officeCleaning['property'] : 0,  'class'=>'boxPrice')); ?>
		                                                OR 
		                                                <?php echo $form->textField($admnPrice,'property_hr',array('value'=>isset($officeCleaning['property_hr']) ? $officeCleaning['property_hr'] : 0, 'class'=>'boxHours')); ?> hour(s)
		                                                </div>
		                                                <div class="field">
		                                                <?php echo $form->labelEx($model,'desk',array('label'=>'Desk Price')); ?>
		                                                        
		                                                $ <?php echo $form->textField($admnPrice,'desk',array('value'=>isset($officeCleaning['desk']) ? $officeCleaning['desk'] : 0,  'class'=>'boxPrice')); ?>
		                                                OR 
		                                                <?php echo $form->textField($admnPrice,'desk_hr',array('value'=>isset($officeCleaning['desk_hr']) ? $officeCleaning['desk_hr'] : 0, 'class'=>'boxHours')); ?> hour(s)
		                                                </div>
		                                                <div class="field">
		                                                <?php echo $form->labelEx($model,'cupboards',array('label'=>'CupBoards Price')); ?>
		                                                        
		                                                $ <?php echo $form->textField($admnPrice,'cupboards',array('value'=>isset($officeCleaning['cupboards']) ? $officeCleaning['cupboards'] : 0,  'class'=>'boxPrice')); ?>
		                                                OR 
		                                                <?php echo $form->textField($admnPrice,'cupboards_hr',array('value'=>isset($officeCleaning['cupboards_hr']) ? $officeCleaning['cupboards_hr'] : 0, 'class'=>'boxHours')); ?> hour(s)
		                                                </div>  

                                                         <div class="field">
		                                                <?php echo $form->labelEx($model,'kitchen',array('label'=>'Kitchen')); ?>
		                                                        
		                                                $ <?php echo $form->textField($admnPrice,'kitchen',array('value'=>isset($officeCleaning['kitchen']) ? $officeCleaning['kitchen'] : 0,  'class'=>'boxPrice')); ?>
		                                                OR 
		                                                <?php echo $form->textField($admnPrice,'kitchen_hr',array('value'=>isset($officeCleaning['kitchen_hr']) ? $officeCleaning['kitchen_hr'] : 0, 'class'=>'boxHours')); ?> hour(s)
		                                                </div>
		                                                <div class="field">
		                                                <?php echo $form->labelEx($model,'staircases',array('label'=>'StairCases')); ?>
		                                                        
		                                                $ <?php echo $form->textField($admnPrice,'staircases',array('value'=>isset($officeCleaning['staircases']) ? $officeCleaning['staircases'] : 0,  'class'=>'boxPrice')); ?>
		                                                OR 
		                                                <?php echo $form->textField($admnPrice,'staircases_hr',array('value'=>isset($officeCleaning['staircases_hr']) ? $officeCleaning['staircases_hr'] : 0, 'class'=>'boxHours')); ?> hour(s)
		                                                </div>
		                                                <div class="field">
		                                                <?php echo $form->labelEx($model,'elevator',array('label'=>'Elevator')); ?>
		                                                        
		                                                $ <?php echo $form->textField($admnPrice,'elevator',array('value'=>isset($officeCleaning['elevator']) ? $officeCleaning['elevator'] : 0,  'class'=>'boxPrice')); ?>
		                                                OR 
		                                                <?php echo $form->textField($admnPrice,'elevator_hr',array('value'=>isset($officeCleaning['elevator_hr']) ? $officeCleaning['elevator_hr'] : 0, 'class'=>'boxHours')); ?> hour(s)
		                                                </div>
		                                                <div class="field">
		                                                <?php echo $form->labelEx($model,'cleaning_material_price',array('label'=>'Cleaning Material')); ?>
		                                                        
		                                                $ <?php echo $form->textField($admnPrice,'cleaning_material_price',array('value'=>isset($officeCleaning['cleaning_material_price']) ? $officeCleaning['cleaning_material_price'] : 0,  'class'=>'boxPrice')); ?>
		                                                OR 
		                                                <?php echo $form->textField($admnPrice,'cleaning_material_price_hr',array('value'=>isset($officeCleaning['cleaning_material_price_hr']) ? $officeCleaning['cleaning_material_price_hr'] : 0, 'class'=>'boxHours')); ?> hour(s)
		                                                </div>   



		                                                <?php echo CHtml::submitButton('Update',array('id'=>'addPriceCompIndividual','class'=>'office')); ?>
                                              <?php $this->endWidget(); ?>
                                              <div id="ofc" style="display:none">Changes Saved.</div>
                                              </div>




                                              <!-- add the price for per distance-->
                                               <div class="form1">

                                               <h5>Price Per Mile</h5> 
                                               <?php $form=$this->beginWidget('CActiveForm', array(
                                                        'id'=>'dist',
                                                        'enableAjaxValidation'=>false,
                                                            'htmlOptions'=>array(
                                                           'onsubmit'=>"return false;",
                                                           'onkeypress'=>" if(event.keyCode == 13){ send(); } " 
                                                         ),
                                                )); ?>
                                                <?php $loggedId    =  Yii::app()->session['loggedId']; ?>
                                                 <input type="hidden" name="loggedId" value="<?php echo $loggedId ?>">
                                                  <?php if(!empty($coverage)) { ?>
                                                          <div class="field">
                                                            <?php echo $form->labelEx($distance,'distance',array('label'=>'Distance Covergae(mile)')); ?>
                                                                    
                                                            <?php echo $form->textField($distance,'distance',array('value'=>$coverage['distance'])); ?>
                                                            </div> 
                                                            <div class="field">
                                                            <?php echo $form->labelEx($distance,'price_per_mile',array('label'=>'Price(/mile)')); ?>
                                                                    
                                                            <?php echo $form->textField($distance,'price_per_mile',array('value'=>$coverage['price_per_mile'])); ?>
                                                            </div> 
                                                    <?php } else { ?>
                                                              
                                                            <div class="field">
                                                            <?php echo $form->labelEx($distance,'distance',array('label'=>'Distance Covergae(mile)')); ?>
                                                                    
                                                            <?php echo $form->textField($distance,'distance',array('value'=>0)); ?>
                                                            </div> 
                                                            <div class="field">
                                                            <?php echo $form->labelEx($distance,'price_per_mile',array('label'=>'Price(/mile)')); ?>
                                                                    
                                                            <?php echo $form->textField($distance,'price_per_mile',array('value'=>0)); ?>
                                                            </div>

                                                    <?php } ?>
                                                    <?php echo CHtml::submitButton('Update',array('id'=>'addPriceCompIndividual' ,'class'=>'distance' )); ?>
                                                    <?php $this->endWidget(); ?>
                                                    <div id="distcoverage" style="display:none">Changes Saved.</div>
                                              </div>
                                     </div>                                                          
             
                           
                                  <!--<a href="#" class="login_in greenbtn save">Save</a> -->
                    <!-- check the additional service for particular service-->
                    <div class="pref_right">
                            <div class="right">
                              <h5>Additional Services for particular Service Types</h4> 
                              <!-- code to show the admin additiona services-->
                               <?php   foreach($serviceTy as $ser) { ?>
                                       
                                         <div class="head">
                                            <!--<a href="javascript:void(0)" class="login_insave">-->
                                            <h5><?php echo $ser['service_name'];?></h5>
                                            <!--</a> -->
                                        
                                        <?php $form=$this->beginWidget('CActiveForm', array(
                                                        'id'=>'adnl'.$ser['id'],
                                                        'enableAjaxValidation'=>false,
                                                            'htmlOptions'=>array(
                                                           'onsubmit'=>"return false;",
                                                           'onkeypress'=>" if(event.keyCode == 13){ send(); } " 
                                                         ),
                                                )); ?>  
                                                  <input type="hidden" name="type" value="<?php echo $ser['id'];?>">
                                        
                                                      <?php 
                                                             $arrServiceId=array();

                                                             foreach($ser->providerAdditionalprices as $priceUpdate)
                                                             {
                                                             	
                                                                  //$arrServiceId[]=$priceUpdate['servicetype_additional_id'];  
                                                                 if($priceUpdate['service_id']==$loggedId && $priceUpdate['service_type_id']==$ser['id'])
                                                                 {
                                                                      $arrServiceId[]=$priceUpdate['servicetype_additional_id'];      
                                                       ?>
                                                               
                                                                      <div class="intrl"> 
                                                                      <div class="label">
                                                                      <?php echo $form->labelEx($serviceAd,$priceUpdate['provideradditional_service_name'],array()); ?>
                                                                      </div>
                                                                      <div class="adnl1">
                                                                       
                                                                       <?php echo $form->textField($serviceAd,$priceUpdate['servicetype_additional_id'],array('value'=>$priceUpdate['provider_adnlprice'],'class'=>'same')); ?>
                                                                       </div>
                                                                     </div>
                                                       <?php } } ?>

                                          <?php 

                                                    foreach($ser->servicetypeAdditionalservices as $priceUpdate) {  
                                                   
                                                     if(!(in_array($priceUpdate['id'],$arrServiceId)))
                                                     {
                                                         if($priceUpdate['status']==1 )
                                                         {  
                                                         

                                                      ?>
                                                 
                                                <div class="intrl"> 
                                                <div class="label">
                                                <?php echo $form->labelEx($serviceAd,$priceUpdate['additional_service_name'],array()); ?>
                                                 </div>
                                                      <div class="adnl1">
                                                        
                                                        <?php echo $form->textField($serviceAd,$priceUpdate['id'],array('value'=>$priceUpdate['additional_service_price'],'class'=>'same')); ?>
                                                      </div>
                                                </div>

                                                
                                               
                                        <?php }  }  } ?>                                                     
                                        <div class="update">  
		                                        <p class="adnl">
		                                               <?php echo CHtml::submitButton('Update',array('class'=>'login_in greenbtn additionalservices','id'=>$ser['id'])); ?>
		                                        </p>
                                        </div>
                                        <?php $this->endWidget(); ?> 
                                       </div>

                                        <?php /* foreach($gpAdditional as $gAdnl)
                                         {  ?>
                                         <p>

                                           <?php echo $form->labelEx($addnal,$gAdnl['service_name'],array()); ?>
                                           <?php //echo $form->checkBox($globalAd,$gAdnl['service_name'],array('value' => '1', 'uncheckValue'=>'0'));
                                                  echo CHtml::checkBox($gAdnl['service_name'],false,array('checked'=>''));

                                            ?>
                                         </p>
                                        <?php } */?>
                               <?php }  ?>
                              </div>  
                    </div>
                   <!-- check the additional service for particular service-->
                                                       
                            </div>
                         
                        
                        
                           </div>
                        
                  </div>

                  <?php //} ?>
        </div>
              <!-- Services edit ends here -->    
      </div>
    </div>
  </div>
    </div>
</div>
<div class="clear"> </div>
