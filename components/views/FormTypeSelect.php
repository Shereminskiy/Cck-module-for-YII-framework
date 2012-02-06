<?php if(is_object($model)):?>

    <?php if(is_array($fieldInfo->values)): ?>

        <?php  echo CHtml::activeListBox($model, $fieldInfo->field_name, $fieldInfo->values ); ?>
    <?php else:?>

        <?php echo CHtml::activeListBox($model, $fieldInfo->field_name); ?>

    <?php endif;?>
    
<?php else:?>
    <?php if(is_array($fieldInfo->values)): ?>

        <?php CHtml::listBox($fieldInfo->field_name, $fieldInfo->default_values, $fieldInfo->values) ?>

    <?php else:?>

        <?php echo CHtml::listBox($fieldInfo->field_name); ?>

    <?php endif;?>
    
<?php endif;?>