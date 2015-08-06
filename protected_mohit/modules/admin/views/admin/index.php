<?php

/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;

?>
        <!-- configuration to overwrite settings-->
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/config.js"></script> 
		
	<!-- the script which handles all the access to plugins etc...  -->
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/script.js">
	</script>
	
	

	<?php // include('themes/views/layouts/left_sidebar.php'); ?>


	<body id="login">
		
		<section id="content">
		<?php $form=$this->beginWidget('CActiveForm', array(
			        'action'=> Yii::app()->createUrl('admin/admin/login'),
					'id'=>'login-form',
					'enableClientValidation'=>true,
					'clientOptions'=>array(
					'validateOnSubmit'=>true,

					),
				)); ?>
			<fieldset>
				<section>
				   <?php echo $form->labelEx($model,'username'); ?>
					<div>
						 <?php echo $form->textField($model,'username'); ?>
	                     <?php echo $form->error($model,'username'); ?>
                   	</div>
				</section>
               <input type="hidden" name="LoginForm[usertype]" value="admin">
				<section>
				    <?php echo $form->labelEx($model,'password'); ?>
					<div>
					   <?php echo $form->passwordField($model,'password'); ?>
                       <?php echo $form->error($model,'password'); ?>
					</div>
					<div>
                         <?php echo $form->checkBox($model,'rememberMe'); ?>
						<?php echo $form->label($model,'rememberMe'); ?>
						<?php echo $form->error($model,'rememberMe'); ?>

					</div>
				</section>
				<section>
				   <div>
					<button class="fr submit" style="padding: 0px; height: 38px; width: 15px; line-height: 10px;">				
						<?php echo CHtml::submitButton('Login'); ?>
						</button>
					</div>
				</section>
			</fieldset>
		<?php $this->endWidget(); ?>
		</section> 
      
		
</body>
