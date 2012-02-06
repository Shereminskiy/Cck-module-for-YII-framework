<?php
    $this->breadcrumbs = array(
            CckModule::t("CCK Node") => array('admin'),
            CckModule::t('Create'),
    );

//    /echo $this->renderPartial('_formNode', array('model'=>$formNode));
?>
<div class="form">

<?php echo CHtml::beginForm(); ?>

	<p class="note"><?php echo CckModule::t('Fields with <span class="required">*</span> are required.'); ?></p>

	<?php echo CHtml::errorSummary($formNode);  ?>
	<div class="row varname">
		<?php echo CHtml::activeLabelEx($formNode,'title'); ?>
		<?php echo (($formNode->id)? CHtml::activeTextField($formNode,'title',array('size'=>25,'maxlength'=>255,'readonly'=>true)) : CHtml::activeTextField($formNode,'title',array('size'=>25,'maxlength'=>255))); ?>
		<?php echo CHtml::error($formNode,'title'); ?>
		<p class="hint"><?php echo CckModule::t("Allowed lowercase letters and digits."); ?></p>
	</div>
	<div class="row varname">
		<?php echo CHtml::activeLabelEx($formNode,'machine_name'); ?>
		<?php echo (($formNode->id)? CHtml::activeTextField($formNode,'machine_name',array('size'=>25,'maxlength'=>249,'readonly'=>true)) : CHtml::activeTextField($formNode,'machine_name',array('size'=>25,'maxlength'=>249))); ?>
		<?php echo CHtml::error($formNode,'machine_name'); ?>
            <p class="hint"><?php echo CckModule::t("System automaticaly will add prefix '".CckNode::model()->getFormPrefix().". Allowed lowercase letters and digits."); ?></p>
	</div>

        <div class="row buttons">
            <?php echo CHtml::submitButton($formNode->isNewRecord ? CckModule::t('Create') : CckModule::t('Save')); ?>
	</div>

<?php echo CHtml::endForm(); ?>

</div><!-- form -->