<?php
/* @var $this UserController */
/* @var $model User */

$this->pageName = 'Создание пользователя';

$this->pageTitle = $this->pageName . ' :: Пользователи :: ' . Yii::app()->name;

$this->breadcrumbs = array(
    'Пользователи'=>'/admin/user',
    'Создание пользователя',
);

$this->backLink = '/admin/user';

$this->controlButtons = array(
    array(
        'icon' => 'ok white',
        'label' => 'Сохранить',
        'type' => 'primary',
        'url' => '/admin/user',
    ),
    array(
        'icon' => 'check',
        'label' => 'Сохранить и выйти',
        'url' => '/admin/user',
    ),
    array(
        'icon' => 'trash white',
        'label' => 'Удалить',
        'type' => 'danger',
        'url' => '/admin/user/delete/id/'.$model->id,
    ),
);

$this->menu=array(
	array(
        'label'=>'Основное',
        'icon'=>'chevron-right',
        'url'=>array('','id'=>$model->id,'#'=>'main'), 
    ),
	array(
        'label'=>'Настройка', 
        'icon'=>'chevron-right',
        'url'=>array('','id'=>$model->id, '#'=>'settings'), 
    ),
	array(
        'label'=>'ФИО', 
        'icon'=>'chevron-right',
        'url'=>array('','id'=>$model->id, '#'=>'fio'), 
    ),
);
?>


<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>