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
                <a class="back" href="/admin/"><span class="arrow">←</span> Вернуться</a>
                <a class="btn btn-success" href="/admin/user/create"><i class="icon icon-plus-sign icon-white"></i>Добавить</a>
                <a class="btn btn-danger" href="#"><i class="icon icon-trash icon-white"></i>Удалить</a>
            </div>
            <div class="clear-right"></div>
        </div>
        <?php echo $content; ?>
    </div>
<?php $this->endContent(); ?>