<?php
/* @var $this BlocksController */
/* @var $model Blocks */

$this->pageName = 'Редактирование блока';

$this->pageTitle = $this->pageName . ' :: Блоки :: ' . Yii::app()->config->get('SITE.TITLE');
$this->breadcrumbs = array(
    'Блоки'=> array('/admin/blocks'),
    'Редактирование блока',
);
$this->backLink = Yii::app()->urlManager->createUrl('/admin/blocks');

$this->controlButtons[] = array(
    'buttonType'=>'submit',
    'icon' => 'ok white',
    'label' => 'Сохранить',
    'type' => 'primary',
    'htmlOptions'=>array(
        'name'=>'saveBlocks',
    ),
);
$this->controlButtons[] = array(
    'buttonType'=>'submit',
    'icon' => 'check',
    'label' => 'Сохранить и выйти',
    'htmlOptions'=>array(
        'name'=>'saveBlocksExit',
    ),
);

$form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'blocks-form',
    'enableAjaxValidation'=>false,
    'htmlOptions'=>array('class'=>'blocks-form'),
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
<div class="center-sidebar">
<?php echo $this->renderPartial('_form', array('model'=>$model, 'form'=>$form)); ?>
</div>
<?php $this->endWidget(); ?>
