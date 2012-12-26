<?php
/* @var $this UserController */
/* @var $model User */

$this->pageName = 'Редактирование';

$this->pageTitle = $this->pageName . ' :: Пользователи :: ' . Yii::app()->name;

$this->breadcrumbs = array(
    'Пользователи'=>'/admin/user',
    'Редактирование',
);


if(Yii::app()->user->checkAccess('administrator'))
{
    $this->backLink = '/admin/user';
    $this->controlButtons[] = array(
        'icon' => 'icon icon-plus-sign icon-white',
        'label' => 'Добавить',
        'type' => 'success',
        'url' => '/admin/user/create',
    );
}

$this->controlButtons[] = array(
    'buttonType'=>'submit',
    'icon' => 'ok white',
    'label' => 'Сохранить',
    'type' => 'primary',
    'htmlOptions'=>array(
        'name'=>'saveUser',
    ),
);

if(Yii::app()->user->checkAccess('administrator'))
{
    $this->controlButtons[] = array(
        'buttonType'=>'submit',
        'icon' => 'check',
        'label' => 'Сохранить и выйти',
        'htmlOptions'=>array(
            'name'=>'saveUserExit',
        ),
    );
    $this->controlButtons[] = array(
        'buttonType'=>'submit',
        'icon' => 'trash white',
        'label' => 'Удалить',
        'type' => 'danger',
        'htmlOptions'=>array(
            'submit' => array('user/delete', 'id'=>$model->id),
            'confirm' => 'Вы уверены, что хотите удалить данного пользователя?'
        ),
    );
}

$this->menu=array(
	array(
        'label'=>'Логин и пароль',
        'icon'=>'chevron-right',
        'url'=>array('','id'=>$model->id,'#'=>'main'), 
    ),
	array(
        'label'=>'Настройка', 
        'icon'=>'chevron-right',
        'url'=>array('','id'=>$model->id, '#'=>'settings'), 
        'visible'=>Yii::app()->user->checkAccess('administrator'),
    ),
	array(
        'label'=>'ФИО', 
        'icon'=>'chevron-right',
        'url'=>array('','id'=>$model->id, '#'=>'fio'), 
    ),
);

$form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'user-form',
    'enableAjaxValidation'=>false,
    'htmlOptions'=>array('class'=>'user-form'),
    'inlineErrors'=>true,
)); 
?>

<div id="page-info" class="page-info">
    <h1><?php echo $this->pageName;?></h1>
    <?php
    $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
        'links'=>$this->breadcrumbs,
    ));
    ?>
    <div id="controls-btn" class="controls-btn">
        <strong class="title" title="<?php echo $this->pageName;?>"><?php echo $this->pageName;?></strong>
        <?php if(!empty($this->backLink)):?>
        <a class="back" href="<?php echo $this->backLink;?>"><span class="arrow">←</span> Вернуться</a>
        <?php endif;?>
        <?php 
        if(count($this->controlButtons)):
            foreach($this->controlButtons as $button):
                $this->widget('bootstrap.widgets.TbButton',$button);
            endforeach;
        endif;?>
    </div>
    <div class="clear-right"></div>
</div>
<div class="left-sidebar">
    <?php
        $this->widget('bootstrap.widgets.TbMenu', array(
            'type'=>'list',
            'itemTemplate'=>'{menu}',
            'items'=>$this->menu,
            'htmlOptions'=>array('class'=>'left-sidenav', 'id'=>'local-nav'),
        ));
    ?>
</div>
<div class="center-sidebar-wrapper">
    <div class="center-sidebar">
    <?php echo $this->renderPartial('_form', array('model'=>$model, 'form'=>$form)); ?>
    </div>
</div>

<?php $this->endWidget(); ?>

<!-- Modal -->
<div id="changePassModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="changePassModalLabel" aria-hidden="true">
<?php    
$modalForm=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'action'=>array('changePassword', 'id'=>$model->id),
    'id'=>'change-pass-user-form',
    'enableAjaxValidation'=>false,
    'htmlOptions'=>array(
        'class'=>'modal-user-form',
        'onsubmit'=>"return false;",  //Disable normal form submit 
//        'onkeypress'=>" if(event.keyCode == 13){ send(); } " //Do ajax call when user presses enter key
    ),
    'inlineErrors'=>true,
    'focus'=>array($model,'password'),
));  
?>
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="changePassModalLabel">Изменение пароля</h3>
    </div>
    <div class="modal-body">
        <div class="control-group">
            <?php echo $form->passwordFieldRow($model, 'password', array('class'=>'span3', 'value' => '','hint'=>'Примечание: Пароль должен быть не менее 5 символов.')); ?>
        </div>
        <div class="control-group">
            <?php echo $form->passwordFieldRow($model, 'password_repeat', array('class'=>'span3')); ?>
        </div>
    </div>
    <div class="modal-footer">
        <?php $this->widget('bootstrap.widgets.TbButton',array(
            'buttonType'=>'ajaxSubmit',
            'label' => 'Сохранить',
            'type' => 'primary',
            'url' => array('changePassword', 'id'=>$model->id, 'ajax'=>'1'),
            'ajaxOptions' => array(
                'type'=>'POST',
                'beforeSend'=>'function(){
                    alert($("#change-pass-user-form").serialize());
                }',
                'data'=>'js:$("#change-pass-user-form").serialize()', //ids of checked rows are converted to a string
                'success'=>'function(data){
                    alert(data);
                }',
                'error'=>'function(jqXHR, textStatus){
                    alert(textStatus);
                }',
            ),
            'htmlOptions'=>array(
                'id'=>'changePassword',
                'name'=>'changePassword',
            ),
        ));?>
        <?php $this->widget('bootstrap.widgets.TbButton',array(
            'buttonType'=>'button',
            'label' => 'Отмена',
            'type' => '',
            'htmlOptions'=>array(
                'data-dismiss'=>'modal',
                'aria-hidden'=>'true',
                'onclick'=>'$("#change-pass-user-form #User_password").val(""); $("#change-pass-user-form #User_password_repeat").val("");'
            ),
        ));?>
    </div>
<?php $this->endWidget(); ?>
</div>