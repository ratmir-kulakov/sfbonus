<?php
/* @var $this TreeController */
/* @var $dataProvider CActiveDataProvider */


$this->pageName = 'Дерево страниц';
$this->pageTitle = $this->pageName . ' :: ' . Yii::app()->config->get('SITE.TITLE');
$this->breadcrumbs = array(
    'Дерево страниц',
);
$this->backLink = Yii::app()->urlManager->createUrl('/admin/');

$this->controlButtons = array(
    array(
        'icon' => 'icon icon-plus-sign icon-white',
        'label' => 'Добавить',
        'type' => 'success',
        'url' => Yii::app()->urlManager->createUrl('/admin/tree/create'),
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
                if($.fn.yiiGridView.getChecked("tree-grid-view-id","treeids").length == 0)
                {
                    alert("Ошибка! Необходимо выбрать хотя бы один узел");
                    return false;
                }
                if(! confirm("Вы уверены, что хотите удалить выбранные узлы?"))
                {
                    return false;
                }
                $("#tree-grid-view-id").addClass("grid-view-loading");
            }',
            'data'=>'js:{Ids : $.fn.yiiGridView.getChecked("tree-grid-view-id","treeids").toString(), YII_CSRF_TOKEN : "'.Yii::app()->request->csrfToken.'"}', //ids of checked rows are converted to a string
            'success'=>'function(data){
                $.fn.yiiGridView.update("tree-grid-view-id", {url:""});
            }',
            'error'=>'function(jqXHR, textStatus){
                
            }',
        ),
        'htmlOptions' => array(
        ),
    ),
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

$this->widget('ext.gridviewtree.TbGridViewTree', array(
    'id'=>'tree-grid-view-id',
	'filter'=>$model,
	'type'=>'striped bordered condensed',
	'dataProvider' => $model->search(),
	'template' => "{items}",  
    //to update the table after ajax datePicker was available
    'afterAjaxUpdate'=>"function() { 
        $('.table').treeTable({
            expandable: true,
            initialState: 'expanded'
        });
    }", 
	'columns' => array(
		array(
            'name'=>'name',
            'htmlOptions'=>array(
//                'style'=>'padding-left:'.(5 + $data->level*10).'px',
            ),
        ),
		'alias',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>'{update} {delete}',
		),
	),
));

Yii::app()->clientScript->registerScript('treetable', "
    $('.table').treeTable({
        expandable: true,
        initialState: 'expanded'
    });
", CClientScript::POS_READY);
