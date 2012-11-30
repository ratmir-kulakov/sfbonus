<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Пользователи'=>array('admin'),
	$model->id,
);

$this->menu=array(
    /*
	array(
        'label'=>'Список', 
        'url'=>array('index'), 
        'visible' => Yii::app()->user->checkAccess('administrator')
    ),
     */
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
	array(
        'label'=>'Редактировать', 
        'url'=>array('update', 'id'=>$model->id), 
        'visible' => Yii::app()->user->checkAccess('administrator')
    ),
	array(
        'label'=>'Удалить', 
        'url'=>'#', 
        'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Вы уверены, что хотите удалить пользователя?'), 
        'visible' => Yii::app()->user->checkAccess('administrator')
    ),
);
?>

<h1>Информация о пользователе</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		array(
            'name' => 'type',
            'type' => 'raw',
            'value' => $model->getTypeName($model->type),
        ),
		'last_name',
		'first_name',
		'middle_name',
		array(
            'name' => 'status',
            'type' => 'raw',
            'value' => $model->getStatusName($model->status),
        ),
	),
)); ?>
