<?php

/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;

?>
        <!-- configuration to overwrite settings-->
	<!--<script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/back/js/config.js"></script> -->
		
	<!-- the script which handles all the access to plugins etc...  -->
	<!-- <script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/back/js/script.js">	</script> -->
	<script>
	
	</script>

	

	<?php  include('themes/back/views/layouts/left_sidebar.php'); ?>


	<body>
		
		<section id="content">
		       
		       <div class="alert success" style="display:none;">Successfully deleted.</div>

              <?php $form=$this->beginWidget('CActiveForm', array(
			        'action'=> Yii::app()->createUrl('admin/company/addProvider'),
					'id'=>'company-form',
					'enableClientValidation'=>true,
					'clientOptions'=>array(
					'validateOnSubmit'=>true,

					),
				)); ?>

				<input type="hidden" id="formId" value="" name="Company">
					<fieldset>
						<label>Add Company </label>
						
						<section>
							<?php echo $form->labelEx($model,'company_name',array('label'=>'Company Name')); ?>
							
							<div>
							    <?php echo $form->textField($model,'company_name',array('class'=>'varchar','type'=>'text')); ?>
                          		<?php echo $form->error($model,'company_name'); ?>
                            </div>
	                         
						</section>
						<section>
							<?php echo $form->labelEx($model,'company_logo',array('label'=>'Company Logo')); ?>
							
							<div>
							    <?php echo $form->fileField($model,'company_logo',array('class'=>'varchar','type'=>'text')); ?>
                          		<?php echo $form->error($model,'company_logo'); ?>
                            </div>
	                         
						</section>
						<section>
							<?php echo $form->labelEx($model,'email',array('label'=>'Email Id')); ?>
							
							<div>
							    <?php echo $form->textField($model,'email',array('class'=>'varchar','type'=>'text')); ?>
                          		<?php echo $form->error($model,'email'); ?>
                            </div>
	                         
						</section>
						<section>
							<?php echo $form->labelEx($model,'password',array('label'=>'Password')); ?>
							
							<div>
							    <?php echo $form->textField($model,'password',array('class'=>'varchar','type'=>'password')); ?>
                          		<?php echo $form->error($model,'password'); ?>
                            </div>
	                         
						</section>
						<section>
							<?php echo $form->labelEx($model,'city',array('label'=>'City')); ?>
							
							<div>
							    <?php echo $form->textField($model,'city',array('class'=>'varchar','type'=>'text')); ?>
                          		<?php echo $form->error($model,'city'); ?>
                            </div>
	                         
						</section>
						<section>
							<?php echo $form->labelEx($model,'zipcode',array('label'=>'Zip Code')); ?>
							
							<div>
							    <?php echo $form->textField($model,'zipcode',array('class'=>'varchar','type'=>'text')); ?>
                          		<?php echo $form->error($model,'zipcode'); ?>
                            </div>
	                         
						</section>
						
                    	<section class="frmBtns">
                    		
            				<a href ="<?php echo Yii::app()->request->baseUrl; ?>/admin/company/providerdetails">
								<button class="btnCancel">Cancel</button>
							</a>
							<!--<button class="reset">Reset</button>-->
                            <button class="submit" style=" height: 38px;line-height:6px;text-transform:none;width:58px !important;">
							<?php echo CHtml::submitButton('Submit',array('class'=>'button reset')); ?>
							</button>
							<!--<button class="submit" name="submitbuttonname" value="submitbuttonvalue">Submit</button>-->
					
						</section>
					</fieldset>
				<?php $this->endWidget(); ?>

                                    
		</section> 
      
		
   </body>
