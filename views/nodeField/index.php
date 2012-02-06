<?php
$this->breadcrumbs=array(
	'Cck Node Fields',
);

$this->menu=array(
	array('label'=>'Create CckNodeField', 'url'=>array('nodeField/create/node_id/'.$node_id)),
	array('label'=>'Manage CckNodeField', 'url'=>array('admin')),
);
?>

<h1>Cck Node Fields</h1>
<?php
        

?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'cck-node-field-grid',
	'dataProvider' => $dataProvider,
	//'filter'=>$model,
	'columns'=>array(
		'id',
		'type',
		'status',
		'field_label',
		'field_name',
		/*
		'extra',
		'default_values',
		'requred',
		'values',
		'weight',
		'is_php_value',
		'is_php_def_value',
		*/
		array(
                        "header" => "Options",
			'class'=>'CButtonColumn',
		),
	),
)); ?>