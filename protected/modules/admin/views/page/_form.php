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
        <?php echo $form->textFieldRow($model, 'name', array('class'=>'span5')); ?>
    </div>
    <div class="control-group">
        <label for="Page_content">Текст</label>
        <div class="controls controls-row">
            <?php //you can use any desired dir to install this extension
            //TODO Исправить все ошибкив в elFinder
            $this->widget('application.extensions.ckeditor.CKEditor', array(
                'model'=>$model,
                'attribute'=>'content',
                'language'=>'ru',
                'editorTemplate'=>'advanced',
                'options'=>array(
                    'filebrowserBrowseUrl' => CHtml::normalizeUrl(array('page/fileUploader')),
                ),
            ));
            ?>
        </div>
    </div>
</section>	
<section class="page-part" id="settings">
    <h1>Настройка</h1>
    <div class="control-group">
        <?php echo $form->dropDownListRow($model,'status', $model->statusOptions, array('class'=>'span3','hint'=>'<strong>Примечание:</strong> Только страницы со статусом "Опубликована" отображаются на сайте.')); ?>
    </div>
    <?php if(! $model->isNewRecord):?>
    <div class="control-group">
        <?php 
        $model->last_update_date = Yii::app()->dateFormatter->formatDateTime($model->last_update_date, 'medium', 'short');
        echo $form->textFieldRow($model, 'last_update_date', array('class'=>'span3', 'readOnly'=>true, 'name'=>'date_update')); 
        ?>
    </div>
    <div class="control-group">
        <?php 
        $model->created_date = Yii::app()->dateFormatter->formatDateTime($model->created_date, 'medium', 'short');
        echo $form->textFieldRow($model, 'created_date', array('class'=>'span3', 'readOnly'=>true, 'name'=>'date_create')); 
        ?>
    </div>
    <?php endif;?>
</section>	
<section class="page-part" id="seo">
    <h1>SEO</h1>
    <div class="control-group">
        <?php echo $form->textFieldRow($model, 'meta_title', array('class'=>'span5','hint'=>'<strong>Примечание:</strong> Отображается в заголовке окна браузера. Если поле пустое, в качестве заголовка<br /> используется название страницы.')); ?>
    </div>
    <div class="control-group">
        <?php echo $form->textAreaRow($model, 'meta_description', array('class'=>'span5','hint'=>'<strong>Примечание:</strong> Описание страницы &dash; используется поисковиками, такими как Google,<br /> Yandex и т.д., при выводе результатов поиска.')); ?>
    </div>
    <div class="control-group">
        <?php echo $form->textAreaRow($model, 'meta_keywords', array('class'=>'span5','hint'=>'<strong>Примечание:</strong> Ключивые слова, встречающиеся на странице, используются поисковиками.<br /> Ключевые слова можно перечислять через пробел или запятую.')); ?>
    </div>
</section>	