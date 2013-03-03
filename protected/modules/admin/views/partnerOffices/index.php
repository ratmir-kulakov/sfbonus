<?php
/* @var $this PartnerOfficesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Partner Offices',
);

$this->menu=array(
	array('label'=>'Create PartnerOffices', 'url'=>array('create')),
	array('label'=>'Manage PartnerOffices', 'url'=>array('admin')),
);
?>

<h1>Partner Offices</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
