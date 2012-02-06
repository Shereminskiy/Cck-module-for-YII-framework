<?php
$this->breadcrumbs=array(
	'Cck Node Fields'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List CckNodeField', 'url'=>array('index')),
	array('label'=>'Create CckNodeField', 'url'=>array('create')),
	array('label'=>'View CckNodeField', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage CckNodeField', 'url'=>array('admin')),
);
?>

<h1>Update CckNodeField <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>