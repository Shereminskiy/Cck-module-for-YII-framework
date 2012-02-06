<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('type')); ?>:</b>
	<?php echo CHtml::encode($data->type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('field_label')); ?>:</b>
	<?php echo CHtml::encode($data->field_label); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('field_name')); ?>:</b>
	<?php echo CHtml::encode($data->field_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('extra')); ?>:</b>
	<?php echo CHtml::encode($data->extra); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('default_values')); ?>:</b>
	<?php echo CHtml::encode($data->default_values); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('requred')); ?>:</b>
	<?php echo CHtml::encode($data->requred); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('values')); ?>:</b>
	<?php echo CHtml::encode($data->values); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('weight')); ?>:</b>
	<?php echo CHtml::encode($data->weight); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_php_value')); ?>:</b>
	<?php echo CHtml::encode($data->is_php_value); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_php_def_value')); ?>:</b>
	<?php echo CHtml::encode($data->is_php_def_value); ?>
	<br />

	*/ ?>

</div>