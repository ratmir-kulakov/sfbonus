<?php /* @var $this Controller */ ?>
<?php $this->beginContent('/layouts/main'); ?>
    <div id="b" class="container-fluid">
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
            <ul id="local-nav" class="nav nav-list left-sidenav">
                <li><a href="#main"><i class="icon-chevron-right"></i> Основное</a></li>
                <li><a href="#photo"><i class="icon-chevron-right"></i> Фотографии</a></li>
                <li><a href="#files"><i class="icon-chevron-right"></i> Прикрепленные файлы</a></li>
                <li><a href="#seo"><i class="icon-chevron-right"></i> SEO атрибутика</a></li>
                <li><a href="#settings"><i class="icon-chevron-right"></i> Настройка</a></li>
            </ul>
        </div>
        <div class="center-sidebar-wrapper">
            <div class="center-sidebar">
                <?php echo $content; ?>
            </div>
        </div>
    </div>
<?php $this->endContent(); ?>