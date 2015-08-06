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
		   <a href ="<?php echo Yii::app()->request->baseUrl; ?>/admin/servicetype/addservicetypeadditional/<?php echo $detail->id;?>">
			    <section style="float:right;margin-bottom:2px;"><div><button class="reset">Add Additional Services</button></div></section>
			</a>
              <?php $form=$this->beginWidget('CActiveForm', array(
			        'action'=> Yii::app()->createUrl('admin/servicetype/servicetypeedit',array('id'=>$detail->id)),
					//'id'=> $companyDetail->id,
					'htmlOptions'=>array('enctype'=>'multipart/form-data'),
					'enableClientValidation'=>true,
					'clientOptions'=>array(
					'validateOnSubmit'=>true,

					),
				)); ?>
					<fieldset>
						<label>Edit Service Type Detail</label>

						<section><?php echo $form->labelEx($model,'service_name'); ?>
							<div>
							      <?php echo $form->textField($model,'service_name',array('value'=>$detail->service_name)); ?>
	                              <?php echo $form->error($model,'service_name'); ?>
	                        </div>
						</section>

							<section><?php echo $form->labelEx($model,'image'); ?>
							<div>
							      <?php echo $form->fileField($model,'image',array('value'=>$detail->image)); ?>
							     
	                              <?php echo $form->error($model,'image'); ?>
							</div>
						</section>
						
						
						<section><?php echo $form->labelEx($model,'desc'); ?>
							<div>

                                  <?php echo $form->TextArea($model,'desc',array('class'=>"editor",'value'=>$detail->desc)); ?>
	                              <?php echo $form->error($model,'desc'); ?>

							</div>
						</section>

						
						<section><?php //echo $form->labelEx($model,'company_logo'); ?>
							<div>
							      <?php //echo $form->fileField($model,'company_logo',array('value'=>$companyDetail->company_logo)); ?>
							     
	                              <?php //echo $form->error($model,'company_logo'); ?>
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
