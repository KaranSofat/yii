<style type="text/css">
.rows {
    border-radius: 5px;
    float: left;
    overflow: hidden;
    width: 55.5%;
}
.info
{
	text-align: center;	
}
</style>

<script type="text/javascript">
  $(document).ready(function(){
       
        //$("#contact-form").validate();
      
  });

</script>

<div class="title" id="service">
  <div class="wrap">
    <h2>Contact Us</h2>
    
  </div>

  <div class="clear"> </div>
</div>
 <?php if(Yii::app()->user->hasFlash('success')):?>
    <div class="info">
        <?php echo Yii::app()->user->getFlash('success'); ?>
    </div>
<?php endif; ?>
<div class="white" id="service">
<div class="wrap">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'contact-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<!--<p class="note">Fields with <span class="required">*</span> are required.</p> -->

	<?php //echo $form->errorSummary($model); ?>
    <div class="cleaners">
	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name'); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>
  
	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email'); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>
    
	<div class="row">
		<?php echo $form->labelEx($model,'subject'); ?>
		<?php echo $form->textField($model,'subject'); ?>
		<?php echo $form->error($model,'subject'); ?>
	</div>
    
	<div class="row">
		<?php echo $form->labelEx($model,'body'); ?>
		<?php echo $form->textArea($model,'body'); ?>
		<?php echo $form->error($model,'body'); ?>
	</div>
    
	
    
	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit',array('class'=>'btn')); ?>
	</div>
	</div>

<?php $this->endWidget(); ?>
</div>
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d17319.01982643177!2d-2.0796604500000004!3d57.139156699999994!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x48840e2425e67ca5%3A0x8dee967933855eba!2sAberdeen+City+AB11%2C+UK!5e0!3m2!1sen!2sin!4v1419931697345" width="400" height="350" frameborder="0" style="border:0"></iframe>

  <div class="clear"> </div>
</div>
</div>
