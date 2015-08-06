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
			        'action'=> Yii::app()->createUrl('admin/post/editblog',array('id'=>$edit->id)),
					'id'=> $edit->id,
					'enableClientValidation'=>true,
					'clientOptions'=>array(
					'validateOnSubmit'=>true,

					),
				)); ?>
					<fieldset>
						<label>Edit CMS Page Here</label>
						<section><?php echo $form->labelEx($model,'title'); ?>
							<div>
							      <?php echo $form->textField($model,'title',array('value'=>$edit->title)); ?>
	                              <?php echo $form->error($model,'title'); ?>
	                        </div>
						</section>

						
						
						<section><?php echo $form->labelEx($model,'content'); ?>
							<div>

                                  <?php echo $form->TextArea($model,'content',array('class'=>"editor",'value'=>$edit->content)); ?>
	                              <?php echo $form->error($model,'content'); ?>

							</div>
						</section>
						
						<section><?php echo $form->labelEx($model,'tags'); ?>
							<div>
							      <?php $this->widget('CAutoComplete', array(
												'model'=>$edit,
												'attribute'=>'tags',
												'url'=>array('suggestTags'),
												'multiple'=>true,
												'htmlOptions'=>array('size'=>50),
											)); ?>
	                              <?php echo $form->error($model,'tags'); ?>
	                        </div>
						</section>
                        <section><?php echo $form->labelEx($model,'status'); ?>
							<div>

                                  <?php  
                                                	
                                         $val= $edit->status;         
                                         echo $form->dropDownList($model,'status',$type,array('options'=>array($val=>array('selected'=>true))));
                                                  
                                              
                                            //echo $form->dropDownList($model,'status',Lookup::items('PostStatus'));
                                            
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
