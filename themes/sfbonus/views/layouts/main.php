<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html class="no-js">
    <head>
        <meta charset="UTF-8" />
        <title><?php echo Yii::app()->config->get('SITE.TITLE'); ?></title>
        <meta name="description" content="" />
        <meta name="keywords" content="" />
        <script>document.getElementsByTagName('html')[0].setAttribute('class', 'js');</script>
        <link rel="shortcut icon" href="<?php echo Yii::app()->theme->baseUrl; ?>/images/favicon.ico" type="image/x-icon" />
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/reset.css" media="screen, print" />
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/js/nivo-slider/nivo-slider.css" media="screen" />
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/base.css" />
        <!--[if IE]>
            <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/ie.css" />
            <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/modernizr.custom.min.js"></script>
        <![endif]-->
        <!--[if lt IE 9]>
            <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/ie-lt-9.css" />
            <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/modernizr.custom.min.js"></script>
        <![endif]-->
        <!--[if IE 7]>
            <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/ie7.css" media="screen" />
        <![endif]-->
    </head>
    <body>
        <header id="h" class="wrapper-in">
            <a href="/"><img class="logo" src="<?php echo Yii::app()->theme->baseUrl; ?>/images/logo.png" title="Подсолнух. Бонусный клуб" alt="Подсолнух. Бонусный клуб" /></a>
            <div class="contacts" itemscope itemtype="http://schema.org/Organization">
                <span class="blck phone" itemprop="telephone">8-800-123-45-67</span>
                <span class="blck hint">звонок по России бесплатный</span>
                <a class="feedback" id="feedback" href="#">Задать вопрос</a>
            </div>
            <nav id="search">
                <form action="/search.html" method="get">
                    <div class="searchFld-bg">
                        <input id="searchFld" class="txt-shdw" type="text" title="Поиск..." placeholder="Поиск..." value="" />
                        <button class="txt-shdw" type="submit" title="Найти"></button>
                    </div>
                </form>
                <a class="sitemap" href="./sitemap.html">карта сайта</a>
            </nav>
            <nav class="main">
                <?php $this->widget('zii.widgets.CMenu', array(
                    'id'=>'main-nav',
                    'items'=>array(
                        array(
                            'label'=>'О программе', 
                            'url'=>array('/about'),
                            'items'=>array(
                                array('itemOptions' => array('class'=>'dropdown user')),
                                array('label'=>'Как стать участником', 'url'=>array('/about/kak-stat-uchastnikom')),
                                array('label'=>'Как стать партнером', 'url'=>array('/about/kak-stat-partnerom')),
                                array('label'=>'Правила программы', 'url'=>array('/about/rules')),
                                array('label'=>'Об организаторах', 'url'=>array('/about/about-the-organizers')),
                                array('label'=>'Контакты', 'url'=>array('/about/contacts')),
                            ),
                        ),
                        array('label'=>'Партнеры', 'url'=>array('/partners')),
                        array('label'=>'Акции и спецпредложения', 'url'=>array('/special-offers')),
                        array('label'=>'Новости', 'url'=>array('/news')),
                        array('label'=>'Личный кабинет', 'url'=>'http://pc.iqloyalty.com/'),
                    ),
                    'htmlOptions' => array(
                        'class'=>'inl-blck bt',
                        'role'=>'navigation',
                    ),
                ));                
                ?>
            </nav>
        </header>
        <?php echo $content; ?>
        <footer id="f">
            <div class="hr"></div>
            <div class="content">
                <div id="copyright" class="txt-shdw">
                    <p>&copy; 2012 ООО &laquo;ВТЕ-Кавказ&raquo;. Все права защищены.</p>
                    <p>Тел.: 8(800)123-45-67 E-mail: <a href="mailto:info@sfbonus.ru">info@sfbonus.ru</a></p>
                </div>
                <div class="social">
                    <span class="title txt-shdw">Мы в интернете:</span>
                    <div class="pics">
                        <a href="https://twitter.com/" target="_blank"><img class="twitter" src="<?php echo Yii::app()->theme->baseUrl; ?>/images/blank.gif" alt="" /></a>
                        <a href="https://www.facebook.com/" target="_blank"><img class="fb" src="<?php echo Yii::app()->theme->baseUrl; ?>/images/blank.gif" alt="" /></a>
                        <a href="http://vk.com/" target="_blank"><img class="vk" src="<?php echo Yii::app()->theme->baseUrl; ?>/images/blank.gif" alt="" /></a>
                        <a href="http://www.odnoklassniki.ru/" target="_blank"><img class="odnokl" src="<?php echo Yii::app()->theme->baseUrl; ?>/images/blank.gif" alt="" /></a>
                    </div>
                </div>
                <ul class="nav"> 
                    <li><a href="./rules.html">Правила программы</a></li>
                    <li><a href="./about/contacts.html">Контактная информация</a></li>
                </ul>
                <a class="dev-design" href="http://www.dekartmedia.ru/" target="_blank">Разработка дизайна Декарт медиа</a>
            </div>
        </footer>
        <div id="feedback-form" class="clear-left" title="Задать вопрос">
            <form id="send-mail-form" action="/feedback.html" method="post">
                <fieldset>
                    <div class="control-group">
                        <label for="frm_question" class="required">Вопрос <span class="required">*</span></label>
                        <div class="controls controls-row">
                            <textarea id="frm_question" cols="40" rows="5" name="frm_question" required></textarea>        
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="frm_fio" class="required">Как вас зовут? <span class="required">*</span></label>
                        <div class="controls controls-row">
                            <input class="span5" name="frm_fio" id="frm_fio" type="text" maxlength="255" value="" required autocomplete="on" />
                        </div>    
                    </div>
                    <div class="control-group">
                        <label for="frm_email" class="required">Электронная почта <span class="required">*</span></label>
                        <div class="controls controls-row">
                            <input class="span5" name="frm_email" id="frm_email" type="email" maxlength="255" value="" required autocomplete="on" />
                        </div>    
                    </div>
                    <input class="workplace" name="frm_workplace" id="frm_workplace" type="text" maxlength="10" value="" />
                </fieldset>
            </form>
        </div>
        <?php
        $cs = Yii::app()->getClientScript();
        $cs->registerScriptFile(Yii::app()->theme->baseUrl . '/js/jquery.validate.min.js', CClientScript::POS_END);
        $cs->registerScriptFile(Yii::app()->theme->baseUrl . '/js/messages_ru.js', CClientScript::POS_END);
        $cs->registerScriptFile(Yii::app()->theme->baseUrl . '/js/jquery-ui.js', CClientScript::POS_END);
        $cs->registerScriptFile(Yii::app()->theme->baseUrl . '/js/nivo-slider/nivo.slider.pack.js', CClientScript::POS_END);
        $cs->registerScriptFile(Yii::app()->theme->baseUrl . '/js/f.js', CClientScript::POS_END);
        ?>
    </body>
</html>