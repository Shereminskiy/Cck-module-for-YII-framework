<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'cck-node-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'machine_name'); ?>
		<?php echo ($model->getIsNewRecord())? $form->textField($model,'machine_name',array('size'=>60,'maxlength'=>100)): $form->textField($model,'machine_name',array('size'=>60,'maxlength'=>100, "disabled" => 'disabled')); ?>
		<?php echo $form->error($model,'machine_name'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>
      

<?php $this->endWidget(); ?>

</div><!-- form -->