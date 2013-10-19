<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Пользователи'=>array('admin'),
	$model->id=>array('view','id'=>$model->id),
	'Редактирование',
);

$this->menu=array(
    /*
	array(
        'label'=>'Список пользователей',
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
        'label'=>'Просмотр', 
        'url'=>array('view', 'id'=>$model->id), 
        'visible' => Yii::app()->user->checkAccess('administrator')
    ),
);
?>

<h1>Редактирование</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>