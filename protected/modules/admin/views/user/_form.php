<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>false,
    'htmlOptions'=>array('class'=>'user-form')
)); ?>

<section class="page-part" id="main">
    <h1>Основное</h1>
    <div class="control-group">
        <?php echo $form->textFieldRow($model, 'username', array('class'=>'span7','hint'=>'Примечание: Логин должен быть уникальным и может состоять только из букв латинского алфавита, цифр, знаков "_" и "&ndash;".')); ?>
    </div>
    <div class="control-group">
        <?php echo $form->passwordFieldRow($model, 'password', array('class'=>'span3','hint'=>'Примечание: ')); ?>
    </div>
    <div class="control-group">
        <?php echo $form->passwordFieldRow($model, 'password_repeat', array('class'=>'span3','hint'=>'Примечание: ')); ?>
    </div>
</section>	
<section class="page-part" id="settings">
    <h1>Настройка</h1>
    
</section>	
<section class="page-part" id="fio">
    <h1>ФИО</h1>
    
</section>	

<?php $this->endWidget(); ?>