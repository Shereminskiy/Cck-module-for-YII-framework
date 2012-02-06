<?php
    $this->breadcrumbs = array(
            CckModule::t("CCK Field"),
            CckModule::t('Create/Edit'),
    );

//    /echo $this->renderPartial('_formNode', array('model'=>$formNode));
?>
<div class="form">

<?php echo CHtml::beginForm(); ?>

	<p class="note"><?php echo CckModule::t('Fields with <span class="required">*</span> are required.'); ?></p>
        <?php  //echo CHtml::activeHiddenField($formNodeField, "node_id", $node_id); ?>
        <?php echo CHtml::activeHiddenField($formNodeField, "node_id") ?>

        
	<?php echo CHtml::errorSummary($formNodeField);  ?>
	<div class="row varname">
		<?php echo CHtml::activeLabelEx($formNodeField,'field_label'); ?>
		<?php echo (($formNodeField->id)? CHtml::activeTextField($formNodeField,'field_label',array('size'=>25,'maxlength'=>100,'readonly'=>true)) : CHtml::activeTextField($formNodeField,'field_label',array('size'=>35,'maxlength'=>100))); ?>
		<?php echo CHtml::error($formNodeField,'field_label'); ?>
		<p class="hint"><?php echo CckModule::t("Allowed lowercase letters and digits."); ?></p>
	</div>
	<div class="row varname">
		<?php echo CHtml::activeLabelEx($formNodeField,'field_name'); ?>
		<?php echo (($formNodeField->id)? CHtml::activeTextField($formNodeField,'field_name',array('size'=>25,'maxlength'=>100,'readonly'=>true)) : CHtml::activeTextField($formNodeField,'field_name',array('size'=>35,'maxlength'=>100))); ?>
		<?php echo CHtml::error($formNodeField,'field_name'); ?>
		<p class="hint"><?php echo CckModule::t("Allowed lowercase letters and digits."); ?></p>
	</div>
	<div class="row varname">
		<?php echo CHtml::activeLabelEx($formNodeField,'default_values'); ?>
		<?php echo (($formNodeField->id)? CHtml::activeTextField($formNodeField,'default_values',array('size'=>25,'readonly'=>true)) : CHtml::activeTextField($formNodeField,'default_values',array('size'=>35,))); ?>
		<?php echo CHtml::error($formNodeField,'default_values'); ?>
		<p class="hint"><?php echo CckModule::t("The default value of the field identified by its key. For multiple selects use commas to separate multiple defaults."); ?></p>
	</div>
	<div class="row varname">
		<?php echo CHtml::activeLabelEx($formNodeField,'values'); ?>
		<?php echo (($formNodeField->id)? CHtml::activeTextArea($formNodeField,'values',array('rows' => 8, 'cols' => 25, 'readonly'=>true)) : CHtml::activeTextArea($formNodeField,'values',array('rows' => 8, 'cols' => 45))); ?>
		<?php echo CHtml::error($formNodeField,'values'); ?>
		<p class="hint"><?php echo CckModule::t("Key-value pairs MUST be specified as \"safe_key|Some readable option\". Use of only alphanumeric characters and underscores is recommended in keys. One option per line. Option groups may be specified with <Group Name>. <> can be used to insert items at the root of the menu after specifying a group."); ?></p>
	</div>
	<div class="row varname">
		<?php echo CHtml::activeLabelEx($formNodeField,'html_option'); ?>
		<?php echo (($formNodeField->id)? CHtml::activeTextArea($formNodeField,'html_option',array('rows' => 8, 'cols' => 25, 'readonly'=>true)) : CHtml::activeTextArea($formNodeField,'html_option',array('rows' => 8, 'cols' => 45))); ?>
		<?php echo CHtml::error($formNodeField,'html_option'); ?>
		<p class="hint"><?php echo CckModule::t("Key-value pairs MUST be specified as \"safe_key|Some readable option\". Use of only alphanumeric characters and underscores is recommended in keys. One option per line. Option groups may be specified with <Group Name>. <> can be used to insert items at the root of the menu after specifying a group."); ?></p>
	</div>
	<div class="row varname">
		<?php echo CHtml::activeLabelEx($formNodeField,'requred'); ?>
		<?php echo (($formNodeField->id)? CHtml::activeCheckBox($formNodeField,'requred',array('readonly'=>true)) : CHtml::activeCheckBox($formNodeField,'requred',array())); ?>
		<?php echo CHtml::error($formNodeField,'requred'); ?>
		<p class="hint"><?php echo CckModule::t("There must be array."); ?></p>
	</div>
        <div class="row buttons">
            <?php echo CHtml::submitButton($formNodeField->isNewRecord ? CckModule::t('Create') : CckModule::t('Save')); ?>
	</div>

<?php echo CHtml::endForm(); ?>

</div><!-- form -->
