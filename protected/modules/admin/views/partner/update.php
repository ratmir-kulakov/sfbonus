<?php
/* @var $this PartnerController */
/* @var $model Partner */

$this->pageName = 'Редактирование';

$this->pageTitle = $this->pageName . ' :: Партнеры :: ' . Yii::app()->name;

$this->breadcrumbs = array(
    'Партнеры'=>'/admin/partner',
    'Редактирование',
);


$this->backLink = '/admin/partner';
$this->controlButtons[] = array(
    'icon' => 'icon icon-plus-sign icon-white',
    'label' => 'Добавить',
    'type' => 'success',
    'url' => '/admin/partner/create',
);

$this->controlButtons[] = array(
    'buttonType'=>'submit',
    'icon' => 'ok white',
    'label' => 'Сохранить',
    'type' => 'primary',
    'htmlOptions'=>array(
        'name'=>'savePartner',
    ),
);

$this->controlButtons[] = array(
    'buttonType'=>'submit',
    'icon' => 'check',
    'label' => 'Сохранить и выйти',
    'htmlOptions'=>array(
        'name'=>'savePartnerExit',
    ),
);
$this->controlButtons[] = array(
    'buttonType'=>'submit',
    'icon' => 'trash white',
    'label' => 'Удалить',
    'type' => 'danger',
    'htmlOptions'=>array(
        'submit' => array('partner/delete', 'id'=>$model->id),
        'confirm' => 'Вы уверены, что хотите удалить данную страницу?'
    ),
);

$this->menu=array(
	array(
        'label'=>'Основное',
        'icon'=>'chevron-right',
        'url'=>array('', 'id'=>$model->id,'#'=>'main'), 
    ),
	array(
        'label'=>'Адреса и время работы',
        'icon'=>'chevron-right',
        'url'=>array('', 'id'=>$model->id,'#'=>'address'), 
    ),
	array(
        'label'=>'Настройка', 
        'icon'=>'chevron-right',
        'url'=>array('', 'id'=>$model->id,'#'=>'settings'), 
    ),
	array(
        'label'=>'SEO', 
        'icon'=>'chevron-right',
        'url'=>array('', 'id'=>$model->id,'#'=>'seo'), 
    ),
);

$form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'partner-form',
    'enableAjaxValidation'=>false,
    'htmlOptions'=>array('class'=>'partner-form','enctype'=>'multipart/form-data'),
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
            'id'=>'local-nav',
            'itemTemplate'=>'{menu}',
            'items'=>$this->menu,
            'htmlOptions'=>array('class'=>'left-sidenav'),
        ));
    ?>
</div>
<div class="center-sidebar-wrapper">
    <div class="center-sidebar">
    <?php echo $this->renderPartial('_form', array('model'=>$model, 'form'=>$form)); ?>
    </div>
</div>
<?php $this->endWidget(); ?>