<script type="text/javascript">
$(document).ready(function(){
      /*show message in div*/
       $(".message").click(function(){

             var id=$(this).attr('id');
             $(".detailmsg"+id).toggle();
       });

       /*code to reply the messages*/
      /* $(".sndmsg").live('click',function(){

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
           
           var text=$(".text"+id).val();
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
                                url: '<?php echo Yii::app()->createAbsoluteUrl("registration/registration/replyfromCustomer"); ?>',
                               //data:{'data':data,'email':email},
                               data:{'conversionId':id,'loggedId':loggedId,'receiverId':receiverId,'subject':subject,'text':text,'replysectionBookingId':replysectionBookingId},
                            success:function(data){

                                           //alert(data);
                                           $(".main").append(data);
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

            

          


      });*/

});
</script>
      <div id="msglis<?php echo $bookingId;?>"> 
                             
          <div id="mailbox-inbox" class="ajax-paged"><!-- class ajax-paged required to make pagination work -->
           
            <div class="grid-header-row"> <span class="subject">Subject</span> 
            <!--<span class="username">From</span> --> 
            <!--<span class="lowest_bid">Quote</span> --> 
            <span class="date"><a href="/ajax-dashboard-customer-messages/sort-field-created_at/sort-direction-asc" class="">Received</a></span> 
            <!--<span class="delete-message bluebtn dlt">Delete</span>--> </div>
            <?php 
                 $loggedId =Yii::app()->session['loggedId'];
                 
                 $name=ServiceUser::model()->findByPk(array('id'=>$loggedId));
                 $custname=$name->company_name;
                 $lastId =end($inbox);
                  $last  =$lastId['id'];
                  echo "<input type='hidden' id='msgnotify' value='". $last ."'>";  
                 foreach($inbox as $msg1) { 
                     //echo "<pre>";print_r($msg1);
                      
              ?>
            <div class="message close has-more read- first-row unread" id="<?php echo $msg1->id;?>" data-id="17602932">
              <!-- <div class="status read"></div>-->
              <div class="subject"><?php echo $msg1->conversation['subject'];?></div>
              <?php /*
              <div class="username"><span class="provider accredited">
               <?php 
                   if(!empty($companyN)) {
                        foreach($companyN as $name)
                       { 
                ?>
                           <?php echo $name['cname'].' '.$c['clname'];?>
               <?php } } //else { ?>

               <?php //echo "Admin";?>
              <?php //} ?> 
             
              <span class="jobs">
                      
                        
                     (<?php 

                     $count=MsgDetails::model()->findAll(array('condition'=>'conversation_id=:conversation_id AND tomsg=:tomsg AND inbox_dlt_status=:status','params'=>array(
                                 
                                   ':conversation_id'=>$msg1->conversation_id,
                                   ':tomsg'          =>$loggedId, 
                                   ':status'         =>0,
                    )));
                     echo count($count);?>)
                     
              </span>
              </span></div> */?>
              <!--<div class="lowest_bid"><a href="/view-quotes/1849850" class="accept_bid">£525</a></div> -->
              <div class="date"><span title="2014-09-29 23:40:05" class="time-label"><!-- 14 days ago --> 
              <?php  //$dt=strtotime($msg->date); echo date("D", $dt);?>
                <?php  
                

                       /* $date1 = $msg1->date;
                        $date2 = date("Y-m-d");

                        $diff = abs(strtotime($date2) - strtotime($date1));

                        $years = floor($diff / (365*60*60*24));
                        $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
                        $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

                       echo   $days;
                       echo " ";
                       echo "Days";*/
                ?>
                <?php 
                      /*$dateTime = new DateTime($msg1->date); 
                      echo "(";
                      echo $dateTime->format('d-M-Y H:i:s');
                      echo ")";*/
                      echo  date('jS \of F Y  H:i:s',strtotime($msg1->date));
                ?>
              </span></div>
              <!--<div class="delete">
                <input type="checkbox" name="check[]" value="<?php //echo $msg1->conversation['id'];?>" id="delete-comment-17602932">
              </div> -->
            </div>
            
            <div class="message close has-more read- first-row unread detailmsg<?php echo $msg1->id;?>" style="display:none;">
                 
                 <input type="hidden" class="subject<?php echo $msg1->conversation['id'];?>" value="<?php echo $msg1->conversation['subject'];?>">
                <!-- <div class="rply">
                   <label>Reply Now</label>
                 </div>  
                <div class="replysection" id="<?php //echo $bookingId;?>">
                         
                          
                             <input type="hidden" id="recv<?php //echo $msg1->conversation['sender_id'];?>" value="<?php echo $msg1->conversation['sender_id'];?>">
                          <?php //echo CHtml::textArea('Text','',array('class'=>'text'.$msg1->conversation['id'])); ?>
                               <div class="clear"></div> 
                          <?php //echo CHtml::submitButton('Send',array('class'=>'login_in greenbtn sndmsg ','id'=>$msg1->conversation['id'].'-'.$msg1['user_id'])); ?>
                          
                 </div> -->
                    
                <div class="clear"></div>  
               <div id="conversationmsgdiv">
               <div class="main" id="<?php echo $msg1->conversation['id'];?>">
                         <?php 
                              
                               $loggedId=Yii::app()->session['loggedId']; 
                               echo "Message Detail."."</br>";
                               echo "<div class='clear'></div>";
                              
                               foreach($inboxDtal as $detail)
                               {  
                                   
                                   foreach($detail as $d)
                                   {  
                                      //echo "<pre>";print_r($d['conversation_id']); 
                                       if($msg1->conversation_id==$d['conversation_id'])
                                       {   
                                                 if($loggedId==$d['user_id'])
                                                 { 
                                                     echo "<input type='hidden' id='".$d['conversation_id']."' class='append'>";
                                                     echo "<div class='name'>";
                                                     echo $custname;
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
                                                     echo "<input type='hidden' id='".$d['conversation_id']."' class='append'>";
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

                  <!-- <div class="rply">
                   <label>Reply Now</label>
                 </div>  --> 
                <div class="replysection" id="<?php echo $bookingId;?>">                    
                          
                             <input type="hidden" id="recv<?php echo $msg1->conversation['sender_id'];?>" value="<?php echo $msg1->conversation['sender_id'];?>">
                          <?php echo CHtml::textArea('Text','',array('class'=>'text'.$msg1->conversation['id'])); ?>
                               <div class="clear"></div> 
                          <?php echo CHtml::submitButton('Send',array('class'=>'login_in greenbtn ticketsndmsgprovider ','id'=>$msg1->conversation['id'].'-'.$msg1['user_id'])); ?>
                          
                 </div>

            </div>

            <?php }  ?>
            
          </div>
                       
             </div> 