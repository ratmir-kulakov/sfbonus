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
    <div id="logo-box">
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'button',
            'icon' => 'icon-edit',
            'htmlOptions' => array(
                'title' => 'Изменить логотип',
                'onclick' => '$(this).parent().find("input:file").click();',
            ),
        )); ?>
        <div class="bg"></div>
        <img class="logo" id="logo" src="<?php echo $model->logoImgBehavior->getFileUrl('126x126'); ?>" alt="" />
        <?php echo $form->fileField($model, 'image', array('style'=>'display: none;', 'data-toggle'=>'logo')) ?>
    </div>
    <div class="control-group">
        <?php echo $form->textFieldRow($model, 'name', array('class'=>'span5')); ?>
    </div>
    <div class="clear-right"></div>
    <div class="control-group">
        <label class="title" for="Partner_content">Условия предоставления бонусных баллов</label>
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
    <p>&nbsp;</p>
</section>	
<?php if(! $model->isNewRecord):?>
<section class="page-part" id="address">
    <h1 class="pull-left">Адреса и время работы</h1>
    <?php
    $this->widget('bootstrap.widgets.TbButton',array(
        'buttonType' => 'Link',
        'icon' => 'plus-sign white',
        'label' => 'Добавить',
        'type' => 'success',
        'url' => array('partnerOffices/create', 'pid'=>$model->id),
        'htmlOptions' => array(
            'id'=>'addAdrBtn',
            'class'=>'btn-mini top-btn mg-left-mini',
        ),
    ));
    ?>
    <?php
    /*
    $this->widget('bootstrap.widgets.TbButton',array(
        'buttonType' => 'ajaxLink',
        'icon' => 'trash white',
        'label' => 'Удалить',
        'type' => 'danger',
        'url' => array('partnerOffices/deletescope', 'ajax'=>'1'),
        'ajaxOptions' => array(
            'type'=>'POST',
            'beforeSend'=>'function(){
                if($.fn.yiiGridView.getChecked("partner-adr-grid-view-id","partnerAdrIds").length == 0)
                {
                    alert("Ошибка! Необходимо выбрать хотя бы один адрес");
                    return false;
                }
                if(! confirm("Вы уверены, что хотите удалить информацию о выбранных адресах?"))
                {
                    return false;
                }
                $("#partner-adr-grid-view-id").addClass("grid-view-loading");
            }',
            'data'=>'js:{Ids : $.fn.yiiGridView.getChecked("partner-adr-grid-view-id","partnerAdrIds").toString(), YII_CSRF_TOKEN : "'.Yii::app()->request->csrfToken.'"}', //ids of checked rows are converted to a string
            'success'=>'function(data){
                alert(data);
                $.fn.yiiGridView.update("partner-adr-grid-view-id", {url:""});
            }',
            'error'=>'function(jqXHR, textStatus){
                
            }',
        ),
        'htmlOptions' => array(
            'id'=>'removeAllAdrBtn',
            'class'=>'btn-mini top-btn mg-left-mini',
        ),
    ));
     */
    ?>
    <?php
    $this->widget('bootstrap.widgets.TbGridView', array(
        'id'=>'partner-adr-grid-view-id',
        'type'=>'striped bordered condensed',
        'dataProvider' => new CArrayDataProvider($model->offices, array('keyField'=>false,)),
        'template' => "{items}",  
        //to update the table after ajax datePicker was available
        'afterAjaxUpdate'=>"function() {}", 
        'columns' => array(
            /*
            array(
                'class'=>'CCheckBoxColumn', 
                'selectableRows' => 2,
                'id'=>'partnerAdrIds',
                'checkBoxHtmlOptions' => array(
                    'name' => 'partnerAdrIds[]',
                ),
                'value'=>'$data->id',
            ),
            */
            array(
                'name'=>'Адрес',
                'type' => 'raw',
                'value'=>'$data->address',
                'filter' => false, //CHtml::activeTextField(PartnerOffices::model(), 'address'),
            ),
            array(
                'name'=>'Статус',
                'type' => 'raw',
                'value'=>'$data->getStatusName($data->status)',
                'filter' => false, //CHtml::activeDropDownList($model, 'status', $model->statusOptions, array('empty'=>'---')),
                'htmlOptions'=>array('style'=>'width: 140px'),
            ),
            array(
                'class'=>'bootstrap.widgets.TbButtonColumn',
                'template'=>'{update} {delete}',
                'buttons'=>array(
                    'update'=>array(
                        'url'=>'array("partnerOffices/update", "id"=>$data->id)',
                    ),
                    'delete'=>array(
                        'url'=>'array("partnerOffices/delete", "id"=>$data->id)',
                    ),
                ),
            ),
        ),
    ));
    ?>
    <p>&nbsp;</p>
</section>
<?php endif;?>
<section class="page-part" id="settings">
    <h1>Настройка</h1>
    <div class="control-group">
        <?php echo $form->dropDownListRow($model,'status', $model->statusOptions, array('class'=>'span3','hint'=>'<strong>Примечание:</strong> Только партнеры со статусом "Опубликован" отображаются на соответствующей странице сайта.')); ?>
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