<?php
/* @var $this UserController */
/* @var $model User */

$this->pageName = 'Пользователи';
$this->breadcrumbs = array(
    'Пользователи',
);
$this->controlButtons = array(
    $this->widget('bootstrap.widgets.TbButton',array(
        'icon' => 'icon icon-plus-sign icon-white',
        'label' => 'Добавить',
        'size' => '',
        'type' => 'success',
        'url' => '/admin/user/create',
    )),
    $this->widget('bootstrap.widgets.TbButton',array(
        'icon' => 'trash white',
        'label' => 'Удалить',
        'size' => '',
        'type' => 'danger',
        'url' => '#',
    )),
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

<?php
$this->widget('bootstrap.widgets.TbExtendedGridView', array(
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
		'username',
		array(
            'name'=>'type',
            'type' => 'raw',
            'value'=>'$data->getTypeName($data->type)',
            'filter' => array(-1 => '---') + $model->getTypeOptions(),
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
            'filter' => array(-1 => '---') + $model->getStatusOptions(),
        ),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>'{update} {delete}',
		),
	),
));
?>