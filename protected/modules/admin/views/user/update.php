<?php
/* @var $this UserController */
/* @var $model User */
/*
$this->breadcrumbs=array(
	'Пользователи'=>array('admin'),
	$model->id=>array('view','id'=>$model->id),
	'Редактирование',
);
*/
?>

<div id="page-info" class="page-info">
    <h1>Пользователи</h1>
    <?php
    $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
        'links'=>array(
            'Пользователи'=>'/admin/user',
            'Редактирование',
        ),
    ));
    ?>
    <div id="controls-btn" class="controls-btn">
        <strong class="title" title="Пользователи">Пользователи</strong>
        <a class="back" href="/admin/"><span class="arrow">←</span> Вернуться</a>
        <a class="btn btn-success" href="/admin/user/create"><i class="icon icon-plus-sign icon-white"></i>Добавить</a>
        <a class="btn btn-danger" href="#"><i class="icon icon-trash icon-white"></i>Удалить</a>
    </div>
    <div class="clear-right"></div>
</div>

<?php //echo $this->renderPartial('_form', array('model'=>$model)); ?>