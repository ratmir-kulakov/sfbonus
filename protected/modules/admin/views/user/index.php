<?php
/* @var $this UserController */
/* @var $model User */

?>

<div id="page-info" class="page-info">
    <h1>Пользователи</h1>
    <?php
    $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
        'links'=>array('Пользователи'),
    ));
    ?>
    <div id="controls-btn" class="controls-btn">
        <strong class="title" title="Пользователи">Пользователи</strong>
        <a class="back" href="#"><span class="arrow">←</span> Вернуться</a>
        <button class="btn btn-primary" type="submit"><i class="icon icon-ok icon-white"></i>Сохранить</button>
        <button class="btn" type="submit"><i class="icon icon-check"></i>Сохранить и выйти</button>
        <a class="btn btn-danger" href="#"><i class="icon icon-trash icon-white"></i>Удалить</a>
    </div>
    <div class="clear-right"></div>
</div>

<?php /*$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'user-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'type',
		'username',
		'last_name',
		'first_name',
		'middle_name',
		'status',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); */?>

<?php
$this->widget('bootstrap.widgets.TbExtendedGridView', array(
	'filter'=>$model,
	'fixedHeader' => true,
	'headerOffset' => 200, // 40px is the height of the main navigation at bootstrap
	'type'=>'striped bordered condensed',
	'dataProvider' => $model->search(),
	'template' => "{items}",
	'bulkActions' => array(
        'actionButtons' => array(
            /*
            array(
                'buttonType' => 'button',
                'type' => 'primary',
                'size' => 'small',
                'label' => 'Testing Primary Bulk Actions',
                'click' => 'js:function(values){console.log(values);}'
            )
            */
        ),
		// if grid doesn't have a checkbox column type, it will attach
		// one and this configuration will be part of it
		'checkBoxColumnConfig' => array(
		    'name' => 'id'
		),
	),
	'columns' => array(
		'type',
		'username',
		'last_name',
		'first_name',
		'middle_name',
		'status',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>'{update} {delete}',
		),
	),
));
?>