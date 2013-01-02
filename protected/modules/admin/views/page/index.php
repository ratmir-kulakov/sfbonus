<?php
/* @var $this PageController */

$this->pageName = 'Страницы';
$this->pageTitle = $this->pageName . ' :: ' . Yii::app()->name;
$this->breadcrumbs = array(
    'Страницы',
);
$this->backLink = '/admin/';
$this->controlButtons = array(
    array(
        'icon' => 'icon icon-plus-sign icon-white',
        'label' => 'Добавить',
        'type' => 'success',
        'url' => '/admin/page/create',
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
                if($.fn.yiiGridView.getChecked("page-grid-view-id","pageids").length == 0)
                {
                    alert("Ошибка! Необходимо выбрать хотя бы одного пользователя");
                    return false;
                }
                if(! confirm("Вы уверены, что хотите удалить выбранных пользователей?"))
                {
                    return false;
                }
                $("#page-grid-view-id").addClass("grid-view-loading");
            }',
            'data'=>'js:{Ids : $.fn.yiiGridView.getChecked("page-grid-view-id","pageids").toString(), YII_CSRF_TOKEN : "'.Yii::app()->request->csrfToken.'"}', //ids of checked rows are converted to a string
            'success'=>'function(data){
                $.fn.yiiGridView.update("page-grid-view-id", {url:""});
            }',
            'error'=>'function(jqXHR, textStatus){
                
            }',
        ),
        'htmlOptions' => array(
        ),
    ),
);
$dateisOn = 'с ' . $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                        // 'model'=>$model,
                                    'name' => 'Page[date_first]',
                                    'language' => 'ru',
                                    'value' => $model->date_first,
                                    // additional javascript options for the date picker plugin
                                    'options'=>array(
                                        'showAnim'=>'fold',
                                        'dateFormat'=>'dd.mm.yy',
                                        'changeMonth' => 'true',
                                        'changeYear'=>'true',
                                        'constrainInput' => 'false',
                                    ),
                                    'htmlOptions'=>array(
                                        'style'=>'width:70px;',
                                    ),
// DONT FORGET TO ADD TRUE this will create the datepicker return as string
                                ),true) . 
            ' по ' . 
            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                        // 'model'=>$model,
                                    'name' => 'Page[date_last]',
                                    'language' => 'ru',
                                    'value' => $model->date_last,
                                    // additional javascript options for the date picker plugin
                                    'options'=>array(
                                        'showAnim'=>'fold',
                                        'dateFormat'=>'dd.mm.yy',
                                        'changeMonth' => 'true',
                                        'changeYear'=>'true',
                                        'constrainInput' => 'false',
                                    ),
                                    'htmlOptions'=>array(
                                        'style'=>'width:70px',
                                    ),
// DONT FORGET TO ADD TRUE this will create the datepicker return as string
                                ),true);

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

$this->widget('bootstrap.widgets.TbExtendedGridView', array(
    'id'=>'page-grid-view-id',
	'filter'=>$model,
	'fixedHeader' => true,
	'headerOffset' => 87, // the height of the main navigation at bootstrap
	'type'=>'striped bordered condensed',
	'dataProvider' => $model->search(),
	'template' => "{items}",  
    //to update the table after ajax datePicker was available
    'afterAjaxUpdate'=>"function() { 
        jQuery('#Page_date_first, #Page_date_last').datepicker(jQuery.extend(
                jQuery.datepicker.regional['ru'],{
                'showAnim':'fold',
                'dateFormat':'dd.mm.yy',
                'changeMonth':'true',
                'showButtonPanel':'true',
                'changeYear':'true'
            }
        )); 
    }", 
	'columns' => array(
        array(
            'class'=>'CCheckBoxColumn', 
            'selectableRows' => 2,
            'id'=>'pageids',
            'checkBoxHtmlOptions' => array(
                'name' => 'pageids[]',
            ),
            'value'=>'$data->id',
        ),
		'name',
		array(
            'name'=>'last_update_date',
            'type' => 'raw',
            'value'=>'($data->last_update_date)? date("d.m.Y H:s", $data->last_update_date): "---"',
            'filter'=>$dateisOn, 
            'filterHtmlOptions'=>array(
                'style'=>'width: 220px',
            ),
        ),
		array(
            'name'=>'status',
            'type' => 'raw',
            'value'=>'$data->getStatusName($data->status)',
            'filter' => array(-1 => '---') + $model->statusOptions,
            'filterHtmlOptions'=>array(
                'style'=>'width: 120px',
            ),
        ),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>'{update} {delete}',
		),
	),
));