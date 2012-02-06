<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'cck-node-field-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
        <?php echo CHtml::activeHiddenField($model, "node_id") ?>
        <?php echo CHtml::activeHiddenField($model, "type") ?>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->checkBox($model, 'status'); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'field_label'); ?>
		<?php echo $form->textField($model,'field_label',array('size'=>39,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'field_label'); ?>
	</div>


    <?php if(isset($model->extra["display_machine_name_field"]) && $model->extra["display_machine_name_field"] == true):?>
        <div class="row">
                <?php echo $form->labelEx($model,'field_name'); ?>
                <?php echo ($model->getIsNewRecord())? $form->textField($model,'field_name',array('size'=>39,'maxlength'=>100)): $form->textField($model,'field_name',array('size'=>39,'maxlength'=>100, "disabled" => 'disabled')); ?>
                <?php echo $form->error($model,'field_name'); ?>
        </div>
    <?php endif;?>

    <?php if(isset($model->extra["display_default_field"]) && $model->extra["display_default_field"] == true):?>

	<div class="row">
		<?php echo $form->labelEx($model,'default_values'); ?>
		<?php echo $form->textArea($model,'default_values',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->labelEx($model,'is_php_def_value'); ?>
		<?php echo $form->checkBox($model,'is_php_def_value'); ?>
		<?php echo $form->error($model,'default_values'); ?>
	</div>
    <?php endif;?>
	<div class="row">
		<?php echo $form->labelEx($model,'requred'); ?>
		<?php echo $form->checkBox($model,'requred'); ?>
		<?php echo $form->error($model,'requred'); ?>
	</div>
        

        
	<div class="row">
		<?php echo $form->labelEx($model,'values'); ?>
		<?php echo $form->textArea($model,'values',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->labelEx($model,'is_php_value'); ?>
		<?php echo $form->checkBox($model,'is_php_value'); ?>
                <?php echo $form->error($model,'values'); ?>

	</div>

        <?php
            if(isset($model->extra["attributes"]) && is_array($model->extra["attributes"])) {
                foreach( $model->extra["attributes"] as $key => $attributes) {
                    $this->widget('cck.components.Attribute'.ucfirst($key), array("attributes" => $attributes["widgetParams"], "model" => $model, "form" => $form));
                }
            }
        ?>
        
        <?php if(isset($model->extra["display_weight_field"]) && $model->extra["display_weight_field"] == true):?>
	<div class="row">
		<?php echo $form->labelEx($model,'weight'); ?>
		<?php echo $form->textField($model,'weight'); ?>
		<?php echo $form->error($model,'weight'); ?>
	</div>
        <?php endif;?>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->