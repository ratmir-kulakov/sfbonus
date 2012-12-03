<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content=""/>
        <meta name="description" content=""/>
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/js/jScrollPane/jScrollPane.css" />
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" />
    </head>
    <body>
        <span id="top">&nbsp;</span>
        <?php if( ! Yii::app()->user->isGuest ): ?>
            <?php $this->widget('bootstrap.widgets.TbNavbar', array(
                        'type'=>'inverse', // null or 'inverse'
                        'brand'=>'',
                        'brandUrl'=>'#',
                        'fluid'=>true,
                        'collapse'=>false, // requires bootstrap-responsive.css
                        'items'=>array(
                            array(
                                'class'=>'bootstrap.widgets.TbMenu',
                                'htmlOptions'=>array('class'=>'user pull-right'),
                                'items'=>array(
                                    array('label'=>Yii::app()->user->name, 'url'=>'#', 'items'=>array(
                                        array('label'=>'Настройки', 'url'=>'#'),
                                        '---',
                                        array('label'=>'Выход', 'url'=>array('/admin/default/login')),
                                    )),
                                ),
                            ),
                        ),
                        'htmlOptions'=>array('class'=>'bt-shdw')
                    ));
            ?>
        <?php endif; ?>
        <div id="b" class="container-fluid">
            <?php echo $content; ?>
        </div>
        <footer id="f">
            
        </footer>
    </body>
</html>