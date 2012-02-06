<?php
$this->breadcrumbs=array(
	'Cck Nodes',
);

$this->menu=array(
	array('label'=>'Create CckNode', 'url'=>array('create')),
	array('label'=>'Manage CckNode', 'url'=>array('admin')),
);
?>

<h1>Cck Nodes</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
