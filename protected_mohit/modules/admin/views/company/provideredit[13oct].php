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
        
	});
	</script>

	

	<?php  include('themes/back/views/layouts/left_sidebar.php'); ?>


	<body>
		
		<section id="content">
		        
              <?php $form=$this->beginWidget('CActiveForm', array(
			        'action'=> Yii::app()->createUrl('admin/company/provideredit',array('id'=>$companyDetail->id)),
					'id'=> $companyDetail->id,
					'htmlOptions'=>array('enctype'=>'multipart/form-data'),
					'enableClientValidation'=>true,
					'clientOptions'=>array(
					'validateOnSubmit'=>true,

					),
				)); ?>
					<fieldset>
						<label>Edit Company Detail</label>
						<section><?php echo $form->labelEx($model,'company_name'); ?>
							<div>
							      <?php echo $form->textField($model,'company_name',array('value'=>$companyDetail->company_name)); ?>
	                              <?php echo $form->error($model,'company_name'); ?>
	                        </div>
						</section>

						<section><?php echo $form->labelEx($model,'city'); ?>
							<div>
							      <?php echo $form->textField($model,'city',array('value'=>$companyDetail->city)); ?>
	                              <?php echo $form->error($model,'city'); ?>
							</div>
						</section>
						
						
						<section><?php echo $form->labelEx($model,'zipcode'); ?>
							<div>
							      <?php echo $form->textField($model,'zipcode',array('value'=>$companyDetail->zipcode)); ?>
	                              <?php echo $form->error($model,'zipcode'); ?>
							</div>
						</section>
						<section><?php echo $form->labelEx($model,'phone',array('label'=>'Contact Number')); ?>
							<div>
							      <?php echo $form->textField($model,'phone',array('value'=>$companyDetail->phone)); ?>
	                              <?php echo $form->error($model,'phone'); ?>
							</div>
						</section>
						
						<section><?php echo $form->labelEx($model,'company_logo'); ?>
							<div>
							      <?php echo $form->fileField($model,'company_logo',array('value'=>$companyDetail->company_logo)); ?>
							     
	                              <?php echo $form->error($model,'company_logo'); ?>
							</div>
						</section>


                        <label>Other Details</label>
                             <?php foreach($companyDetail->priceAdmins as $i=>$service) {
                                     



                              ?>

			                             <section><?php echo $form->labelEx($model,'Service Type'); ?>
												<div>
												      <?php echo $service->serviceType['service_name'];?>
												      <?php //echo $form->textField($model,'company_logo',array('value'=>$service->serviceType['service_name'])); ?>
												     
						                              <?php //echo $form->error($model,'company_logo'); ?>
												</div>
									     </section>


									     <section><?php echo $form->labelEx($model,'Bedroom Price'); ?>
												<div>
												      <?php //echo $service->bedroom;?>
												      <?php echo $form->textField($model,$i,array('value'=>$service->bedroom, 'class'=>'integer','name'=> 'PriceAdmin['.$service->service_type_id.'][]')); ?>
												     
						                              <?php echo $form->error($model,$i); ?>
												</div>
									     </section>
			                             

			                             
									     <section><?php echo $form->labelEx($model,'Bathroom Price'); ?>
												<div>
												      <?php //echo $service->bedroom;?>
												      <?php echo $form->textField($model,$i,array('value'=>$service->bathroom, 'class'=>'integer','name'=> 'PriceAdmin['.$service->service_type_id.'][]')); ?>
												     
						                              <?php echo $form->error($model,$i); ?>
												</div>
									     </section>

									     <?php if(!empty($service->property) || !empty($service->desk)) { ?>

                                          
									     <section><?php echo $form->labelEx($model,'Property Price'); ?>
												<div>
												      <?php //echo $service->bedroom;?>
												      <?php echo $form->textField($model,$i,array('value'=>$service->property, 'class'=>'integer','name'=> 'PriceAdmin['.$service->service_type_id.'][]')); ?>
												     
						                              <?php echo $form->error($model,$i); ?>
												</div>
									     </section>


									     <section><?php echo $form->labelEx($model,'Desk Price'); ?>
												<div>
												      <?php //echo $service->bedroom;?>
												      <?php echo $form->textField($model,$i,array('value'=>$service->desk, 'class'=>'integer','name'=> 'PriceAdmin['.$service->service_type_id.'][]')); ?>
												     
						                              <?php echo $form->error($model,$i); ?>
												</div>
									     </section>
                                           


									     <?php } ?>
                           

                             <?php } ?>






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
