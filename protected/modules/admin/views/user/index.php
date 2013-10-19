<?php
/* @var $this UserController */
/* @var $model User */

$this->pageName = 'Пользователи';
$this->pageTitle = $this->pageName . ' :: ' . Yii::app()->name;
$this->breadcrumbs = array(
    'Пользователи',
);
$this->backLink = Yii::app()->urlManager->createUrl('/admin/');
$this->controlButtons = array(
    array(
        'icon' => 'icon icon-plus-sign icon-white',
        'label' => 'Добавить',
        'type' => 'success',
        'url' => Yii::app()->urlManager->createUrl('/admin/user/create'),
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
                if($.fn.yiiGridView.getChecked("user-grid-view-id","userids").length == 0)
                {
                    alert("Ошибка! Необходимо выбрать хотя бы одного пользователя");
                    return false;
                }
                if(! confirm("Вы уверены, что хотите удалить выбранных пользователей?"))
                {
                    return false;
                }
                $("#user-grid-view-id").addClass("grid-view-loading");
            }',
            'data'=>'js:{Ids : $.fn.yiiGridView.getChecked("user-grid-view-id","userids").toString(), YII_CSRF_TOKEN : "'.Yii::app()->request->csrfToken.'"}', //ids of checked rows are converted to a string
            'success'=>'function(data){
                $.fn.yiiGridView.update("user-grid-view-id", {url:""});
            }',
            'error'=>'function(jqXHR, textStatus){
                
            }',
        ),
        'htmlOptions' => array(
        ),
    ),
);
// this is the date picker
$dateisOn = 'с ' . $this->widget('zii.widgets.jui.CJuiDatePicker', array(
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
            ' по ' . 
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
        'error'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), 
    ),
    'htmlOptions'=>array(
        'class'=>'alerts-box',
    ),
)); ?>
<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id'=>'user-grid-view-id',
	'filter'=>$model,
//	'fixedHeader' => true,
//	'headerOffset' => 87, // the height of the main navigation at bootstrap
	'type'=>'striped bordered condensed',
	'dataProvider' => $model->search(),
	'template' => "{items}",  
    //to update the table after ajax datePicker was available
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
            'id'=>'userids',
            'checkBoxHtmlOptions' => array(
                'name' => 'userids[]',
            ),
            'value'=>'$data->id',
        ),
		'username',
		array(
            'name'=>'type',
            'type' => 'raw',
            'value'=>'$data->getTypeName($data->type)',
            'filter' => CHtml::activeDropDownList($model, 'type', $model->typeOptions, array('empty'=>'---')),
        ),
		'last_name',
		'first_name',
		'middle_name',
		array(
            'name'=>'last_login_time',
            'type' => 'raw',
            'value'=>'($data->last_login_time)? Yii::app()->dateFormatter->formatDateTime($data->last_login_time, "medium", "short"): "---"',
            'filter'=>$dateisOn, 
            'htmlOptions'=>array(
                'style'=>'width: 220px',
            ),
        ),
		array(
            'name'=>'status',
            'type' => 'raw',
            'value'=>'$data->getStatusName($data->status)',
            'filter' => CHtml::activeDropDownList($model, 'status', $model->statusOptions, array('empty'=>'---')),
            'htmlOptions'=>array(
                'style'=>'width: 140px',
            ),
        ),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>'{update} {delete}',
		),
	),
));
?>