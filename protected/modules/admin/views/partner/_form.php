<?php
/* @var $this PartnerController */
/* @var $model Partner */
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
        <label for="Partner_content">Условия предоставления бонусных баллов</label>
        <div class="controls controls-row">
            <?php //you can use any desired dir to install this extension
            //TODO Исправить все ошибкив в elFinder
            $this->widget('application.extensions.ckeditor.CKEditor', array(
                'model'=>$model,
                'attribute'=>'conditions',
                'language'=>'ru',
                'editorTemplate'=>'advanced',
                'toolbar'=>array(
                    array('Source'),
                    array('Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo'),
                    array('Find', 'Replace', '-', 'SelectAll'),
                    array('Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat'),
                    array('NumberedList', 'BulletedList', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl'),
                    array('Link', 'Unlink'),
                    array('Table', 'HorizontalRule', 'SpecialChar'),
                    array('Format', 'FontSize'),
                    array('Maximize', 'ShowBlocks'),
                ),
                'options'=>array(
                    'filebrowserBrowseUrl' => CHtml::normalizeUrl(array('partner/fileUploader')),
                ),
            ));
            ?>
            <p class="help-block"><strong>Примечание:</strong> Условия предоставления бонусных баллов. Например, &quot;20 баллов  за каждые 100 рублей, потраченные в нашем магазине&quot;.</p>
        </div>
    </div>
    <div class="control-group">
        <label for="Partner_content">Краткая информация</label>
        <div class="controls controls-row">
            <?php //you can use any desired dir to install this extension
            //TODO Исправить все ошибкив в elFinder
            $this->widget('application.extensions.ckeditor.CKEditor', array(
                'model'=>$model,
                'attribute'=>'description',
                'language'=>'ru',
                'editorTemplate'=>'advanced',
                'toolbar'=>array(
                    array('Source'),
                    array('Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo'),
                    array('Find', 'Replace', '-', 'SelectAll'),
                    array('Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat'),
                    array('NumberedList', 'BulletedList', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl'),
                    array('Link', 'Unlink'),
                    array('Table', 'HorizontalRule', 'SpecialChar'),
                    array('Format', 'FontSize'),
                    array('Maximize', 'ShowBlocks'),
                ),
                'options'=>array(
                    'filebrowserBrowseUrl' => CHtml::normalizeUrl(array('partner/fileUploader')),
                ),
            ));
            ?>
            <p class="help-block"><strong>Примечание:</strong> Несколько предложений о фирме-партнере.</p>
        </div>
    </div>
</section>	
<section class="page-part" id="settings">
    <h1>Настройка</h1>
    <div class="control-group">
        <?php echo $form->dropDownListRow($model,'status', $model->statusOptions, array('class'=>'span3','hint'=>'<strong>Примечание:</strong> Только партнеры со статусом "Опубликован" отображаются на соответствующей странице сайте.')); ?>
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
        <?php echo $form->textAreaRow($model, 'meta_description', array('class'=>'span5','hint'=>'<strong>Примечание:</strong> Используется поисковиками, такими как Google,<br /> Yandex и т.д., при выводе результатов поиска.')); ?>
    </div>
    <div class="control-group">
        <?php echo $form->textAreaRow($model, 'meta_keywords', array('class'=>'span5','hint'=>'<strong>Примечание:</strong> Ключивые слова, встречающиеся на странице, используются поисковиками.<br /> Ключевые слова можно перечислять через пробел или запятую.')); ?>
    </div>
</section>