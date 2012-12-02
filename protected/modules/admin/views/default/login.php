<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle = 'Авторизация :: ' . Yii::app()->name;
?>
<div class="login-form">
                <div class="signin-wrapper">
                    <h1>Войти в Панель управления</h1>
                    <?php $form=$this->beginWidget('CActiveForm', array(
                        'id'=>'login-form',
                        'enableClientValidation'=>true,
                        'clientOptions'=>array(
                            'validateOnSubmit'=>true,
                        ),
                    )); ?>
                        <div class="control-group">
                            <?php echo $form->textField($model,'username', array('class' => 'input-xlarge', 
                                                                                 'id' => 'login', 
                                                                                 'autocomplete' => 'on', 
                                                                                 'tabindex' => 1)); ?>
                            <!--<label class="error" for="login">Необходимо ввести логин</label>-->
                            <span class="login pseudo-label">Логин</span>
                        </div>
                        <div class="control-group">
                            <?php echo $form->passwordField($model,'password', array('class' => 'input-xlarge', 
                                                                                     'id' => 'password', 
                                                                                     'autocomplete' => 'on', 
                                                                                     'tabindex' => 2)); ?>
                            <!--<label class="error" for="password">Необходимо ввести пароль</label>-->
                            <span class="password pseudo-label">Пароль</span>
                        </div>
                        <div class="control-group">
                            <?php echo Html::submitButton('Войти', array('class' => 'btn btn-primary', 'tabindex' => 3)); ?>
                        </div>
                    <?php $this->endWidget(); ?>
                </div>
                <div class="info-bar"></div>
            </div>
