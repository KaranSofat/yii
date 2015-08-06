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
				        'action'=> Yii::app()->createUrl('message/message/createmessage'),
						'id'=>'addservicetype',
						'enableClientValidation'=>true,
						//'htmlOptions'=>array('enctype'=>'multipart/form-data'),
						'clientOptions'=>array(
						'validateOnSubmit'=>true,
						),
				)); ?>
					<fieldset>
						<label>Add Service Type</label>
						
                        <section><label>To</label>
							<div>
							      <label>Customer</label> 
							      <?php echo CHtml::radioButton('btn', false, array(
													'value'=>'customer',
													'name'=>'Customer',
													
													'uncheckValue'=>null
													));
                                   ?>
                                   <label>Company</label>
	                              <?php echo CHtml::radioButton('btn', true, array(
													'value'=>'company',
													'name'=>'Company',
													 'checked'=>'checked',
													'uncheckValue'=>null
													));

								    ?>
							</div>
						</section>  


						<section><?php echo $form->labelEx($model,'reciver_id',array('label'=>'Email')); ?>
							<div>
							      <?php echo $form->textField($model,'reciver_id',array('id'=>'email','value'=>" ")); ?>
	                              <?php echo $form->error($model,'reciver_id'); ?>
							</div>
						</section> 

						<section><?php echo $form->labelEx($model,'subject'); ?>
							<div>
							      <?php echo $form->textField($model,'subject'); ?>
	                              <?php echo $form->error($model,'subject'); ?>
							</div>
						</section>

						
						<!--<section><label for="file_upload">Single File Upload<br><span>your uploaded data will get delete within 1 hour</span></label>
							<div><input type="file" id="file_upload" name="file_upload"></div>
						</section> -->
						<section><?php echo $form->labelEx($msg,'msg'); ?>
							<div>

                                  <?php echo $form->TextArea($msg,'msg',array('class'=>"editor")); ?>
	                              <?php echo $form->error($msg,'msg'); ?>

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
