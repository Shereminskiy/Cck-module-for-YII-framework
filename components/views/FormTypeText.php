<?php if(is_object($model)):?>

        <?php echo CHtml::activeTextField($model, $fieldInfo->field_name, $fieldInfo->extra["htmlOptions"]); ?>

<?php else:?>


<?php endif;?>