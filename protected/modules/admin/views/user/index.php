<?php
/* @var $this UserController */
/* @var $model User */

$this->pageName = 'Пользователи';
$this->pageTitle = $this->pageName . ' :: ' . Yii::app()->name;
$this->breadcrumbs = array(
    'Пользователи',
);
$this->backLink = '/admin/';
$this->controlButtons = array(
    array(
        'icon' => 'icon icon-plus-sign icon-white',
        'label' => 'Добавить',
        'type' => 'success',
        'url' => '/admin/user/create',
    ),
    array(
        'buttonType' => 'ajaxLink',
        'icon' => 'trash white',
        'label' => 'Удалить',
        'type' => 'danger',
        'url' => 'deletescope',
        'ajaxOptions' => array(
           'type'=>'POST',
           'data'=>'js:{theIds : $.fn.yiiGridView.getChecked("user-grid-view-id","example-check-boxes").toString()}'
           // pay special attention to how the data is passed here
        ),
        'htmlOptions' => array(),
    ),
);
// this is the date picker
$dateisOn = $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                        // 'model'=>$model,
                                    'name' => 'User[date_first]',
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
            ' To ' . 
            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                        // 'model'=>$model,
                                    'name' => 'User[date_last]',
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

?>
<?php $this->widget('bootstrap.widgets.TbAlert', array(
    'block'=>false, // display a larger alert block?
    'fade'=>true, // use transitions?
    'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
    'alerts'=>array( // configurations per alert type
        'success'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), // success, info, warning, error or danger
        'error'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), // success, info, warning, error or danger
    ),
    'htmlOptions'=>array(
        'class'=>'alerts-box',
    ),
)); ?>
<?php
$this->widget('bootstrap.widgets.TbExtendedGridView', array(
    'id'=>'user-grid-view-id',
	'filter'=>$model,
	'fixedHeader' => true,
	'headerOffset' => 87, // the height of the main navigation at bootstrap
	'type'=>'striped bordered condensed',
	'dataProvider' => $model->search(),
	'template' => "{items}",  
    // чтобы после ajax обновления таблицы datePicker был доступен
    'afterAjaxUpdate'=>"function() { 
        jQuery('#User_date_first, #User_date_last').datepicker(jQuery.extend(
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
            'id'=>'user-check-box',
            'checkBoxHtmlOptions' => array(
                'name' => 'userids[]',
            ),
            'value'=>'$data->id',
//            'checked'=>'(in_array($data->id, $current_reviewers) ? 1 : ""',           
        ),
		'username',
		array(
            'name'=>'type',
            'type' => 'raw',
            'value'=>'$data->getTypeName($data->type)',
            'filter' => array(-1 => '---') + $model->typeOptions,
        ),
		'last_name',
		'first_name',
		'middle_name',
		array(
            'name'=>'last_login_time',
            'type' => 'raw',
            'value'=>'($data->last_login_time)? date("d.m.Y H:s", $data->last_login_time): "---"',
            'filter'=>$dateisOn, 
        ),
		array(
            'name'=>'status',
            'type' => 'raw',
            'value'=>'$data->getStatusName($data->status)',
            'filter' => array(-1 => '---') + $model->statusOptions,
        ),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>'{update} {delete}',
		),
	),
));
?>