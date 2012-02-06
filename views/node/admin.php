<?php
$this->breadcrumbs=array(
	'Cck Nodes'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List CckNode', 'url'=>array('index')),
	array('label'=>'Create CckNode', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('cck-node-grid', {
		data: $(this).serialize()
	});
	return false;
});
");


?>

<h1>Manage Cck Nodes</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'cck-node-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
                    array(
                        'name' => 'title',
                        'header' => Yii::t('admin', 'title'),
                        'value' => 'CckNodeField::getListUrl($data->title, $data->id)',
                        'htmlOptions' => array('align' => 'left', 'style' => 'font-weight: normal;')
                    ),
                    'machine_name',
                    array(
                        'header' => Yii::t('admin', 'Form Fill'),
                        'value' => 'CckNodeField::getFullFormUrl("Fill ".$data->title, $data->machine_name)',
                        'htmlOptions' => array('align' => 'left', 'style' => 'font-weight: normal;')
                    ),
		
		array(
                    'header' => Yii::t('admin', 'Options'),
                    'class'=>'CButtonColumn',
		),
	),
)); ?>
