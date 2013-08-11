<?php
/* @var $this PartnerOfficesController */
/* @var $model PartnerOffices */
/* @var $form CActiveForm */
/* @var $ymapModel YandexMapModel */

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
    <?php if( $model->isNewRecord ): ?>
    <?php echo Html::activeHiddenField($model, 'partner_id', array('id'=>'partner_id')); ?>
    <?php endif; ?>
    <div class="control-group">
        <?php echo $form->dropDownListRow($model,'status', $model->statusOptions, array('class'=>'span3','hint'=>'<strong>Примечание:</strong> Только адрес со статусом "Опубликован" отображается на соответствующей странице сайта.')); ?>
    </div>
    <div class="control-group" style="padding-bottom: 36px; ">
        <label for="Partner_content">Схема проезда</label>
        <div class="controls controls-row">
            <?php echo Html::activeDropDownList($ymapModel,
                                            'status', 
                                            array(
                                                YandexMapModel::STATUS_INACTIVE  => 'Не показывать',
                                                YandexMapModel::STATUS_ACTIVE => 'Показать',
                                            ), 
                                            array('class'=>'span3')
                  ); 
            ?>
            <div class="clear-left"></div>
            <?php
            $this->widget('ext.yandexmap.YandexMap',array(
                'id'=>'map',
                'width'=>600,
                'height'=>400,
                'center'=>array($ymapModel->center_lat, $ymapModel->center_lon),
                'zoom'=>$ymapModel->zoom,
                'type'=>$ymapModel->type ? $ymapModel->type : 'yandex#map',
                'controls' => array(
                    'zoomControl' => true,
                    'typeSelector' => true,
                    'mapTools' => false,
                    'smallZoomControl' => false,
                    'miniMap' => false,
                    'scaleLine' => false,
                    'searchControl' => array(
                        'noPlacemark' => true,
                    ),
                    'trafficControl' => false
                ),
                'placemark' => array(
                    array(
                        'lat'=>$ymapModel->placemrk_lat,
                        'lon'=>$ymapModel->placemrk_lon,
                        'properties'=>array(
                            'balloonContentHeader'=>'header',
                            'balloonContent'=>'1',
                            'balloonContentFooter'=>'footer',
                        ),
                        'options'=>array(
                            'draggable'=>true,
                            'hasBalloon'=>false,
                            'style' => "default#houseIcon",
                        )
                    )
                ),
            ));
            
            echo Html::activeHiddenField($ymapModel, 'center_lat', array('id'=>'ymap_center_lat'));
            echo Html::activeHiddenField($ymapModel, 'center_lon', array('id'=>'ymap_center_lon'));
            echo Html::activeHiddenField($ymapModel, 'placemrk_lat', array('id'=>'ymap_placemrk_lat'));
            echo Html::activeHiddenField($ymapModel, 'placemrk_lon', array('id'=>'ymap_placemrk_lon'));
            echo Html::activeHiddenField($ymapModel, 'zoom', array('id'=>'ymap_zoom'));
            echo Html::activeHiddenField($ymapModel, 'type', array('id'=>'ymap_type'));
            ?>
        <?php
        //TODO Выяснить как отлавливать значение при изменениитипа карты
        Yii::app()->clientScript->registerScript(
                'partnerOffice'.$model->id,
                '
                ymaps.ready(function(){
                    var placemark = map.geoObjects.getIterator().getNext();
                    var search = map.controls.get("searchControl");
                    var typeSelector = map.controls.get("typeSelector");
                    
                                       
                    $("#ymap_type").val(map.getType());
                    $("#ymap_zoom").val(map.getZoom());
                    $("#ymap_center_lat").val(map.getCenter()[0]);
                    $("#ymap_center_lon").val(map.getCenter()[1]);
                    $("#ymap_placemrk_lat").val(placemark.geometry.getCoordinates()[0]);
                    $("#ymap_placemrk_lon").val(placemark.geometry.getCoordinates()[1]);
                    
                    search.events.add("resultselect", function(event){
                        var results = search.getResultsArray(),
                            selected = event.get("resultIndex");
                        
                        map.geoObjects.remove(placemark);
                        placemark = results[selected];
                        placemark.options.set({draggable:true, hasBalloon:false});
                        $("#ymap_placemrk_lat").val(placemark.geometry.getCoordinates()[0]);
                        $("#ymap_placemrk_lon").val(placemark.geometry.getCoordinates()[1]);
                        placemark.events.add("dragend", function(event){
                            $("#ymap_placemrk_lat").val(placemark.geometry.getCoordinates()[0]);
                            $("#ymap_placemrk_lon").val(placemark.geometry.getCoordinates()[1]);
                        });
                    });
                    
                    map.events.add("boundschange", function(event){
                        if( event.get("newZoom") != event.get("oldZoom") ) 
                        {
                            $("#ymap_zoom").val(event.get("newZoom"));
                        }
                        
                        if( event.get("newCenter") != event.get("oldCenter") ) 
                        {
                            $("#ymap_center_lat").val(event.get("newCenter")[0]);
                            $("#ymap_center_lon").val(event.get("newCenter")[1]);
                        }
                    });
                    
                    placemark.events.add("dragend", function(event){
                        $("#ymap_placemrk_lat").val(placemark.geometry.getCoordinates()[0]);
                        $("#ymap_placemrk_lon").val(placemark.geometry.getCoordinates()[1]);
                    });
                    
                    typeSelector.events.add("mapchange", function(event){
                        alert("123");
                        /*
                        if( event.get("newMap") != event.get("oldMap") ) 
                        {
                            //$("#ymap_type").val(event.get("newMap"));
                        }
                        */
                    });
                    
                    
                });
                ',
                CClientScript::POS_END);
        ?>
        </div>
    </div>
</section>