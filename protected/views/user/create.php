<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Пользователи'=>array('admin'),
	'Создание пользователя',
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
);
?>

<h1>Создание нового пользователя</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>