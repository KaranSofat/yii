<script>
$(document).ready(function(){
          


          /* $( "#registration" ).validate({
                   
                    rules: {
                      password: "required",
                      cpassword: {
                        equalTo: "#password"
                      }
                    }
           });*/

});



$(this).css({

                    "border": "1px solid red",

                    "background": "#FFCECE"

                });


$(function() {
       var js_array = [<?php echo '"'.implode('","', $Post).'"' ?>];

      var availableTags = [];
        $( "#Registration_zipcode" ).autocomplete({source: js_array});
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

<div class="profile_outer">

    <div class="detail_outer sign_2">
     <!-- <h4> Detail </h4> -->
      
          
          
      <div class="detail_m">

            <?php $form=$this->beginWidget('CActiveForm', array(
                        'action'=> Yii::app()->createUrl('registration/registration/registration'),
                        'id'=>'registration',
                        'htmlOptions'=>array('enctype'=>'multipart/form-data'),
                        'enableClientValidation'=>true,
                        'clientOptions'=>array(
                        'validateOnSubmit'=>true,

                ),
              )); ?>


            <div class="left_form">  
                 <?php echo $form->labelEx($model,'company_name',array('label'=>'Company Name')); ?>
                <?php echo $form->textField($model,'company_name'); ?>
                <?php echo $form->error($model,'company_name'); ?> 
                <!--<input type="text" name=""> -->
            </div>
           <div class="right_form">
                <?php echo $form->labelEx($model,'company_logo',array('label'=>'Company Logo')); ?>
               <?php echo $form->fileField($model,'company_logo'); ?>
                <?php echo $form->error($model,'company_logo'); ?> 
            </div>
            
            <div class="left_form"> 
                 <?php echo $form->labelEx($model,'city',array('label'=>'City')); ?>
                <?php echo $form->textField($model,'city'); ?>
                <?php echo $form->error($model,'city'); ?> 
             </div>
           <div class="right_form"> 
               <?php echo $form->labelEx($model,'zipcode',array('label'=>'Zip code'))?>
                <?php echo $form->textField($model,'zipcode');?>
                <?php echo $form->error($model,'zipcode');?>
            </div>
             <div class="left_form"> 
                <?php echo $form->labelEx($model,'phone',array('label'=>'Mobile no.')); ?>
                <?php echo $form->textField($model,'phone'); ?>
                <?php echo $form->error($model,'phone'); ?> 
            </div>
            <div class="right_form"> 

                <?php echo $form->labelEx($model,'email',array('label'=>'Email id')); ?>
                <?php echo $form->textField($model,'email'); ?>
                <?php echo $form->error($model,'email'); ?>
            </div>
           <div class="left_form"> 
                <?php echo $form->labelEx($model,'password',array('label'=>'Password')); ?>
                <?php echo $form->passwordField($model,'password',array('type'=>'password','id'=>'password')); ?>
                <?php echo $form->error($model,'password'); ?>
            </div>

             <div class="right_form"> <label> Confirm Password</label>
               <input type="password" name="Registration[cpassword]" id="cpassword" >
                <?php //echo $form->labelEx($model,'password',array('label'=>'Password')); ?>
                <?php //echo $form->textField($model,'password'); ?>
                <?php echo $form->error($model,'unipassword'); ?>
             
             </div>
             <div class="clear"></div>
             <?php echo CHtml::submitButton('Submit',array('class'=>'login_in sign_up')); ?>

             <!-- <a class="login_in sign_up" href="#">Submit</a> -->
           <?php $this->endWidget(); ?>
      </div>
     
      
      
     
  </div>
</div></div>
<div class="clear"> </div>