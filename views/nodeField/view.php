<?php
$this->breadcrumbs=array(
	'Cck Node Fields'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List CckNodeField', 'url'=>array('index')),
	array('label'=>'Create CckNodeField', 'url'=>array('create')),
	array('label'=>'Update CckNodeField', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete CckNodeField', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CckNodeField', 'url'=>array('admin')),
);
?>

<h1>View CckNodeField #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'node_id',
		'type',
		'status',
		'field_label',
		'field_name',
		//'extra',
		'default_values',
		'requred',
		'values',
		'weight',
		'is_php_value',
		'is_php_def_value',
	),
)); ?>
