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
       $( "#homeimage" ).validate({
				  rules: {
				    url: {
				        //required: true,
				        url: true
				    }
				  }
				}); 
	});
	
	</script>

	

	<?php  include('themes/back/views/layouts/left_sidebar.php'); ?>


	<body>
		

		<section id="content">
		 <?php if(Yii::app()->user->hasFlash('success')):?>
				    <div class="alert warning">
				        <?php echo Yii::app()->user->getFlash('success'); ?>
				    </div>
        <?php endif; ?>
		        
              <?php $form=$this->beginWidget('CActiveForm', array(
			        'action'=> Yii::app()->createUrl('admin/images/addhomeimage'),
					'id'=>'homeimage',
					'htmlOptions'=>array('enctype'=>'multipart/form-data'),
					'enableClientValidation'=>true,
					'clientOptions'=>array(
					'validateOnSubmit'=>true,

					),
				)); ?>
					<fieldset>
						<label>Add Image </label>
						

						<section><?php echo $form->labelEx($model,'image'); ?>
							<div>
							      <?php echo $form->fileField($model,'image',array()); ?>
							     
	                              <?php echo $form->error($model,'image'); ?>
							</div>
						</section>

						<section><?php echo $form->labelEx($model,'url'); ?>
							<div>
							      <?php echo $form->textField($model,'url',array('class'=>'url ')); ?>
	                              <?php echo $form->error($model,'url'); ?>
	                        </div>
						</section>
						
					
						
					</fieldset>
					
						<section>
							<div>
									<!--<button class="reset">Reset</button>-->
                                    <button class="submit" style=" height: 38px;line-height:6px;text-transform:none;width:58px !important;">
									<?php echo CHtml::submitButton('Submit',array('class'=>'button reset')); ?>
									</button>
									<!--<button class="submit" name="submitbuttonname" value="submitbuttonvalue">Submit</button>-->
							</div>
						</section>
					</fieldset>
				<?php $this->endWidget(); ?>
                

		</section> 
      
		
   </body>
