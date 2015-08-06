<style type="text/css">
input.same {
width: 19%;
}
input.count {
width: 19%;
}
.about_in > p {
    margin: 0 0 0px;
}
.left{
  width:20%;
}
select#beds, #baths, #property
{
  width:19%;
}
</style>
<script type="text/javascript">
$(document).ready(function(){
          $("input").blur(function(){
               var id="<?php echo $id;?>";
               //alert(id)
               var value      =$(this).val();
               var key        =$(this).attr('id');
               var res        =key+"="+value;
               var booking_id ="<?php echo $_REQUEST['booking_id']?>";
               //var object = {value};
               var data=$("#jobstatus"+id).serialize();
               
                     $.ajax({
                             type:'GET',  
                            url:"<?php echo Yii::app()->createUrl('registration/registration/ajaxupdatePrice')?>",
                            data:data, 
                            //data:{'value':value,'key':key,'booking_id':booking_id},
                            //dataType: "json",
                             success:function(result)
                             {
                                    //alert(result); 
                                    $('.price').hide();
                                    $(".newprice").html(result);                         
                             },
                             error: function (result) {
                             // alert("Error.")
                            
                                  return false;
                            }
                       }); 


                 
               
          });

      $(".greenbtnjob").click(function(){
            
            var id=$(this).attr('id');
            var data=$("#jobstatus"+id).serialize();
            
            var ids          ="<?php echo $bookingrec['id'];?>";
            var loggedId    ="<?php echo Yii::app()->session['loggedId'];?>";   
                     $.ajax({
                             type:'GET',  
                            url:"<?php echo Yii::app()->createUrl('registration/registration/updatePriceForQuote')?>",
                            data:data, 
                            //data:{'value':value,'key':key,'booking_id':booking_id},
                            //dataType: "json",
                             success:function(result)
                             {
                                    //alert(result);
                                   // return true; 

                                     // msg list 
                                        
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

                                   return true;
                                                          
                             },
                             error: function (result) {
                             // alert("Error.")
                            
                                  return false;
                            }
                       }); 



                     
      });
});
</script>
<?php /*<div class="title" id="service">
  <div class="wrap">
    <h2>View Quotes:<?php echo $bookingrec->customer['cname']."  ".$bookingrec->customer['clname'];?></h2>
  </div>
  </div>
  
  
  <div class="clear"> </div> */ ?>
  <div class="jobs">
  
   <div class="left1">
      <h5>Details</h5>

        <?php 
            $res=$bookingrec['cleaningDetail'];

            $r=explode(",",$res);

            foreach($r as $result)
            {
            	 $val=explode("-",$result);
            		
	            	 $no=$val[0];
	            	 $name=$val[1];
	             if(!empty($res))
	            { 
	            	 echo "<div class='wwe'>".$name." : ".$no."</div>";

            	}

              echo "<input type='hidden' name='".$name."' value='".$no."' class='count'>";
            } 	//echo "<pre>";print_r($final);die;

              //echo "<pre>";print_r($priceAdmin);die;
             
       ?>

 
          <?php 
            $res1=$bookingrec['additional'];

            $r2=explode(",",$res1);

            foreach($r2 as $resul)
            {
               $val1=explode("-",$resul);
               
                 $n=$val1[0];
                 $nam=$val1[1];
                  if(!empty($res1))
                 {  

                    echo "</br>".$nam." : ".$n."</br>";
                   }
                   echo "<input type='hidden' name='".$nam."' value='".$n."' class='countAdnl'>";
            }   //echo "<pre>";print_r($final);die;
       ?>
  
  <?php if(empty($bookingrec->additionalParticularPrices)) { ?>
        <div class="price">Total Price : <?php echo $bookingrec['price']; ?></div>
  <?php } else { 
           
           foreach($bookingrec->additionalParticularPrices as $price)
           {
              $p[]=$price['total_price'];
          
           } 
           $price=array_unique($p);
           //echo "<pre>";print_r($price);die;
    ?>
             <div class="price">Total Price : <?php echo $price[0]; ?></div>
  <?php } ?>

  <div class="newprice"></div>
  </div>
     
         <div class="rightjob">
              <h5>Price Details</h5>
               <div class="formjob">
                  <?php $form=$this->beginWidget('CActiveForm', array(
                              'action'=> Yii::app()->createUrl('registration/registration/ChnagequotesDashboardSpeciUser'),
                              'id'=>'jobstatus'.$id,
                              'enableClientValidation'=>true,
                              'htmlOptions'=>array('onsubmit'=>'return false'),
                              'clientOptions'=>array(
                              'validateOnSubmit'=>true,
                              ),
                          )); ?>
                          <?php $loggedId= Yii::app()->session['loggedId'];?>
                         <input type="hidden" name="loggedId" value="<?php echo $loggedId; ?>"> 
                         <input type="hidden" name="booking_id" value="<?php echo $bookingrec['id'];?>">
                         
                         <input type="hidden" name="customer_id" value="<?php echo $bookingrec->customer['id'];?>">
                         
                         <!-- no of bedrooms ,bathrooms etc-->
                         <?php 
                                    $res=$bookingrec['cleaningDetail'];

                                    $r=explode(",",$res);

                                    foreach($r as $result)
                                    {
                                       $val=explode("-",$result);
                                        
                                         $no=$val[0];
                                         $name=$val[1];
                            ?>            
                                       
                                  <input type="hidden" name="noBedBathDesk[<?php echo $name;?>]" value="<?php echo $no;?>">
                              <?php  }  ?>
                        
                        <!-- check the record in new particular table -->
                        <?php if(empty($particularRec)) {  ?> 

                                        <div class="labeljob">
                                          <?php  echo $form->labelEx($admin,'bedroom',array('class'=>'')); ?>
                                             <div class="fieldjob"> 
                                              <?php echo  $form->textField($admin,'bedroom',array('value'=>$priceAdmin['bedroom'],'class'=>'jobsame','width'=>"10")); ?>
                                             </div>

                                        </div>
                                       

                                        <div class="labeljob">
                                         <?php  echo $form->labelEx($admin,'bathroom',array()); ?>
                                            <div class="fieldjob">
                                            <?php echo  $form->textField($admin,'bathroom',array('value'=>$priceAdmin['bathroom'],'class'=>'jobsame')); ?>
                                            </div>
                                        </div> 

                                        <?php if($priceAdmin['service_type_id']==3) { ?>
                                               
                                                      <div class="labeljob">
                                                      <?php  echo $form->labelEx($admin,'property',array()); ?>
                                                       <div class="fieldjob">
                                                      <?php echo  $form->textField($admin,'property',array('value'=>$priceAdmin['property'],'class'=>'jobsame','width'=>"10")); ?>
                                                      </div>
                                                      </div>
                                                      

                                                      <div class="labeljob">
                                                      <?php  echo $form->labelEx($admin,'desk',array('label'=>'Desk Price')); ?>
                                                       <div class="fieldjob">
                                                      <?php echo  $form->textField($admin,'desk',array('value'=>$priceAdmin['desk'],'class'=>'jobsame')); ?>
                                                      </div>
                                                      </div>
                                                       

                                        <?php } ?>

                      <?php } else { ?>

                                         <div class="labeljob">
                                         <?php  echo $form->labelEx($admin,'bedroom',array('')); ?>
                                           <div class="fieldjob">
                                        <?php echo  $form->textField($admin,'bedroom',array('value'=>$particularRec['bedroom'],'class'=>'jobsame','id'=>'bedroom')); ?>
                                        </div>
                                         </div>
                                       

                                        <div class="labeljob">
                                        <?php  echo $form->labelEx($admin,'bathroom',array()); ?>

                                        <div class="fieldjob">
                                        <?php echo  $form->textField($admin,'bathroom',array('value'=>$particularRec['bathroom'],'class'=>'jobsame','id'=>'bathroom')); ?>
                                        </div> 
                                         </div> 
                                        <?php if($priceAdmin['service_type_id']==3) { ?>
                                               
                                                      <div class="labeljob">
                                                      <?php  echo $form->labelEx($admin,'property',array()); ?>
                                                      <div class="fieldjob">
                                                      <?php echo  $form->textField($admin,'property',array('value'=>$particularRec['property'],'class'=>'jobsame','width'=>"10",'id'=>'property')); ?>
                                                      </div>
                                                      </div>
                                                      

                                                      <div class="labeljob">
                                                      <?php  echo $form->labelEx($admin,'desk',array('label'=>'Desk Price')); ?>
                                                       <div class="fieldjob">
                                                      <?php echo  $form->textField($admin,'desk',array('value'=>$particularRec['desk'],'class'=>'jobsame','id'=>'desk')); ?>
                                                      </div> 
                                                      </div>
                                                     

                                        <?php } ?>
                      <?php } ?>
                      
                    <!-- check here trh record from new particular table additional -->
                     <?php 
                           

                          if(empty($particularRec)) { 
                                  
                                   //$particular[]=$particularRec;

                           ?>
                                 <?php foreach($addPriceDetl as $detail ) 
                                       {
                                             //echo "<pre>";print_r($detail);
                                                $res1=$bookingrec['additional'];

                                                      $r2=explode(",",$res1);

                                                      foreach($r2 as $resul)
                                                      {
                                                         $val1=explode("-",$resul);
                                                         
                                                            $n=$val1[0];
                                                            $nam=$val1[1];                                   
                                                           if($nam==$detail->additionalService ['service_name'])
                                                           {     
                                               ?>
                                                          <input type="hidden" name="adnl[<?php echo $detail->additionalService ['id']; ?>]" value="<?php echo $n;?>">
                                                  <div class="labeljob">
                                                  <?php  echo $form->labelEx($adnl,$detail->additionalService ['service_name'],array()); ?>
                                                   <div class="fieldjob">
                                                  <?php echo  $form->textField($adnl,$detail->additionalService ['id'],array('value'=>$detail['price'],'class'=>'jobsame','width'=>"10")); ?>
                                                  </div>
                                                  </div>
                                                  


                                 <?php } } } ?>

                       <?php  } else { //echo "<pre>";print_r($particularRec->service->additionalParticularPrices);die; ?>
                                     
                                      <?php 
                                       $particular[]=$particularRec;
                                       foreach($particular as $det ) 
                                       {
                                          // echo "<pre>";print_r($det->service->additionalParticularPrices);
                                             if(!empty($det->service->additionalParticularPrices))
                                             { 
                                                 foreach($det->service->additionalParticularPrices as $d)
                                                {
                                                  //echo "<pre>";print_r($d->additionalService['service_name']); 
                                                  //echo "<pre>";print_r($d['price']); 
                                                    
                                                $res=$bookingrec['additional'];
                                                 
                                                      $r=explode(",",$res);

                                                      foreach($r as $resul)
                                                      {
                                                         $val1=explode("-",$resul);
                                                         
                                                            $n=$val1[0];
                                                            $nam=$val1[1];                                   
                                                           if($nam==$d->additionalService ['service_name'])
                                                           {     
                                               ?>
                                                          <input type="hidden" name="adnl[<?php echo $d->additionalService['id']; ?>]" value="<?php echo $n;?>">
                                                  <div class="labeljob">
                                                  <?php  echo $form->labelEx($adnl,$d->additionalService['service_name'],array()); ?>
                                                   <div class="adnlfield">
                                                  <?php echo  $form->textField($adnl,$d->additionalService ['id'],array('value'=>$d['price'],'class'=>'same','width'=>"10")); ?>
                                                  </div>

                                                  </div>
                                                  


                                 <?php } } } } } ?>


                       <?php } ?>   
                   <?php echo $form->labelEx($conversation,'msg',array('label'=>'Comment')); ?>
                  <?php echo $form->TextArea($conversation,'msg',array('id'=>'msgupdatequote')); ?>
                                                                  
              <?php echo CHtml::submitButton('Update',array('class'=>'greenbtnjob','id'=>$id)); ?>
             <?php $this->endWidget(); ?>
           </div>
</div>

               <!-- additional Prices -->
                

  
  </div>

  
