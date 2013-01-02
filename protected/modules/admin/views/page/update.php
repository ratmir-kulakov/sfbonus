<?php
/* @var $this UserController */
/* @var $model User */

$this->pageName = 'Редактирование';

$this->pageTitle = $this->pageName . ' :: Пользователи :: ' . Yii::app()->name;

$this->breadcrumbs = array(
    'Пользователи'=>'/admin/page',
    'Редактирование',
);


if(Yii::app()->user->checkAccess('administrator'))
{
    $this->backLink = '/admin/page';
    $this->controlButtons[] = array(
        'icon' => 'icon icon-plus-sign icon-white',
        'label' => 'Добавить',
        'type' => 'success',
        'url' => '/admin/page/create',
    );
}

$this->controlButtons[] = array(
    'buttonType'=>'submit',
    'icon' => 'ok white',
    'label' => 'Сохранить',
    'type' => 'primary',
    'htmlOptions'=>array(
        'name'=>'saveUser',
    ),
);

if(Yii::app()->user->checkAccess('administrator'))
{
    $this->controlButtons[] = array(
        'buttonType'=>'submit',
        'icon' => 'check',
        'label' => 'Сохранить и выйти',
        'htmlOptions'=>array(
            'name'=>'saveUserExit',
        ),
    );
    $this->controlButtons[] = array(
        'buttonType'=>'submit',
        'icon' => 'trash white',
        'label' => 'Удалить',
        'type' => 'danger',
        'htmlOptions'=>array(
            'submit' => array('page/delete', 'id'=>$model->id),
            'confirm' => 'Вы уверены, что хотите удалить данного пользователя?'
        ),
    );
}

$this->menu=array(
	array(
        'label'=>'Основное',
        'icon'=>'chevron-right',
        'url'=>array('','#'=>'main'), 
    ),
	array(
        'label'=>'Настройка', 
        'icon'=>'chevron-right',
        'url'=>array('','#'=>'settings'), 
    ),
	array(
        'label'=>'SEO', 
        'icon'=>'chevron-right',
        'url'=>array('','#'=>'seo'), 
    ),
);

$form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'page-form',
    'enableAjaxValidation'=>false,
    'htmlOptions'=>array('class'=>'page-form'),
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
        <?php if(!empty($this->backLink)):?>
        <a class="back" href="<?php echo $this->backLink;?>"><span class="arrow">←</span> Вернуться</a>
        <?php endif;?>
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