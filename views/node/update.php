<?php
$this->breadcrumbs=array(
	'Cck Nodes'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List CckNode', 'url'=>array('index')),
	array('label'=>'Create CckNode', 'url'=>array('create')),
	array('label'=>'View CckNode', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage CckNode', 'url'=>array('admin')),
);
?>

<h1>Update CckNode <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>