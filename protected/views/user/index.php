<?php
/* @var $this UserController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Пользователи',
);

$this->menu=array(
	array(
        'label'=>'Список пользователей', 
        'url'=>array('admin'), 
        'visible' => Yii::app()->user->checkAccess('administrator')
    ),
	array(
        'label'=>'Создать нового пользователя', 
        'url'=>array('create'), 
        'visible' => Yii::app()->user->checkAccess('administrator')
    ),
);
?>

<h1>Пользователи</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
