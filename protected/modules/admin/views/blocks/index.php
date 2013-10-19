<?php
/* @var $this BlocksController */
/* @var $dataProvider CActiveDataProvider */

$this->pageName = 'Блоки';
$this->pageTitle = $this->pageName . ' :: ' . Yii::app()->config->get('SITE.TITLE');
$this->breadcrumbs = array(
    'Блоки',
);
$this->backLink = '/admin/';

$this->controlButtons = array(
    /*
    array(
        'icon' => 'icon icon-plus-sign icon-white',
        'label' => 'Добавить',
        'type' => 'success',
        'url' => '/admin/blocks/create',
    ),
    array(
        'buttonType' => 'ajaxLink',
        'icon' => 'trash white',
        'label' => 'Удалить',
        'type' => 'danger',
        'url' => array('deletescope', 'ajax'=>'1'),
        'ajaxOptions' => array(
            'type'=>'POST',
            'beforeSend'=>'function(){
                if($.fn.yiiGridView.getChecked("blocks-grid-view-id","blocksids").length == 0)
                {
                    alert("Ошибка! Необходимо выбрать хотя бы одного партнера");
                    return false;
                }
                if(! confirm("Вы уверены, что хотите удалить информацию о выбранных партнерах?"))
                {
                    return false;
                }
                $("#blocks-grid-view-id").addClass("grid-view-loading");
            }',
            'data'=>'js:{Ids : $.fn.yiiGridView.getChecked("blocks-grid-view-id","blocksids").toString(), YII_CSRF_TOKEN : "'.Yii::app()->request->csrfToken.'"}', //ids of checked rows are converted to a string
            'success'=>'function(data){
                $.fn.yiiGridView.update("blocks-grid-view-id", {url:""});
            }',
            'error'=>'function(jqXHR, textStatus){
                
            }',
        ),
        'htmlOptions' => array(
        ),
    ),
    */
);

$this->widget('bootstrap.widgets.TbAlert', array(
    'block'=>false, // display a larger alert block?
    'fade'=>true, // use transitions?
    'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
    'alerts'=>array( // configurations per alert type
        'success'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), // success, info, warning, error or danger
        'error'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), 
    ),
    'htmlOptions'=>array(
        'class'=>'alerts-box',
    ),
));

$this->widget('bootstrap.widgets.TbGridView', array(
    'id'=>'blocks-grid-view-id',
	'filter'=>$model,
	'type'=>'striped bordered condensed',
	'dataProvider' => $model->search(),
	'template' => "{items}",  
    //to update the table after ajax datePicker was available
    'afterAjaxUpdate'=>"function() {}", 
	'columns' => array(
		'name',
		array(
            'name'=>'status',
            'type' => 'raw',
            'value'=>'$data->getStatusName($data->status)',
            'filter' => CHtml::activeDropDownList($model, 'status', $model->statusOptions, array('empty'=>'---')),
            'htmlOptions'=>array('style'=>'width: 140px'),
        ),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>'{update}',
		),
	),
));
