<?php

/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;

?>
        <!-- configuration to overwrite settings-->
	<!--<script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/back/js/config.js"></script> -->
		
	<!-- the script which handles all the access to plugins etc...  -->
	<!-- <script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/back/js/script.js">	</script> -->
	<script>
	$(document).ready(function(){
         
	           $(".message").click(function(){

	               var id=$(this).attr('id');

	               $(".detailmsg"+id).toggle();

                    
	           });



	           /*code to reply the customer from admin*/
	           /*reply to message*/
      $(".sndmsg").live('click',function(){

          //var loggedId    ="<?php echo Yii::app()->session['loggedId'];?>";
          //var receiverId  ="<?php echo $msg->sender_id;?>";
          //var replysectionBookingId=$('.replysection').attr('id');
           var replysectionBookingId=0;
           var sendIds  =$(this).attr('id');
           //alert(sendIds)
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
	                                url: '<?php echo Yii::app()->createAbsoluteUrl("admin/customer/replyfromAdminToCustomer"); ?>',
	                               //data:{'data':data,'email':email},
	                               data:{'conversionId':id,'receiverId':receiverId,'subject':subject,'text':text,'replysectionBookingId':replysectionBookingId},
	                            success:function(data){
	                                           
	                                            //$(".main").append(data);
	                                           // $(".text"+id).val(); 
	                                           $("#"+id).append(data);
	                                           $(".text"+id).val(' ');

	                                           	                                          
	                                          },
	                               error: function(data) { // if error occured
	                                    // alert(data);
	                                     return false;
	                                },
	                             
	                              dataType:'html'
	                    });   
	           } 

	               

        });


	});

	
	</script>

	<style>
       .button
       {
       	   /* background-color: #e6e6e6;
		    border-color: #c7c7c7 #b2b2b2 #b2b2b2 #c7c7c7;
		    box-shadow: 0 1px 0 rgba(255, 255, 255, 0.6) inset, 0 2px 5px rgba(255, 255, 255, 0.5) inset, 0 -2px 5px rgba(0, 0, 0, 0.1) inset;
		    color: #555555;
		    text-shadow: 0 1px 0 rgba(255, 255, 255, 0.698);*/
		    cursor:pointer;
       } 
	</style>

	<?php  include('themes/back/views/layouts/left_sidebar.php'); ?>


	<body>
		
		<section id="content">
				

				<form id="form" onsubmit="return false">
					<fieldset>
						<label>Customer Detail</label>
                        <!-- 
						<section><label for="text_field">Company Name</label>
							<div><?php //echo ucfirst($view->service['company_name']);?></div>
						</section>
						-->
						<section><label for="text_tooltip">Name</label>
							<div><?php echo $detail->cname." ".$detail->clname;?></div>
						</section>
						<section><label for="text_tooltip">Email</label>
							<div><?php echo $detail->email;?></div>
						</section>
						
                        
                          
                        <section><label for="text_tooltip">City</label>
							<div><?php echo $detail->city;?></div>
						</section>

                        <section><label for="text_tooltip">Post Code</label>
							<div><?php echo $detail->zipcode;?></div>
						</section>

                        
                        <label>Customer Booking Details</label>
                      <?php 
                        $i=1; 
                        foreach($detail['bookings'] as $d) { ?>
                        
                         <label><?php echo "Booking Order"." ".$i++; ?></label>

                        <section><label for="text_tooltip">Comapny</label>
							<div><?php echo $d->service['company_name'];?></div>
						</section>
                        

                        <section><label for="text_tooltip">Service Type</label>
							<div><?php echo $d->serviceType['service_name'];?></div>
						</section>


                        <section><label for="text_tooltip">Address For Cleaning</label>
							<div><?php echo $d->customerAddress['address'];?></div>
						</section>


                        <section><label for="text_tooltip">Cleaning Detail</label>
							<div><?php echo $d['cleaningDetail'];?></div>
						</section>

						 <section><label for="text_tooltip">Transaction Id</label>
							<div><?php echo $d['trans_id'];?></div>
						</section>

                        <?php if(!empty($d['additional'])) { ?>
                        <section><label for="text_tooltip">Additional Detail</label>
							<div><?php echo $d['additional'];?></div>
						</section>

					   <?php } ?>	
                     
                    <?php } ?>
					
                       <label>Customer Message section</label>
                       <!-- code to show the msg converstion here-->
                     <div id="msglis<?php echo $bookingId;?>"> 
                             
          <div id="mailbox-inbox" class="ajax-paged"><!-- class ajax-paged required to make pagination work -->
           
            <div class="grid-header-row"> 
             <span class="subject">Subject</span> 
            
               <span class="date"><a href="/ajax-dashboard-customer-messages/sort-field-created_at/sort-direction-asc" class="">Received</a></span> 
             </div>  
				    <?php 
                           foreach($inbox as $msg1) { 
				    ?>        
                     
				            <div class="message close has-more read- first-row unread" id="<?php echo $msg1->id;?>" data-id="17602932">
				              <div class="status read"></div>
				              <div class="subject"><?php echo $msg1->conversation['subject'];?></div>
				              <div class="date"><span title="2014-09-29 23:40:05" class="time-label"><!-- 14 days ago --> 
				                
				                <?php 
				                      
				                       echo  date('jS \of F Y  H:i:s',strtotime($msg1->date)); 
				                ?>
				              </span></div>
				             
				            </div>
                            
                             <!-- on click div to show here-->

                             <div class="message1 close has-more read- first-row unread detailmsg<?php echo $msg1->id;?>" style="display:none;">
                 
				                 <input type="hidden" class="subject<?php echo $msg1->conversation['id'];?>" value="<?php echo $msg1->conversation['subject'];?>">
				                
				               <div class="clear"></div>  
				               <div id="conversationmsgdiv">
				               <div class="main" id="<?php echo $msg1->conversation['id'];?>">
					                            <?php 
					                              
					                               //$loggedId=Yii::app()->session['loggedId']; 
					                               echo "Message Detail."."</br>";
					                               echo "<div class='clear'></div>";
					                              
					                               foreach($inboxDtal as $details)
					                               {  
					                                  // echo "<pre>";print_r($detail);
					                                   foreach($details as $d)
					                                   {  
					                                       

					                                       if($msg1->conversation_id==$d['conversation_id'])
					                                       {   
					                                            

					                                                 if($d['user_id']==0)
					                                                 { 
					                                                     echo "<input type='hidden' id='".$d['conversation_id']."' class='append'>";
					                                                     echo "<div class='name'>";
					                                                     echo 'admin';
					                                                     echo "</div>";
					                                                     echo "<div class='leftMsg appendmsg".$d['id']."'>";    
					                                                     echo "<div class='time'>";
					                                                     echo date('jS \of F Y  H:i:s',strtotime($d['date']));
					                                                     echo "</div>";
					                                                     echo "<div class='msg'>";
					                                                     echo $d['msg'];
					                                                     echo "</div>";
					                                                     echo "<div class='time'>";
					                                                     //echo $d['date'];
					                                                     echo "</div>";
					                                                     echo "</div>"."</br>";
					                                                     echo "<div class='clear'></div>";
					                                                 }
					                                                 else
					                                                 {
					                                                     //$name=CustomerUser::model()->findByPk(array('id'=>$d['user_id']));

					                                                    // $name2=ServiceUser::model()->findByPk(array('id'=>$d['tomsg']));
					                                             
					                                                     echo "<input type='hidden' id='".$d['conversation_id']."' class='append'>";
					                                                     
					                                                         echo "<div class='rightname'>";
					                                                         echo $detail['cname']." ".$detail['clname'];
					                                                         echo "</div>";
					                                                     
					                                                     echo "<div class='rightMsg appendmsg".$d['id']."'>";    
					                                                     echo "<div class='time'>";
					                                                     echo date('jS \of F Y  H:i:s',strtotime($d['date']));
					                                                     echo "</div>";
					                                                     echo "<br>";
					                                                     echo $d['msg'];
					                                                     echo "<div class='time'>";
					                                                     //echo $d['date'];
					                                                     echo "</div>";

					                                                       
					                                                     echo "</div>"."</br>";
					                                                    
					                                                     echo "<div class='clear'></div>";
					                                                 }     
					                                       } 
					                                   }  
					                               } 
					                         ?>
					               </div>
					               </div>

						                 <div class="replysection" id="<?php echo $bookingId;?>">
						                         
						                          
						                          <input type="hidden" id="recv<?php echo $msg1->conversation['sender_id'];?>" value="<?php echo $msg1->conversation['sender_id'];?>">
						                          <?php echo CHtml::textArea('Text','',array('class'=>'text'.$msg1->conversation['id'])); ?>
						                          <div class="clear"></div> 
						                          
						                          <?php echo CHtml::submitButton('Send',array('class'=>'login_in23 greenbtn sndmsg ','id'=>$msg1->conversation['id'].'-'.$msg1['user_id'])); ?>
						                          
						                 </div>



                           </div> 
                         
                           <!-- create message to customer starts here-->
                          
                          <?php /*  <div class="ticketmsgbtn" id="<?php //echo $book->id;?>">
                                <h5>Create New Ticket</h5>
                             </div>
                       
                                            <div id="ticketcrtMsg<?php //echo $book->id;?>" style="display:none;" class="form">
                                                    <?php $form=$this->beginWidget('CActiveForm', array(
                                                        'id'=>'Ticket',
                                                        'enableAjaxValidation'=>false,
                                                        'htmlOptions'=>array(
                                                        'onsubmit'=>"return false;",
                                                        'onkeypress'=>" if(event.keyCode == 13){ CreateTicketCustomer(); } " 
                                                       ),
                                                     )); ?> 
                                                      <?php  //$loggedId= Yii::app()->session['loggedId'];?>
                                                     <input type="hidden" name="reciverId" value="0"> 
                                                     <input type="hidden" name="senderId" value="<?php echo $loggedId;?>"> 
                                                      <input type="hidden" name="bookingId" value="0">
                                                         <div class="pref_form" id="activesub">
                                                        <p>
                                                              <?php  //echo $form->labelEx($msg,'subject',array('label'=>"Subject")); ?>
                                                              <?php // echo $form->textField($msg,'subject',array('id'=>'ticketsubject')); ?>                                                   
                                                           
                                                        </p>
                                                        </div>
                                                        <div class="pref_form" id="activemsg">
                                            
                                                           
                                                                 <?php //echo $form->labelEx($msgDetail,'msg',array('label'=>"Message")); ?>
                                                                 <?php //echo $form->TextArea($msgDetail,'msg',array('id'=>'ticketmsg')); ?>
                                                                     
                                                     
                                                        </div>

                                                       <div class="pref_form" id="button">
                                                        <?php echo CHtml::submitButton('Send',array('class'=>'login_in greenbtn snd ','onclick'=>'CreateTicketCustomer();')); ?>
                                                       </div> 
                                                    <?php $this->endWidget(); ?>

                                           </div> */?>


                     <?php } ?>  
               </div>  

					</fieldset>
                    

				</form>	
				<section> 
                          
							<div>	
							<button class="reset" name="btnback" onclick="history.go(-1)" >Back</button>			
							</div>
			   </section>
				</div>
		</section>
		
   </body>
