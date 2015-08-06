<script>
$(document).ready(function(){
      $( "#datepicker" ).datepicker({
      minDate: 0,
      
    });
});
 $(function() {
       var js_array = [<?php echo '"'.implode('","', $Post).'"' ?>];

      var availableTags = [];
        $( "#code" ).autocomplete({source: js_array});
});
</script>
<style>
.ui-autocomplete {
            max-height: 100px;
            overflow-y: auto;
            /* prevent horizontal scrollbar */
            overflow-x: hidden;
            /* add padding to account for vertical scrollbar */
            padding-right: 20px;
    }
</style>
<div class="quote_outer_bg" id="home">
  <div class="wrap">
    <div class="quote_outer">
      <div class="cont">
        <div class="trans-buton">
          <h1> Compare cleaning 
            quotes and book now</h1>
        </div>
        <div class="search_outer">
          <?php $form=$this->beginWidget('CActiveForm', array(
			        'action'=> Yii::app()->createUrl('registration/registration/edit',array('id'=>$_REQUEST['id'])),
					'id'=>'quotes',
					'enableClientValidation'=>true,
					'clientOptions'=>array(
					'validateOnSubmit'=>true,

					),
				)); ?>

				          <?php  echo CHtml::textField('CleaningTime[PostCode]',$rec->postcode,array('placeholder'=>'Property Post Code or Area' ,'class'=>'required','id'=>'code'));?>
				         
				          <?php echo CHTML::textField('CleaningTime[CleaningDate]',date('m/d/Y',strtotime($rec->cleaningdate)),array('placeholder'=>'Cleaning Date','id'=>'datepicker' ,));?>
                          
                          <?php foreach($list as $l) {   	?>
                           
                            <?php $t[]=$l->time; 

                                  $res=array_combine($t,$t);

                            ?>

                            <?php }  ?>

                           <?php  echo $form->dropDownList($model,'time',$res,array('options'=>array($rec->cleaningtime=>array('selected'=>true)))); ?>
                            
                              <?php/* foreach($serName as $l) {   	?>
                           
                            <?php $t[]=$l->service_name; 
                                  
                                  $re=array_combine($t,$t);
                                  //echo "<pre>";print_r($res);die;
                            ?>

                            <?php }  */?>
                            

                            <?php  echo $form->dropDownList($service,'service_name',$serName,array('class'=>'edit','options'=>array($rec->booking['service_type_id']=>array('selected'=>true)))); ?>
                           
                            <?php  if(!empty($rec->booking['cleaningDetail'])) { 
                                     

                            ?>
                                   <?php    $r2=explode(",",$rec->booking['cleaningDetail']);
                                    // echo "<pre>";print_r($r2);
                                    foreach($r2 as $resul)
                                    {
                                       $val1=explode("-",$resul);
                                       
                                         $n=$val1[0];
                                         $nam=$val1[1];
                                     ?>     
                                 
                                    <?php echo CHtml::textField('Bookinng['.$nam.']',$n.'-'.$nam,array('placeholder'=>$nam ));?>
                                           
                                  <?php   }   ?>

                            <?php } ?>

                            <?php  if(!empty($rec->booking['additional'])) { 
                                     

                            ?>
                                   <?php    $r2=explode(",",$rec->booking['additional']);
                                    // echo "<pre>";print_r($r2);
                                    foreach($r2 as $resul)
                                    {
                                       $val1=explode("-",$resul);
                                       
                                         $n=$val1[0];
                                         $nam=$val1[1];
                                     ?>     
                                 
                                    <?php echo CHtml::textField('Bookinng['.$nam.']',$n.'-'.$nam,array('placeholder'=>$nam ));?>
                                           
                                  <?php   }   ?>

                            <?php } ?>
                           

				          <?php echo CHtml::submitButton('Submit',array('class'=>'button' ,'value'=>'Confirm Quotes','id'=>'compare'));?>
			              <!--   <input type="text" placeholder="Property Post Code or Area">
					          <input type="text" placeholder="Cleaning Date" id="datepicker">
					          <input type="text" placeholder="Cleaning Time">
					          <input type="button" value="Confirm Quotes" class="button"> -->



          <?php $this->endWidget(); ?>
          

          <p class="script">Get fixed prices from Best cleaning companies (takes only 60 seconds?)</p>
        </div>
      </div>
    </div>
  </div>
  <div class="clear"> </div>
</div>