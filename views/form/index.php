<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'cck-node-form',
	'enableAjaxValidation'=>false,
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
                
            )
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
        <?php echo CHtml::activeHiddenField($model, "node_id") ?>
        <?php echo CHtml::activeHiddenField($model, "id") ?>
        
        <?php foreach($fielsInfos as $field):?>
            <div class="row">
                <?php
                    echo $form->labelEx($model, $field['field_name']);
                    $this->widget('cck.components.FormType'.ucfirst($field['type']), array("fieldInfo" => $field, "model" => $model));
                    echo $form->error($model, $field['field_name']);
                ?>
            </div>
        <?php endforeach;?>

       	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>
<?php $this->endWidget(); ?>

</div><!-- form -->