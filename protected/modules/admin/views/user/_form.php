<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
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

<section class="page-part" id="main">
    <h1>Основное</h1>
    <div class="control-group">
        <?php echo $form->textFieldRow($model, 'username', array('class'=>'span3','hint'=>'Примечание: Логин должен быть уникальным и может состоять только из букв латинского алфавита, цифр, знаков "_" и "&ndash;".')); ?>
    </div>
    <?php if($model->isNewRecord):?>
    <div class="control-group">
        <?php echo $form->passwordFieldRow($model, 'password', array('class'=>'span3', 'value' => '','hint'=>'Примечание: Пароль должен быть не менее 5 символов.')); ?>
    </div>
    <div class="control-group">
        <?php echo $form->passwordFieldRow($model, 'password_repeat', array('class'=>'span3')); ?>
    </div>
    <?php endif;?>
</section>	
<section class="page-part" id="settings">
    <h1>Настройка</h1>
    <div class="control-group">
        <?php echo $form->dropDownListRow($model,'type', $model->typeOptions, array('empty' => '---', 'class'=>'span3','hint'=>'Примечание: ')); ?>
    </div>
    <div class="control-group">
        <?php echo $form->dropDownListRow($model,'status', $model->statusOptions, array('class'=>'span3','hint'=>'Примечание: ')); ?>
    </div>
</section>	
<section class="page-part" id="fio">
    <h1>ФИО</h1>
    <div class="control-group">
        <?php echo $form->textFieldRow($model, 'last_name', array('class'=>'span3','hint'=>'Примечание: Фамилия может состоять только из букв латинского и кириллического алфавитов, и знака "&ndash;".')); ?>
    </div>
    <div class="control-group">
        <?php echo $form->textFieldRow($model, 'first_name', array('class'=>'span3','hint'=>'Примечание: Имя может состоять только из букв латинского и кириллического алфавитов, и знака "&ndash;".')); ?>
    </div>
    <div class="control-group">
        <?php echo $form->textFieldRow($model, 'middle_name', array('class'=>'span3','hint'=>'Примечание: Отчество может состоять только из букв латинского и кириллического алфавитов, и знака "&ndash;".')); ?>
    </div>
</section>	