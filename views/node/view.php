<?php
$this->breadcrumbs=array(
	'Cck Nodes'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List CckNode', 'url'=>array('index')),
	array('label'=>'Create CckNode', 'url'=>array('create')),
	array('label'=>'Update CckNode', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete CckNode', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CckNode', 'url'=>array('admin')),
);
?>

<h1>View CckNode #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'machine_name',
	),
)); ?>
