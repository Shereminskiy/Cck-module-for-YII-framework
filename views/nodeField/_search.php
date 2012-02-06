<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'node_id'); ?>
		<?php echo $form->textField($model,'node_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'type'); ?>
		<?php echo $form->textField($model,'type',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'status'); ?>
		<?php echo $form->textField($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'field_label'); ?>
		<?php echo $form->textField($model,'field_label',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'field_name'); ?>
		<?php echo $form->textField($model,'field_name',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'extra'); ?>
		<?php echo $form->textArea($model,'extra',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'default_values'); ?>
		<?php echo $form->textArea($model,'default_values',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'requred'); ?>
		<?php echo $form->textField($model,'requred'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'values'); ?>
		<?php echo $form->textArea($model,'values',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'weight'); ?>
		<?php echo $form->textField($model,'weight'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'is_php_value'); ?>
		<?php echo $form->textField($model,'is_php_value'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'is_php_def_value'); ?>
		<?php echo $form->textField($model,'is_php_def_value'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->