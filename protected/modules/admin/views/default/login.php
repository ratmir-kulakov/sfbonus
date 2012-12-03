<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle = 'Авторизация :: ' . Yii::app()->name;
?>
<div class="login-form">
    <?php $this->widget('bootstrap.widgets.TbAlert', array(
        'block'=>false, // display a larger alert block?
        'fade'=>true, // use transitions?
        'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
        'alerts'=>array( // configurations per alert type
            'error'=>array('block'=>false, 'fade'=>true, 'closeText'=>'&times;'), // success, info, warning, error or danger
        ),
        'htmlOptions'=>array(
            'class'=>'alerts-box pos-abs',
        ),
    )); ?>
                <div class="signin-wrapper">
                    <h1>Войти в Панель управления</h1>
                    <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                        'id'=>'login-form',
                        'enableClientValidation'=>true,
                        'clientOptions'=>array(
                            'validateOnSubmit'=>true,
                        ),
                    )); ?>
                        <div class="control-group">
                            <?php echo $form->textField($model, 'username', array('class' => 'input-xlarge', 
                                                                                 'id' => 'login', 
                                                                                 'autocomplete' => 'on', 
                                                                                 'tabindex' => 1)); ?>
                            <?php echo $form->error($model, 'username', array('class' => 'help-inline error')); ?>
                            <span class="login pseudo-label">Логин</span>
                        </div>
                        <div class="control-group">
                            <?php echo $form->passwordField($model, 'password', array('class' => 'input-xlarge', 
                                                                                     'id' => 'password', 
                                                                                     'autocomplete' => 'on', 
                                                                                     'tabindex' => 2)); ?>
                            <?php echo $form->error($model, 'password', array('class' => 'help-inline error')); ?>
                            <span class="password pseudo-label">Пароль</span>
                        </div>
                        <div class="control-group">
                            <?php echo Html::submitButton('Войти', array('class' => 'btn btn-primary', 'tabindex' => 3)); ?>
                        </div>
                    <?php $this->endWidget(); ?>
                </div>
                <div class="info-bar"></div>
            </div>
