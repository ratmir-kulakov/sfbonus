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
        'icon' => 'icon icon-plus-sign icon-white',
        'label' => 'Добавить',
        'type' => 'success',
        'url' => '/admin/user/create',
    ),
    array(
        'buttonType'=>'submit',
        'icon' => 'ok white',
        'label' => 'Сохранить',
        'type' => 'primary',
        'htmlOptions'=>array(
            'name'=>'saveUser',
        ),
    ),
    array(
        'buttonType'=>'submit',
        'icon' => 'check',
        'label' => 'Сохранить и выйти',
        'htmlOptions'=>array(
            'name'=>'saveUserExit',
        ),
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
        'label'=>'Логин и пароль',
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

$form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'user-form',
    'enableAjaxValidation'=>false,
    'htmlOptions'=>array('class'=>'user-form'),
    'inlineErrors'=>true,
)); 
?>

<div id="page-info" class="page-info">
    <h1><?php echo $this->pageName;?></h1>
    <?php
    $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
        'links'=>$this->breadcrumbs,
    ));
    ?>
    <div id="controls-btn" class="controls-btn">
        <strong class="title" title="<?php echo $this->pageName;?>"><?php echo $this->pageName;?></strong>
        <a class="back" href="<?php echo $this->backLink;?>"><span class="arrow">←</span> Вернуться</a>
        <?php 
        if(count($this->controlButtons)):
            foreach($this->controlButtons as $button):
                $this->widget('bootstrap.widgets.TbButton',$button);
            endforeach;
        endif;?>
    </div>
    <div class="clear-right"></div>
</div>
<div class="left-sidebar">
    <?php
        $this->widget('bootstrap.widgets.TbMenu', array(
            'type'=>'list',
            'itemTemplate'=>'{menu}',
            'items'=>$this->menu,
            'htmlOptions'=>array('class'=>'left-sidenav', 'id'=>'local-nav'),
        ));
    ?>
</div>
<div class="center-sidebar-wrapper">
    <div class="center-sidebar">
    <?php echo $this->renderPartial('_form', array('model'=>$model, 'form'=>$form)); ?>
    </div>
</div>

<?php $this->endWidget(); ?>