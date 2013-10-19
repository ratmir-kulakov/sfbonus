<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Пользователи',
);

$this->menu=array(
    /*
	array(
        'label'=>'Список пользователей', 
        'url'=>array('index'), 
        'visible' => Yii::app()->user->checkAccess('administrator')
    ),
     */
	array(
        'label'=>'Создать нового пользователя', 
        'url'=>array('create'), 
        'visible' => Yii::app()->user->checkAccess('administrator')
    ),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('user-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Пользователи</h1>

<p>
Вы можете ввести оператор сравнения (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
или <b>=</b>) в начале каждого значение, которое нужно найти, чтобы определить принцип поиска.
</p>

<?php echo CHtml::link('Расширенный поиск','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'user-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'type',
		'username',
		'last_name',
		'first_name',
		'middle_name',
		/*'password',*/
		'status',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
