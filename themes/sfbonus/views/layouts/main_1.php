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
        <div class="ads-box">
            <div id="tabs">
<!--                <ul class="tabs-title inl-blck wrapper-in">
                    <li><a href="#formula-box">Формула успеха в программе</a></li>
                </ul>-->
                <div id="formula-box" class="formula-box tab">
                    <div class="formula-limiter">
                        <img class="mask l-side" src="<?php echo Yii::app()->theme->baseUrl; ?>/images/formula/mask-l.png" alt=""/>
                        <ul id="formula" class="inl-blck formula">
                            <li class="card">
                                <figure>
                                    <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/formula/card.png" alt="" />
                                    <figcaption>Бонусная карта <a href="./about.html">Подсолнух</a></figcaption>
                                </figure>
                            </li>
                            <li class="sign equally">
                                <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/formula/equally.png" alt="" />
                            </li>
                            <li class="buy">
                                <figure>
                                    <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/formula/buy.png" alt="" />
                                    <figcaption>Совершайте свои привычные покупки в магазинах <a href="./partners.html">Партнерах</a> программы Подсолнух</figcaption>
                                </figure>
                            </li>
                            <li class="sign plus">
                                <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/formula/plus.png" alt="" />
                            </li>
                            <li class="bonuses">
                                <figure>
                                    <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/formula/bonuses.png" alt="" />
                                    <figcaption>Получайте за это бонусные баллы на карту Подсолнух</figcaption>
                                </figure>
                            </li>
                            <li class="sign plus">
                                <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/formula/plus.png" alt="" />
                            </li>
                            <li class="ruble">
                                <figure>
                                    <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/formula/bonus-ruble.png" alt="" />
                                    <figcaption>Каждый балл &mdash; это рубль</figcaption>
                                </figure>
                            </li>
                            <li class="sign plus">
                                <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/formula/plus.png" alt="" />
                            </li>
                            <li class="spend-points">
                                <figure>
                                    <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/formula/spend-points.png" alt="" />
                                    <figcaption>Тратьте бонусные баллы в магазинах <a href="./partners.html">Партнерах</a> программы Подсолнух</figcaption>
                                </figure>
                            </li>
                            <li class="sign plus">
                                <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/formula/plus.png" alt="" />
                            </li>
                            <li class="discounts">
                                <figure>
                                    <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/formula/discounts.png" alt="" />
                                    <figcaption>Для владельцев карт &mdash; <a href="./special-offers.html">специальные предложения</a></figcaption>
                                </figure>
                            </li>
                        </ul>
                        <div id="scroll-bar" class="scroll-bar">
                            <div class="scroll-bar-line"></div>
                        </div>
                        <img class="mask r-side" src="<?php echo Yii::app()->theme->baseUrl; ?>/images/formula/mask-r.png" alt=""/>
                    </div>
                </div>
            </div>
        </div>
        <div id="b" class="wrapper-in">
            <ul class="banners-list inl-blck">
                <li>
                    <div class="frame">
                        <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="207" height="99">
                            <param name="movie" value="<?php echo Yii::app()->theme->baseUrl; ?>/banners/for-clients.swf?link=about/kak-stat-uchastnikom.html" />
                            <!--[if !IE]>-->
                            <object type="application/x-shockwave-flash" data="<?php echo Yii::app()->theme->baseUrl; ?>/banners/for-clients.swf?link=about/kak-stat-uchastnikom.html" width="207" height="99">
                            <!--<![endif]-->
                                <a href="./about/kak-stat-uchastnikom.html"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/banners/for-clients.jpg" alt="Стань участником программы Подсолнух!" /></a>
                            <!--[if !IE]>-->
                            </object>
                            <!--<![endif]-->
                        </object>
                    </div>
                </li>
                <li>
                     <div class="frame">
                        <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="207" height="99">
                            <param name="movie" value="<?php echo Yii::app()->theme->baseUrl; ?>/banners/for-partners.swf?link=about/kak-stat-partnerom.html" />
                            <!--[if !IE]>-->
                            <object type="application/x-shockwave-flash" data="<?php echo Yii::app()->theme->baseUrl; ?>/banners/for-partners.swf?link=about/kak-stat-partnerom.html" width="207" height="99">
                            <!--<![endif]-->
                                <a href="./about/kak-stat-partnerom.html"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/banners/for-partners.jpg" alt="Стань партнером программы Подсолнух!" /></a>
                            <!--[if !IE]>-->
                            </object>
                            <!--<![endif]-->
                        </object>
                    </div>
                </li>
                <li>
                    <div class="frame">
                        <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="207" height="99">
                            <param name="movie" value="<?php echo Yii::app()->theme->baseUrl; ?>/banners/for-clients.swf?link=about/kak-stat-uchastnikom.html" />
                            <!--[if !IE]>-->
                            <object type="application/x-shockwave-flash" data="<?php echo Yii::app()->theme->baseUrl; ?>/banners/for-clients.swf?link=about/kak-stat-uchastnikom.html" width="207" height="99">
                            <!--<![endif]-->
                                <a href="./about/kak-stat-uchastnikom.html"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/banners/for-clients.jpg" alt="Стань участником программы Подсолнух!" /></a>
                            <!--[if !IE]>-->
                            </object>
                            <!--<![endif]-->
                        </object>
                    </div>
                </li>
                <li>
                     <div class="frame">
                        <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="207" height="99">
                            <param name="movie" value="<?php echo Yii::app()->theme->baseUrl; ?>/banners/for-partners.swf?link=about/kak-stat-partnerom.html" />
                            <!--[if !IE]>-->
                            <object type="application/x-shockwave-flash" data="<?php echo Yii::app()->theme->baseUrl; ?>/banners/for-partners.swf?link=about/kak-stat-partnerom.html" width="207" height="99">
                            <!--<![endif]-->
                                <a href="./about/kak-stat-partnerom.html"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/banners/for-partners.jpg" alt="Стань партнером программы Подсолнух!" /></a>
                            <!--[if !IE]>-->
                            </object>
                            <!--<![endif]-->
                        </object>
                    </div>
                </li>
            </ul>
            <section class="about">
                <div class="clear"></div>
                <img class="flt-left r-x-margin" src="<?php echo Yii::app()->theme->baseUrl; ?>/photos/bonus-cards.png" alt="Бонусная карта Подсолнух" />
                <h1 class="t-v-margin">О програме &quot;Подсолнух&quot;</h1>
                <p>&quot;Подсолнух&quot; &ndash; это накопительная программа для всей семьи. Покупайте, как обычно, любые товары и услуги у всех компаний-партнеров программы. Предъявляйте карту &quot;Подсолнух&quot; перед оплатой товаров и услуг, на Ваш счет будет зачислено определенное количество баллов в соответствии с Правилами Программы. Собирайте баллы на карту &quot;Подсолнух&quot; всей семьей. Участвуйте в специальных предложениях и получайте дополнительные балы.</p>
                <div class="clear"></div>
            </section>
            <div class="clear"></div>
        </div>
        <section class="partners ftr-indent">
            <h1 class="wrapper-in">Партнеры программы</h1>
            <div class="hr"></div>
            <ul class="pics inl-blck ftr-indent wrapper-in">
                <li>
                    <a href="./partners.html"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/photos/partners/dagenergobank.png" alt="" /></a>
                </li>
            </ul>
        </section>
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