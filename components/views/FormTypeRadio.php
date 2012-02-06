<?php if(is_object($model)):?>
    <?php if(is_array($fieldInfo->values)): ?>

        <?php  echo CHtml::activeRadioButtonList($model, $fieldInfo->field_name, $fieldInfo->values, $fieldInfo->extra["htmlOptions"]); ?>
    <?php else:?>

        <?php echo CHtml::activeRadioButtonList($model, $fieldInfo->field_name, $fieldInfo->extra["htmlOptions"]); ?>

    <?php endif;?>

    
<?php else:?>
    <?php if(is_array($fieldInfo->values)): ?>

        <?php CHtml::radioButtonList($fieldInfo->field_name, $fieldInfo->default_values, $fieldInfo->values, $fieldInfo->extra["htmlOptions"]) ?>

    <?php else:?>

        <?php echo CHtml::radioButtonList($fieldInfo->field_name, $fieldInfo->extra["htmlOptions"]); ?>

    <?php endif;?>
    
<?php endif;?>