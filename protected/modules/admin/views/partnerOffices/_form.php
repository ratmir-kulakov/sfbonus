<?php
/* @var $this PartnerOfficesController */
/* @var $model PartnerOffices */
/* @var $form CActiveForm */

$this->widget('bootstrap.widgets.TbAlert', array(
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
        <?php echo $form->textFieldRow($model, 'address', array('class'=>'span5','hint'=>'<strong>Пример:</strong> г. Махачкала, пр-т Р. Гамзатова, 20, строение 3, корп. 2')); ?>
    </div>
    <div class="control-group">
        <?php echo $form->textFieldRow($model, 'phone', array('class'=>'span5','hint'=>'<strong>Примечание:</strong> Можно указать несколько телефонов. Например, (8722) 78-00-01, 65-01-01.')); ?>
    </div>
    <div class="control-group">
        <label for="Partner_content">График работы</label>
        <div class="controls controls-row">
            <?php //you can use any desired dir to install this extension
            //TODO Исправить все ошибкив в elFinder
            $this->widget('application.extensions.ckeditor.CKEditor', array(
                'model'=>$model,
                'attribute'=>'schedule',
                'language'=>'ru',
                'editorTemplate'=>'advanced',
                'toolbar'=>array(
                    array('Source'),
                    array('Cut', 'Copy', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo'),
                    array('Find', 'Replace', '-', 'SelectAll'),
                    array('Bold', 'Italic', 'Underline', '-', 'RemoveFormat'),
                    array('Maximize', 'ShowBlocks'),
                ),
                'options'=>array(
                    'filebrowserBrowseUrl' => CHtml::normalizeUrl(array('partner/fileUploader')),
                ),
            ));
            ?>
            <p class="help-block"><strong>Примечание:</strong> График работы магазина/кафе/ресторана. Например, 10:00 - 23:00 (Понедельник-Воскресенье)</p>
        </div>
    </div>
    <div class="control-group">
        <?php echo $form->dropDownListRow($model,'ymaps_type', $model->mapTypes, array('class'=>'span3',)); ?>
    </div>
    <div class="control-group">
        <?php echo $form->textFieldRow($model, 'cgeopoint_x', array('class'=>'span5','hint'=>'<strong>Примечание:</strong> .')); ?>
    </div>
    <div class="control-group">
        <?php echo $form->textFieldRow($model, 'cgeopoint_y', array('class'=>'span5','hint'=>'<strong>Примечание:</strong> .')); ?>
    </div>
    <div class="control-group">
        <?php echo $form->textFieldRow($model, 'geopoint_x', array('class'=>'span5','hint'=>'<strong>Примечание:</strong> .')); ?>
    </div>
    <div class="control-group">
        <?php echo $form->textFieldRow($model, 'geopoint_y', array('class'=>'span5','hint'=>'<strong>Примечание:</strong> .')); ?>
    </div>
    <div class="control-group">
        <?php echo $form->dropDownListRow($model,'status', $model->statusOptions, array('class'=>'span3','hint'=>'<strong>Примечание:</strong> Только адрес со статусом "Опубликован" отображается на соответствующей странице сайта.')); ?>
    </div>
</section>