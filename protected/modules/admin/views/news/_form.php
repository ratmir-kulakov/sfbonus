<?php
/* @var $this NewsController */
/* @var $model News */
/* @var $form TbActiveForm */
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
        <?php echo $form->textFieldRow($model, 'name', array('class'=>'span7')); ?>
    </div>
    <div class="control-group">
        <label class="required" for="News_date_publ">Дата и время публикации <span class="required">*</span></label>
        <div class="controls controls-row">
            <div class="input-append" style="display: inline-block">
                <?php echo $this->widget('bootstrap.widgets.TbDatePicker', array(
                    'form' => $form,
                    'model'=>$model,
                    'attribute' => 'date_publ',
                    'options'=>array(
                        'showAnim'=>'fold',
                        'format'=>'dd.mm.yyyy',
                        'changeMonth' => 'true',
                        'changeYear'=>'true',
                        'constrainInput' => 'false',
                        'language' => 'ru',
                        'weekStart' => 1,
                    ),
                    'htmlOptions'=>array(
                        'style'=>'width:90px;',
                        'value' => ($model->date_published)? date('d.m.Y', $model->date_published) : date('d.m.Y', time()),
                    ),
                ), true)
                ?>
                <span class="add-on" id="date_publ_add_on" style="cursor: pointer;" title="Выбрать датуы"><i class="icon-calendar"></i></span>
                <?php
                    Yii::app()->clientScript->registerScript(
                        'news',
                        '$("#date_publ_add_on").on("click", function(){$("#News_date_publ").bdatepicker("show");});',
                        CClientScript::POS_LOAD
                    );
                ?>
            </div>&nbsp;
            <div class="input-append" style="display: inline-block">
                <?php echo $this->widget('bootstrap.widgets.TbTimePicker', array(
                    'form' => $form,
                    'model'=>$model,
                    'attribute' => 'time_publ',
                    'options'=>array(
                        'minuteStep'=>1,
                        'showMeridian'=>false
                    ),
                    'htmlOptions'=>array(
                        'style'=>'width:50px;',
                        'title'=>'Указать время',
                        'value' => ($model->date_published)? date('H:i', $model->date_published) : date('H:i', time()),
                    ),
                ), true)
                ?>
            </div>
        </div>
    </div>
    <div class="control-group">
        <?php echo $form->textAreaRow(
                $model, 
                'intro', 
                array(
                    'rows'=>'4', 
                    'style'=>'width: 95%; max-width: 95%', 
                    'hint'=>'<strong>Примечание:</strong> Текст выводится в ленте новостей под названием новости и датой публикации, т.е. в качестве краткого описания новости'
                )
            ); 
        ?>
    </div>
    <div class="control-group">
        <label class="required" for="Page_content">Текст <span class="required">*</span></label>
        <div class="controls controls-row">
            <?php
            
            $this->widget('ext.tinymce.TinyMce', array(
                'model' => $model,
                'attribute' => 'content',
                'compressorRoute' => 'admin/tinyMce/compressor',
                'spellcheckerUrl' => array('tinyMce/spellchecker'),
                'settings' => array(
                    'theme_advanced_buttons1' => "code,|,cut,copy,paste,pastetext,pasteword,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,formatselect,fontsizeselect",
                    'theme_advanced_buttons2' => "search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,|,forecolor,backcolor,|,ltr,rtl",
                    'theme_advanced_buttons3' => "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,iespell,media,advhr",
                    'theme_advanced_buttons4' => "styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,|,fullscreen,spellchecker,|,help",
                    'width' => '97%',
                ),
                'fileManager' => array(
                    'class' => 'ext.elFinder.TinyMceElFinder',
                    'connectorRoute'=>'admin/elfinder/connector',
                ),
                'htmlOptions' => array(
                    'rows' => 6,
                ),
            ));
            ?>
        </div>
    </div>
</section>	
<hr />
<?php if( !$model->isNewRecord ): ?>
<section class="page-part" id="photo">
    <h1>Фотографии</h1>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
</section>
<hr />
<?php endif; ?>
<section class="page-part" id="settings">
    <h1>Настройка</h1>
    <div class="control-group">
        <?php echo $form->dropDownListRow($model,'status', $model->statusOptions, array('class'=>'span3','hint'=>'<strong>Примечание:</strong> Только страницы со статусом "Опубликована" отображаются на сайте.')); ?>
    </div>
    <?php if(! $model->isNewRecord):?>
    <div class="control-group">
        <?php 
        $model->date_create = Yii::app()->dateFormatter->formatDateTime($model->date_create, 'medium', 'short');
        echo $form->textFieldRow($model, 'date_create', array('class'=>'span3', 'readOnly'=>true, 'name'=>'date_create')); 
        ?>
    </div>
    <?php endif;?>
</section>
<hr />	
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