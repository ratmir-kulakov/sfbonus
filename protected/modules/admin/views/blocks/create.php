<?php
/* @var $this BlocksController */
/* @var $model Blocks */

$this->breadcrumbs=array(
	'Blocks'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Blocks', 'url'=>array('index')),
	array('label'=>'Manage Blocks', 'url'=>array('admin')),
);
?>

<h1>Create Blocks</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>