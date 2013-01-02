<div id="file-uploader"></div>
 
<?php
 
$filesPath = realpath(Yii::app()->basePath . "/../upload");
$filesUrl = Yii::app()->baseUrl . "/upload";
 
$this->widget("ext.ezzeelfinder.ElFinderWidget", array(
    'selector' => "div#file-uploader",
    'clientOptions' => array(
        'lang' => "ru",
        'resizable' => false,
        'wysiwyg' => "ckeditor"
    ),
    'connectorRoute' => "admin/page/fileUploaderConnector",
    'connectorOptions' => array(
        'roots' => array(
            array(
                'driver'  => "LocalFileSystem",
                'path' => $filesPath,
                'URL' => $filesUrl,
                'tmbPath' => $filesPath . DIRECTORY_SEPARATOR . ".thumbs",
                'mimeDetect' => "internal",
                'accessControl' => "access"
            )
        )
    )
));
 
?>