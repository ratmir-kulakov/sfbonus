<?php
/* @var $this ConfigController */
/* @var $model ConfigForm */
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
    <div class="control-group">
        <?php echo $form->textFieldRow($model, 'siteTitle', array('class'=>'span5','hint'=>'<strong>Примечание:</strong> Название сайта будет отображаться в заголовке окна браузера')); ?>
    </div>
    <div class="control-group">
        <?php echo $form->textFieldRow($model, 'adminEmail', array('class'=>'span5','hint'=>'<strong>Примечание:</strong> На указанный адрес электронной почты будут приходить все вопросы от <br />посетителей сайта, уведомления, оповещения и т.д.')); ?>
    </div>
    <div class="control-group">
        <?php echo $form->textAreaRow($model, 'metaDescription', array('class'=>'span5')) ?>
    </div>
    <div class="control-group">
        <?php echo $form->textAreaRow($model, 'metaKeywords', array('class'=>'span5')) ?>
    </div>
</section>