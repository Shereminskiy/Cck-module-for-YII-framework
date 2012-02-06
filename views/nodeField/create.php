<?php
$this->breadcrumbs=array(
	'Cck Node Fields'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CckNodeField', 'url'=>array('index')),
	array('label'=>'Manage CckNodeField', 'url'=>array('admin')),
);

 
?>

<h1>Create CckNodeField</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>