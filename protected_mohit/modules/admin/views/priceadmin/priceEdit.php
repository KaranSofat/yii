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
		        
              <?php $form=$this->beginWidget('CActiveForm', array(
			        'action'=> Yii::app()->createUrl('admin/priceadmin/priceEdit',array('id'=>$edit->id)),
					'id'=> 'serviceEdit',
					'enableClientValidation'=>true,
					'clientOptions'=>array(
					'validateOnSubmit'=>true,

					),
				)); ?>
					<fieldset>
						<label>Edit Price</label>
						<section><?php echo $form->labelEx($model,'service_id',array('label'=>'Company')); ?>
							<div>
							       <?php echo $edit->service['company_name']?> 
							      <?php //echo $form->textField($model,'service_id',array('value'=>$edit->serviceType['service_name'],'readonly'=>true)); ?>
	                              <?php //echo $form->error($model,'service_id'); ?>
	                        </div>
						</section>  
                        
                        <section><?php echo $form->labelEx($model,'service_id',array('label'=>'Service Type')); ?>
							<div>
							       <?php echo $edit->serviceType['service_name']?> 
							      <?php //echo $form->textField($model,'service_id',array('value'=>$edit->serviceType['service_name'],'readonly'=>true)); ?>
	                              <?php //echo $form->error($model,'service_id'); ?>
	                        </div>
						</section>  

					    <input type="hidden" name="ServicePriceEdit[id]" value="<?php echo $edit->id ?>">
						<section><?php echo $form->labelEx($model,'bedroom',array('label'=>'Bedroom Price')); ?>
							<div>
							      $<?php echo $form->textField($model,'bedroom',array('value'=>$edit->bedroom , 'class'=>'integer')); ?>
	                              <?php echo $form->error($model,'bedroom'); ?>
	                              /
	                              <?php echo $form->textField($model,'bedroom_hr',array('value'=>$edit->bedroom_hr , 'class'=>'integer')); ?>
	                              <?php echo $form->error($model,'bedroom_hr'); ?>
	                              hour(s)
							</div>
						</section>
						<section><?php echo $form->labelEx($model,'bathroom',array('label'=>'Bathroom Price')); ?>
							<div>
							      $<?php echo $form->textField($model,'bathroom',array('value'=>$edit->bathroom ,'class'=>'integer')); ?>
	                              <?php echo $form->error($model,'bathroom'); ?>
	                              /
	                              <?php echo $form->textField($model,'bathroom_hr',array('value'=>$edit->bathroom_hr ,'class'=>'integer')); ?>
	                              <?php echo $form->error($model,'bathroom_hr'); ?>
	                              hour(s)
							</div>
						</section>
                        
                        <section><?php echo $form->labelEx($model,'living_room',array('label'=>'Living Room Price')); ?>
							<div>
							      $<?php echo $form->textField($model,'living_room',array('value'=>$edit->living_room ,'class'=>'integer')); ?>
	                              <?php echo $form->error($model,'living_room'); ?>
	                              /
	                              <?php echo $form->textField($model,'living_room_hr',array('value'=>$edit->living_room_hr ,'class'=>'integer')); ?>
	                              <?php echo $form->error($model,'living_room_hr'); ?>
	                              hour(s)
							</div>
						</section>

						<section><?php echo $form->labelEx($model,'kitchen_staircases',array('label'=>'Kitchen StairCase Price')); ?>
							<div>
							      $<?php echo $form->textField($model,'kitchen_staircases',array('value'=>$edit->kitchen_staircases ,'class'=>'integer')); ?>
	                              <?php echo $form->error($model,'kitchen_staircases'); ?>
	                              /
	                              <?php echo $form->textField($model,'kitchen_staircases_hr',array('value'=>$edit->kitchen_staircases_hr ,'class'=>'integer')); ?>
	                              <?php echo $form->error($model,'kitchen_staircases_hr'); ?>
	                              hour(s)
							</div>
						</section>

						<section><?php echo $form->labelEx($model,'kitchen',array('label'=>'Carpets Interior Windows Price')); ?>
							<div>
							      $<?php echo $form->textField($model,'carpets_interior_windows',array('value'=>$edit->carpets_interior_windows,'class'=>'integer')); ?>
	                              <?php echo $form->error($model,'carpets_interior_windows'); ?>
	                              /
	                              <?php echo $form->textField($model,'carpets_interior_windows_hr',array('value'=>$edit->carpets_interior_windows_hr,'class'=>'integer')); ?>
	                              <?php echo $form->error($model,'carpets_interior_windows_hr'); ?>
	                              hour(s)
							</div>
						</section>
						
						<?php if(!empty($edit->property) && !empty($edit->desk)) { ?>
						
						<section><?php echo $form->labelEx($model,'desk',array('label'=>'Desk Price')); ?>
							<div>
							      $<?php echo $form->textField($model,'desk',array('value'=>$edit->desk,'class'=>'integer')); ?>
	                              <?php echo $form->error($model,'desk'); ?>
	                              /
	                              <?php echo $form->textField($model,'desk_hr',array('value'=>$edit->desk_hr,'class'=>'integer')); ?>
	                              <?php echo $form->error($model,'desk_hr'); ?>
	                              hour(s)
							</div>
						</section>

						<section><?php echo $form->labelEx($model,'property',array('label'=>'Property Price')); ?>
							<div>
							      $<?php echo $form->textField($model,'property',array('value'=>$edit->property,'class'=>'integer')); ?>
	                              <?php echo $form->error($model,'property'); ?>
	                              /
	                              <?php echo $form->textField($model,'property_hr',array('value'=>$edit->property_hr,'class'=>'integer')); ?>
	                              <?php echo $form->error($model,'property_hr'); ?>
	                              hour(s)
							</div>
						</section>

                        <section><?php echo $form->labelEx($model,'cupboards',array('label'=>'Cupboards Price')); ?>
							<div>
							      $<?php echo $form->textField($model,'cupboards',array('value'=>$edit->cupboards,'class'=>'integer')); ?>
	                              <?php echo $form->error($model,'cupboards'); ?>
	                              /
	                              <?php echo $form->textField($model,'cupboards_hr',array('value'=>$edit->cupboards_hr,'class'=>'integer')); ?>
	                              <?php echo $form->error($model,'cupboards_hr'); ?>
	                              hour(s)
							</div>
						</section>
						<section><?php echo $form->labelEx($model,'kitchen',array('label'=>'Kitchen Price')); ?>
							<div>
							      $<?php echo $form->textField($model,'kitchen',array('value'=>$edit->kitchen,'class'=>'integer')); ?>
	                              <?php echo $form->error($model,'kitchen'); ?>
	                              /
	                              <?php echo $form->textField($model,'kitchen_hr',array('value'=>$edit->kitchen_hr,'class'=>'integer')); ?>
	                              <?php echo $form->error($model,'kitchen_hr'); ?>
	                              hour(s)
							</div>
						</section>
						<section><?php echo $form->labelEx($model,'staircases',array('label'=>'Staircase Price')); ?>
							<div>
							      $<?php echo $form->textField($model,'staircases',array('value'=>$edit->staircases,'class'=>'integer')); ?>
	                              <?php echo $form->error($model,'staircases'); ?>
	                              /
	                              <?php echo $form->textField($model,'staircases_hr',array('value'=>$edit->staircases_hr,'class'=>'integer')); ?>
	                              <?php echo $form->error($model,'staircases_hr'); ?>
	                              hour(s)
							</div>
						</section>



						<?php } ?>
						
						<section><?php echo $form->labelEx($model,'cleaning_material_price',array('label'=>'Cleaning Material Price')); ?>
							<div>
							      $<?php echo $form->textField($model,'cleaning_material_price',array('value'=>$edit->cleaning_material_price ,'class'=>'integer')); ?>
	                              <?php echo $form->error($model,'cleaning_material_price'); ?>
	                              /
	                              <?php echo $form->textField($model,'cleaning_material_price_hr',array('value'=>$edit->cleaning_material_price_hr ,'class'=>'integer')); ?>
	                              <?php echo $form->error($model,'cleaning_material_price_hr'); ?>
	                              hour(s)
							</div>
						</section>
   						
					</fieldset>
					
						<section class="frmBtns">
                    		
            				<a href ="<?php echo Yii::app()->request->baseUrl; ?>/admin/priceadmin/pricelisting">
								<button class="btnCancel">Cancel</button>
							</a>
							<!--<button class="reset">Reset</button>-->
                            <button class="submit" style=" height: 38px;line-height:6px;text-transform:none;width:58px !important;">
							<?php echo CHtml::submitButton('Submit',array('class'=>'button reset')); ?>
							</button>
							<!--<button class="submit" name="submitbuttonname" value="submitbuttonvalue">Submit</button>-->
					
						</section>
						<!--
						<section>
							<div style="text-align:center;">
									<a href ="<?php echo Yii::app()->request->baseUrl; ?>/admin/priceadmin/pricelisting">
										<button class="btnCancel">Cancel</button>
									</a>
							
                                    <button class="submit" style=" height: 38px;line-height:6px;text-transform:none;width:58px !important;">
									<?php echo CHtml::submitButton('Submit',array('class'=>'button reset')); ?>
									</button>
									
							</div>
						</section>-->
					</fieldset>
				<?php $this->endWidget(); ?>
                

		</section> 
      
		
   </body>
