<div class="title" id="service">
  <div class="wrap">
    <h2>Log in</h2>
  </div></div>
  
  
  <div class="clear"> </div>
  <div class="wrap">
  <?php if(Yii::app()->user->hasFlash('login')):?>
    <div class="info">
        <?php echo Yii::app()->user->getFlash('login'); ?>
    </div>
<?php endif; ?>
		  <div class="login-block">
		  <?php echo Yii::app()->user->getFlash('serviceforgot'); ?>
		  <?php if(Yii::app()->user->hasFlash('emailcheck')):?>
					    <div class="info">
					        <?php echo Yii::app()->user->getFlash('emailcheck'); ?>
					    </div>
          <?php endif; ?>
          <?php if(!empty($msg)):?>
					    <div class="info in">
					        <?php echo $msg; ?>
					    </div>
          <?php endif; ?>


					<p class="larger center">Log in </p>

                    <?php $form=$this->beginWidget('CActiveForm', array(
                        'action'=> Yii::app()->createUrl('registration/registration/index'),
                        'id'=>'login',
                        //'htmlOptions'=>array('enctype'=>'multipart/form-data'),
                        'enableClientValidation'=>true,
                        'clientOptions'=>array(
                        'validateOnSubmit'=>true,

                      ),
                    )); ?> 


					<div class="form-fields-wrapper">
					<div class="pad-top">
					<div class="form-label">
					    <?php echo $form->labelEx($model,'email',array('label'=>'Email')); ?>
					</div>
					<div class="form-line">
							<div class="input email required user_session_email">
							    <?php echo $form->textField($model,'email'); ?>
                                 <?php echo $form->error($model,'email'); ?> 
							</div>
					</div>
					</div>

                     <div class="pad-top">
					<div class="form-label">
					    <label>Login As</label>
					</div>
					<div class="form-line">
							<div class="input email required user_session_email">
							    
							      <?php 
							            echo CHtml::dropDownList('LoginForm[logintype]',

				                        array('customer'=>'Customer','company'=>'Company'),

				                        array('customer'=>'Customer','company'=>'Company'));

                                   ?>
                                  


							</div>
					</div>
					</div>
 


					<div class="pad-top">
						<div class="form-label">
						<?php echo $form->labelEx($model,'password',array('label'=>'Password')); ?>
						</div>
						<div class="form-line">
								<div class="input password required user_session_password">
								     <?php echo $form->passwordField($model,'password'); ?>
                                      <?php echo $form->error($model,'password'); ?> 
                                 </div>
								 
								 <input type="hidden" value="true" name="user_session[remember_me]" id="user_session_remember_me">
								
						</div>
					</div>
					</div>
					<div class="even-smaller center">
					   <a class="alt-link" href="<?php echo Yii::app()->createUrl('user/forgotpassword')?>">Forgot password?</a>
					</div>
					<div class="form-fields-wrapper">
					<div class="form-steps-bottom"></div>
					 <!--<a class="login_in" href="#"> Log in </a> -->
					 <?php echo CHtml::submitButton('Login',array('class'=>'login_in ')); ?>
					</div>

                     <?php $this->endWidget(); ?>

					<div class="pad-top2">

					</div>

		</div>
  </div>
<!--</div>

</div> -->