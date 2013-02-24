<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content=""/>
        <meta name="description" content=""/>
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/js/jScrollPane/jScrollPane.css" />
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/style.css" />
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
                                'htmlOptions'=>array('class'=>'main'),
                                'items'=>array(
                                        array('label'=>'', 'url'=>'#'),
                                        array('label'=>'Модули', 'url'=>'#', 'items'=>array(
                                                array('label'=>'Страницы', 'url'=>array('/admin/page')),
                                                array('label'=>'Партнеры', 'url'=>array('/admin/partner')),
                                                array('label'=>'Баннеры', 'url'=>'#'),
                                            ),
                                        ),
                                        array('label'=>'Настройки', 'url'=>'#', 'visible'=>Yii::app()->user->checkAccess('administrator')),
                                        array('label'=>'Пользователи', 'url'=>array('/admin/user'), 'visible'=>Yii::app()->user->checkAccess('administrator')),
                                    ),
                            ),
                            array(
                                'class'=>'bootstrap.widgets.TbMenu',
                                'htmlOptions'=>array('class'=>'user pull-right'),
                                'items'=>array(
                                    array('label'=>Yii::app()->user->name, 'url'=>'#', 'items'=>array(
                                        array('label'=>'Настройки', 'url'=>'/admin/user/update/id/'.Yii::app()->user->id),
                                        '---',
                                        array('label'=>'Выход', 'url'=>array('/admin/default/logout')),
                                    )),
                                ),
                            ),
                        ),
                        'htmlOptions'=>array('id'=>'mainMenuBox','class'=>'bt-shdw')
                    ));
            ?>
        <?php endif; ?>
        <?php echo $content; ?>
        <footer id="f">
            
        </footer>
    </body>
</html>