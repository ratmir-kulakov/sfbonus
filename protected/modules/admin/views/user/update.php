<?php
/* @var $this UserController */
/* @var $model User */

$this->pageName = 'Редактирование';

$this->pageTitle = $this->pageName . ' :: Пользователи :: ' . Yii::app()->name;

$this->breadcrumbs = array(
    'Пользователи'=>'/admin/user',
    'Редактирование',
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
?>


<?php //echo $this->renderPartial('_form', array('model'=>$model)); ?>