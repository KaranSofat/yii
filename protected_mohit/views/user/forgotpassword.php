<script>
$(document).ready(function(){
          


           
           

           $('#registration').validate({
                      // rules
                      rules: {
                          password: {
                              required: true,
                              minlength: 3
                          },
                          cpassword: {
                              required: true,
                              minlength: 3,
                              passwordMatch: true // set this on the field you're trying to match
                          }
                      },
                   
                      // messages
                      messages: {
                          password: {
                              required: "What is your password?",
                              minlength: "Your password must contain more than 3 characters"
                          },
                          cpassword: {
                              required: "You must confirm your password",
                              minlength: "Your password must contain more than 3 characters",
                              passwordMatch: "Your Passwords Must Match" // custom message for mismatched passwords
                          }
                      }
                  });
});



$(this).css({

                    "border": "1px solid red",

                    "background": "#FFCECE"

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
                        'action'=> Yii::app()->createUrl('user/forgotpassword'),
                        'id'=>'forgot',
                        'htmlOptions'=>array('enctype'=>'multipart/form-data'),
                        'enableClientValidation'=>true,
                        'clientOptions'=>array(
                        'validateOnSubmit'=>true,

                ),
              )); ?>


           
             
            <div class="right_form"> 

                <?php echo $form->labelEx($model,'email',array('label'=>'Email id')); ?>
                <?php echo $form->textField($model,'email'); ?>
                <?php echo $form->error($model,'email'); ?>
            </div>
         

          
             <div class="clear"></div>
             <?php echo CHtml::submitButton('Submit',array('class'=>'login_in sign_up')); ?>

             <!-- <a class="login_in sign_up" href="#">Submit</a> -->
           <?php $this->endWidget(); ?>
      </div>
     
      
      
     
  </div>
</div></div>
<div class="clear"> </div>