<?php
/* @var $this PartnerOfficesController */
/* @var $model PartnerOffices */

$this->pageName = 'Редактирование адреса';

$this->pageTitle = $this->pageName . ' :: Партнеры :: ' . Yii::app()->name;

$this->breadcrumbs = array(
    'Партнеры'=>Yii::app()->createUrl('/admin/partner/update', array('id'=>$model->partner_id)),
    'Редактирование адреса',
);


$this->backLink = Yii::app()->createUrl('/admin/partner/update', array('id'=>$model->partner_id));
$this->controlButtons[] = array(
    'icon' => 'icon icon-plus-sign icon-white',
    'label' => 'Добавить',
    'type' => 'success',
    'url' => array('/admin/partnerOffices/create', 'pid'=>$model->partner_id),
);


$this->controlButtons[] = array(
    'buttonType'=>'submit',
    'icon' => 'ok white',
    'label' => 'Сохранить',
    'type' => 'primary',
    'htmlOptions'=>array(
        'name'=>'savePartnerOffices',
        'onclick' => 'if($(window.getSelection().focusNode).hasClass("ymaps-b-form-input__box")) {return false;} else {return true;}',
    ),
);

$this->controlButtons[] = array(
    'buttonType'=>'submit',
    'icon' => 'check',
    'label' => 'Сохранить и выйти',
    'htmlOptions'=>array(
        'name'=>'savePartnerOfficesExit',
        'onclick' => 'if($(window.getSelection().focusNode).hasClass("ymaps-b-form-input__box")) {return false;} else {return true;}',
    ),
);
$this->controlButtons[] = array(
    'buttonType'=>'submit',
    'icon' => 'trash white',
    'label' => 'Удалить',
    'type' => 'danger',
    'htmlOptions'=>array(
        'submit' => array('PartnerOffices/delete', 'id'=>$model->id),
        'confirm' => 'Вы уверены, что хотите удалить данную страницу?'
    ),
);

$form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'partner-form',
    'enableAjaxValidation'=>false,
    'htmlOptions'=>array('class'=>'partner-form'),
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
<div class="center-sidebar">
<?php echo $this->renderPartial('_form', array('model'=>$model, 'form'=>$form, 'ymapModel' => $ymapModel)); ?>
</div>
<?php $this->endWidget(); ?>