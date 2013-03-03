<?php
/* @var $this PartnerOfficesController */
/* @var $model PartnerOffices */

$this->breadcrumbs=array(
	'Partner Offices'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List PartnerOffices', 'url'=>array('index')),
	array('label'=>'Create PartnerOffices', 'url'=>array('create')),
	array('label'=>'Update PartnerOffices', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete PartnerOffices', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage PartnerOffices', 'url'=>array('admin')),
);
?>

<h1>View PartnerOffices #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'partner_id',
		'address',
		'phone',
		'schedule',
		'ymaps_id',
		'ymaps_type',
		'cgeopoint_x',
		'cgeopoint_y',
		'geopoint_x',
		'geopoint_y',
		'status',
	),
)); ?>
