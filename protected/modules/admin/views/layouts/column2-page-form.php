<?php /* @var $this Controller */ ?>
<?php $this->beginContent('/layouts/main'); ?>
    <div id="b" class="container-fluid">
        <?php
        $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
            'id'=>'user-form',
            'enableAjaxValidation'=>false,
            'htmlOptions'=>array('class'=>'user-form')
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
                <?php echo $content; ?>
            </div>
        </div>
        <?php $this->endWidget(); ?>
    </div>
<?php $this->endContent(); ?>