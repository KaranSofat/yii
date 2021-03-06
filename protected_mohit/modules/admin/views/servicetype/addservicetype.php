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
         $('.editor').wl_Editor([]);
	});
	</script>

	

	<?php  include('themes/back/views/layouts/left_sidebar.php'); ?>


	<body>
		
		<section id="content">
		        
              <?php $form=$this->beginWidget('CActiveForm', array(
				        'action'=> Yii::app()->createUrl('admin/servicetype/addservicetype'),
						'id'=>'addservicetype',
						'enableClientValidation'=>true,
						'htmlOptions'=>array('enctype'=>'multipart/form-data'),
						'clientOptions'=>array(
						'validateOnSubmit'=>true,
						),
				)); ?>
					<fieldset>
						<label>Add Service Type</label>
						<section><?php echo $form->labelEx($model,'service_name'); ?>
							<div>
							      <?php echo $form->textField($model,'service_name'); ?>
	                              <?php echo $form->error($model,'service_name'); ?>
							</div>
						</section>

						<section><?php echo $form->labelEx($model,'image'); ?>
							<div>
							      <?php echo $form->fileField($model,'image'); ?>
							      <?php //echo CHtml::activeFileField($model, 'image'); ?> 
	                              <?php echo $form->error($model,'image'); ?>
							</div>
						</section>
						<!--<section><label for="file_upload">Single File Upload<br><span>your uploaded data will get delete within 1 hour</span></label>
							<div><input type="file" id="file_upload" name="file_upload"></div>
						</section> -->
						<section><?php echo $form->labelEx($model,'desc'); ?>
							<div>

                                  <?php echo $form->TextArea($model,'desc',array('class'=>"editor")); ?>
	                              <?php echo $form->error($model,'desc'); ?>

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
