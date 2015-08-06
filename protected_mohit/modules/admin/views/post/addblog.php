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
			        'action'=> Yii::app()->createUrl('admin/post/addblog'),
					'id'=>'blog',
					//'htmlOptions'=>array('enctype'=>'multipart/form-data'),
					'enableClientValidation'=>true,
					'clientOptions'=>array(
					'validateOnSubmit'=>true,

					),
				)); ?>
					<fieldset>
						<label>Add Blog Here</label>
						<section> <?php echo $form->labelEx($model,'title'); ?>
							<div>
							     <?php echo $form->textField($model,'title',array('size'=>80,'maxlength'=>128)); ?>
		                          <?php echo $form->error($model,'title'); ?>

	                        </div>
						</section>

						
						
						<section><?php echo $form->labelEx($model,'content'); ?>
							<div>

                                  <?php echo $form->TextArea($model,'content',array('class'=>"editor")); ?>
	                              <?php echo $form->error($model,'content'); ?>

							</div>
						</section>
						<section><?php echo $form->labelEx($model,'tags'); ?>
							<div>

                                  <?php $this->widget('CAutoComplete', array(
											'model'=>$model,
											'attribute'=>'tags',
											'url'=>array('suggestTags'),
											'multiple'=>true,
											'htmlOptions'=>array('size'=>50),
										)); ?>
	                              <?php echo $form->error($model,'tags'); ?>
                                <p class="hint">Please separate different tags with commas.</p>
							</div>
						</section>

						<section><?php echo $form->labelEx($model,'status'); ?>
							<div>

                                  <?php  
                                             
                                            echo $form->dropDownList($model,'status',$type);
                                            
                                   ?>
	                              <?php echo $form->error($model,'status'); ?>

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
