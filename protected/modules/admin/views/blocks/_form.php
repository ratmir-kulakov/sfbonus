<?php
/* @var $this BlocksController */
/* @var $model Blocks */
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
    <div class="control-group">
        <?php echo $form->textFieldRow($model, 'name', array('class'=>'span7','hint'=>'<strong>Примечание:</strong> Название блока на сайте не выводится.')); ?>
    </div>
    <div class="control-group">
        <?php echo $form->textFieldRow($model, 'title', array('class'=>'span7')); ?>
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
    <div class="control-group">
        <?php echo $form->dropDownListRow($model,'status', $model->statusOptions, array('class'=>'span3','hint'=>'<strong>Примечание:</strong> Только страницы со статусом "Опубликована" отображаются на сайте.')); ?>
    </div>
</section>