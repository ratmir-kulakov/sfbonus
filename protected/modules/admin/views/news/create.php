<?php
/* @var $this NewsController */
/* @var $model News */

$this->pageName = 'Создание новости';

$this->pageTitle = $this->pageName . ' :: Новости :: ' . Yii::app()->config->get('SITE.TITLE');

$this->breadcrumbs = array(
    'Новости'=>array('/admin/news'),
    'Создание новости',
);

$this->backLink = Yii::app()->urlManager->createUrl('/admin/news');

$this->controlButtons[] = array(
    'buttonType'=>'submit',
    'icon' => 'ok white',
    'label' => 'Сохранить',
    'type' => 'primary',
    'htmlOptions'=>array(
        'name'=>'saveNews',
    ),
);
$this->controlButtons[] = array(
    'buttonType'=>'submit',
    'icon' => 'check',
    'label' => 'Сохранить и выйти',
    'htmlOptions'=>array(
        'name'=>'saveNewsExit',
    ),
);

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
    'id'=>'news-form',
    'enableAjaxValidation'=>false,
    'htmlOptions'=>array('class'=>'news-form'),
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
            'id'=>'local-nav',
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