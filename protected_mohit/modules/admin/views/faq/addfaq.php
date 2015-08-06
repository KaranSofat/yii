<?php

/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;

?>
        <!-- configuration to overwrite settings-->
	<!--<script src="<?php //echo Yii::app()->request->baseUrl; ?>/themes/back/js/config.js"></script> -->
		
	<!-- the script which handles all the access to plugins etc...  -->
	<!-- <script src="<?php //echo Yii::app()->request->baseUrl; ?>/themes/back/js/script.js">	</script> -->
	<script>
	$(document).ready(function(){
     
        $('.editor').wl_Editor();
       // $('editor').wl_Editor([]);
	});
	</script>

	

	<?php  include('themes/back/views/layouts/left_sidebar.php'); ?>


	<body>
		
		<section id="content">
		        
              <?php $form=$this->beginWidget('CActiveForm', array(
			        'action'=> Yii::app()->createUrl('admin/faq/addfaq'),
					'id'=>'faq',
					
					'enableClientValidation'=>true,
					'clientOptions'=>array(
					'validateOnSubmit'=>true,

					),
				)); ?>
					<fieldset>
						<label>Add Faq</label>
						<section><?php echo $form->labelEx($model,'question'); ?>
							<div>
							      <?php echo $form->textField($model,'question'); ?>
	                              <?php echo $form->error($model,'question'); ?>
	                        </div>
						</section>

						
						<section><?php echo $form->labelEx($model,'answer'); ?>
							<div>

                                  <?php echo $form->TextArea($model,'answer',array('class'=>"editor")); ?>
	                              <?php echo $form->error($model,'answer'); ?>

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
