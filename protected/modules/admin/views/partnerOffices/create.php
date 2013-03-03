<?php
/* @var $this PartnerOfficesController */
/* @var $model PartnerOffices */

$this->breadcrumbs=array(
	'Partner Offices'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List PartnerOffices', 'url'=>array('index')),
	array('label'=>'Manage PartnerOffices', 'url'=>array('admin')),
);
?>

<h1>Create PartnerOffices</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>