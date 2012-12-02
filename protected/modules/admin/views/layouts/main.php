<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content=""/>
        <meta name="description" content=""/>
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap.css" />
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/js/jScrollPane/jScrollPane.css" />
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" />
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    </head>
    <body>
        <span id="top">&nbsp;</span>
        <div id="mainMenuBox" class="navbar navbar-inverse navbar-fixed-top bt-shdw">
            <div class="navbar-inner">
                <?php if( ! Yii::app()->user->isGuest ): ?>
                <ul class="nav main">
                    <li class="sitemap dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"></a>
                        <ul class="dropdown-menu">
                            <li>
                                <strong class="title">Карта сайта</strong>
                                <ul id="sm-box" class="inl-blck">
                                    <li>
                                        <a href="#">О компании</a>
                                        <ul>
                                            <li><a href="#">История</a></li>
                                            <li><a href="#">Руководство</a></li>
                                            <li><a href="#">Структура подразделений</a></li>
                                            <li><a href="#">Пресса</a></li>
                                            <li><a href="#">Контакты</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#">Частным клиентам</a>
                                        <ul>
                                            <li><a href="#">Вклады</a></li>
                                            <li><a href="#">Кредиты</a></li>
                                            <li><a href="#">Банковские карты</a></li>
                                            <li><a href="#">Денежные переводы</a></li>
                                            <li><a href="#">Текущие счета</a></li>
                                            <li><a href="#">Валютное обслуживание</a></li>
                                            <li><a href="#">Сейфовые ячейки</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#">Юридическим лицам</a>
                                        <ul>
                                            <li><a href="#">Расчетно-кассовое обслуживание</a></li>
                                            <li><a href="#">Кредиты</a></li>
                                            <li><a href="#">Банковские карты</a></li>
                                            <li><a href="#">Денежные переводы</a></li>
                                            <li><a href="#">Текущие счета</a></li>
                                            <li><a href="#">Валютное обслуживание</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#">Помощь</a>
                                        <ul>
                                            <li><a href="#">Служба поддержки</a></li>
                                            <li><a href="#">FAQ</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#">О нас</a>
                                        <ul>
                                            <li><a href="#">История</a></li>
                                            <li><a href="#">Руководство</a></li>
                                            <li><a href="#">Структура подразделений</a></li>
                                            <li><a href="#">Пресса</a></li>
                                            <li><a href="#">Реквизиты</a></li>
                                            <li><a href="#">Контакты</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#">О компании</a>
                                        <ul>
                                            <li><a href="#">История</a></li>
                                            <li><a href="#">Руководство</a></li>
                                            <li><a href="#">Структура подразделений</a></li>
                                            <li><a href="#">Пресса</a></li>
                                            <li><a href="#">Контакты</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#">Частным клиентам</a>
                                        <ul>
                                            <li><a href="#">Вклады</a></li>
                                            <li><a href="#">Кредиты</a></li>
                                            <li><a href="#">Банковские карты</a></li>
                                            <li><a href="#">Денежные переводы</a></li>
                                            <li><a href="#">Текущие счета</a></li>
                                            <li><a href="#">Валютное обслуживание</a></li>
                                            <li><a href="#">Сейфовые ячейки</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li><a href="#">Баннеры</a></li>
                    <li><a href="#">Настройки</a></li>
                    <li><a href="#">Пользователи</a></li>
                </ul>
                <ul class="user nav pull-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Admin <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Настройки</a></li>
                            <li class="divider"></li>
                            <li><a href="#">Выход</a></li>
                        </ul>
                    </li>
                </ul>
                <?php endif; ?>
            </div>
        </div>
        <div id="b" class="container-fluid">
            <?php echo $content; ?>
        </div>
        <footer id="f">
            
        </footer>
    </body>
</html>