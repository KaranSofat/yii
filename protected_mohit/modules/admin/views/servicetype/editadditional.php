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
			        'action'=> Yii::app()->createUrl('admin/servicetype/editadditional',array('id'=>$detail->id)),
					//'id'=> $companyDetail->id,
					//'htmlOptions'=>array('enctype'=>'multipart/form-data'),
					'enableClientValidation'=>true,
					'clientOptions'=>array(
					'validateOnSubmit'=>true,

					),
				)); ?>
					<fieldset>
						<label>Edit Additional Service Detail</label>

						<section><?php echo $form->labelEx($model,'additional_service_name'); ?>
							<div>
							      <?php echo $form->textField($model,'additional_service_name',array('value'=>$detail->additional_service_name)); ?>
	                              <?php echo $form->error($model,'additional_service_name'); ?>
	                        </div>
						</section>
                        <section><?php echo $form->labelEx($model,'additional_service_price'); ?>
							<div>
							      <?php echo $form->textField($model,'additional_service_price',array('value'=>$detail->additional_service_price)); ?>
	                              <?php echo $form->error($model,'additional_service_price'); ?>
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
