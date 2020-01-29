@php
use App\Components\MenuHelper as Menu;
use App\Components\InfoblockHelper as IB;
use App\Components\ServiceHelper;
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Продвижение и раскрутка в соц. сетях от 6 000 руб.</title>
    <link rel="icon" href="/favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <!-- Bootstrap core CSS -->
    <link href="/bootstrap/css/theme.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="/css/style.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/typicons/2.0.7/typicons.min.css">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!--<link rel="stylesheet" href="assets/css/styles.min.css">-->
    <link rel="stylesheet" href="/assets/css/pushy.css">
    <link rel="stylesheet" href="/assets/css/masonry.css">
    <link rel="stylesheet" href="/assets/css/animate.css">
    <link rel="stylesheet" href="/assets/css/magnific-popup.css">
    <!-- Yandex.Metrika counter -->
    <script src="/js/main.js"></script>
    <noscript><div><img src="https://mc.yandex.ru/watch/49896190" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
    <!-- /Yandex.Metrika counter -->
</head>
<body>
<nav class="pushy pushy-left">
    {{ Menu::getMenu() }}
</nav>

<!-- Site Overlay -->
<div class="site-overlay"></div>

<header id="home">
    <div class="container-fluid">
        <!-- change the image in style.css to the class header .container-fluid [approximately row 50] -->
        <div class="row-menu topblock">
            <div class="container">
                <div class="col-md-10 head-btn">
                    <div class="menu-btn" style="display: none;"><span class="hamburger">&#9776;</span></div>
                    <nav class="pushy-main">
                        {{ Menu::getMenu() }}
                    </nav>
                </div>
                <div class="col-md-2 text-right head-contacts">
                    <div class="email">{!! IB::get('email') !!}</div>
                    <div class="tel">8-913-383-82-79 <span style="font-size: 10px;">WhatsApp</span></div>
                    <a class="tel-mobile" style="display: none;" href="tel:+79133838279">тел. 8-913-383-82-79</a>
                </div>
            </div>
        </div>
        <div class="container header">
            <div class="jumbotron">
                <div class="small-title">Реклама в социальных сетях.<br>Живые участники в группу</div>
                <div class="big-title">Администрирование и ведение групп</div>
            </div>
            <div class="emailform">
                <div class="social-top">
                    <div class="social-title-top">Следите за нами в соц. сетях</div>
                    <div class="social-icons">
                        <a href="https://www.instagram.com/elena_musonova/" target="_blank" class="insta-social-link-top"><div class="insta-social"></div></a>
                        <a href="https://vk.com/effectiv_group" target="_blank" class="vk-social-link-top"><div class="vk-social"></div></a>
                    </div>
                </div>
                <div class="emailform-title">ЗАКАЗАТЬ</div>
                <div class="emailform-subtitle">продвижение сегодня</div>
                <div class="emailform-subtitle" id="form-message-main"></div>
                <form method="POST" class="ajax-form-main">
                    <select id="service-form-main" name="service" class="checked-main form-control-select-main margin-top">
                        <option value="0">Выберите услугу*</option>
                        <option value="1">Продвижение Вконтакте</option>
                        <option value="2">Продвижение Инстаграм</option>
                        <option value="3">Живые участники в группу ВК</option>
                        <option value="4">Создание сайта</option>
                    </select>
                    <input type="text" id="site-form-main" name="site" class="form-control margin-top" placeholder="Есть ли у Вас сайт? Укажите ссылку">
                    <input type="text" id="tel-form-main" name="tel" class="checked-main form-control margin-top" placeholder="Телефон*">
                    <input type="text" id="email-form-main" name="email" class="checked-main form-control margin-top" placeholder="E-mail*">
                    <input type="text" id="group-form-main" name="group" class="form-control margin-top" placeholder="Укажите ссылку на Вашу группу">
                    <input type="text" id="comm-form-main" name="comm" class="form-control margin-top" placeholder="Комментарий">
                    <input type="submit" class="btn btn-danger margin-top" value="ЗАКАЗАТЬ!">
                </form>
            </div>
        </div>
    </div>
</header>
<section id="feat">
    <div class="container">
        <div class="row features">
            <h2 class="ownh2 wow fadeInUp" data-wow-delay="100ms">Мы предлагаем</h2>
            <div class="col-md-3 text-center wow fadeInUp" data-wow-delay="100ms">
                <span class="typcn typcn-video x3 iconcolor"></span>
                <h4>Продвижение в TikTok</h4>
            </div>
            <div class="col-md-3 text-center wow fadeInUp" data-wow-delay="300ms">
                <span class="typcn typcn-social-instagram x3 iconcolor"></span>
                <h4>Ведение аккаунта Инстаграм</h4>
            </div>
            <div class="col-md-3 text-center wow fadeInUp" data-wow-delay="500ms">
                <span class="typcn typcn-chart-line x3 iconcolor"></span>
                <h4>Живые участники в группу ВК</h4>
            </div>
            <div class="col-md-3 text-center wow fadeInUp" data-wow-delay="500ms">
                <span class="typcn typcn-group x3 iconcolor"></span>
                <h4>Ведение групп Вконтакте</h4>
            </div>
        </div>
    </div>
</section>
{{ ServiceHelper::getServices() }}
<section id="comment-group" class="commentback wow fadeInUp" data-wow-delay="300ms">
    <!-- change the image in style.css to the class .number .container-fluid [approximately row 102] -->
    <div class="container">
        <div class="row">
            <div class="section-title">
                <h3 class="section-title-h3">Отзывы по продвижению</h3>
            </div>
            <div class="col-md-4">
                <div class="avatar">
                    <img src="/images/ava1.png">
                </div>
                <div class="comment">
                    Благодарю за успешное развитие моей группы Детская обувь Башмачок.
                    Группа была создана с нуля, заполнены фотоальбомы с сайта, раздел Товары, проведен розыгрыш.
                    За месяц в группу вступили 220 человек целевой аудитории из Новосибирска. Посты в группе оформлялись регулярно с учетом интересов аудитории.
                </div>
                <div class="name-and-date">
                    <div class="comment-name">
                        Анатолий Ионов
                    </div>
                    <div class="comment-date">
                        17 янв 2016
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="avatar">
                    <img src="/images/ava2.png">
                </div>
                <div class="comment">
                    Хочу сказать большое спасибо Елене, администратору моей группы Доставка суши пиццы Студия Вкуса.
                    Я обратилась к Елене по рекомендации моего коллеги, с которым они до этого уже успешно работали.
                    И ни разу не пожалела о своем решении. Работаем вместе уже больше года, посты в группе выкладываются регулярно,
                    и реклама наборов суши и развлекательные. Группа заметно оживилась, выросло количество участников.
                    А самое главное через группу приходят клиенты. Будем продолжать сотрудничество и дальше, работы Елены меня устраивает на все 100%!
                </div>
                <div class="name-and-date">
                    <div class="comment-name">
                        Лилия Мамедова
                    </div>
                    <div class="comment-date">
                        12 мая 2018
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="avatar">
                    <img src="/images/ava3.png">
                </div>
                <div class="comment">
                    Елена, хочу сказать спасибо большое за вашу работу. Все с вами легко и просто. Вы профессионал своего дела,
                    на вас можно полностью положишься и доверить ведение группы. Со знанием дела и правильным подходом. Приятно,
                    что есть действительно такие люди, которые не только обещают, но и делают. Надеюсь наше с вами сотрудничество
                    продлится годами и будет продуктивным.
                </div>
                <div class="name-and-date">
                    <div class="comment-name">
                        Вера Щербина
                    </div>
                    <div class="comment-date">
                        16 мая 2018
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="more-comment">Больше отзывов о продвижении Вы сможете найти в нашей группе Вконтакте</div>
            <div class="comment-link"><a href="https://vk.com/effectiv_group">vk.com/effectiv_group</a></div>
        </div>
    </div>
</section>
<section id="photos" class="whiteback wow fadeInUp" data-wow-delay="300ms">
    <div class="container">
        <div class="row">
            <div class="section-title">
                <h3 class="section-title-h3">Сертификаты</h3>
            </div>
            <div class="masonry image-gallery">
                <div class="grid-sizer"></div>
                <div class="gutter-sizer"></div>
                <div class="item">
                    <a href="/images/sert1.jpg">
                        <img src="/images/sert1_mini.jpg" alt="" />
                    </a>
                </div>
                <div class="item">
                    <a href="/images/sert2.jpg">
                        <img src="/images/sert2_mini.jpg" alt="" />
                    </a>
                </div>
                <div class="item">
                    <a href="/images/sert3.jpg">
                        <img src="/images/sert3_mini.jpg" alt="" />
                    </a>
                </div>
                <div class="item">
                    <a href="/images/sert5.jpg">
                        <img src="/images/sert5.jpg" alt="" />
                    </a>
                </div>
                <div class="item">
                    <a href="/images/sert4.jpg">
                        <img src="/images/sert4_mini.jpg" alt="" />
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="contact" class="prefooter wow fadeInUp" data-wow-delay="300ms">
    <!-- change the image in style.css to the class .prefooter .container-fluid [approximately row 154] -->
    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <h3 class="myh3">Если Вас заинтересовали наши услуги, мы всегда на связи!</h3>
                    <p>Заполните анкету прямо сейчас и мы обязательно свяжемся с Вами, чтобы предложить наилучший вариант развития Вашего проекта.</p>
                    <div class="row">
                        <div class="col-md-6">
                            <a href="#iw-modal" class="btn btn-danger iw-modal-btn">ЗАКАЗАТЬ</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h3 class="myh3">Администрирование и продвижение в социальных сетях</h3>
                <p>© <span class="footer-year"><?php echo date('Y'); ?></span> Администрирование и продвижение в социальных сетях</p>
            </div>
            <div class="col-md-4">
                <div class="social">
                    <div class="social-title">Следите за нами в соц. сетях</div>
                    <a href="https://www.instagram.com/elena_musonova/" target="_blank" class="insta-social-link"><div class="insta-social"></div></a>
                    <a href="https://vk.com/effectiv_group" target="_blank" class="vk-social-link"><div class="vk-social"></div></a>
                </div>
            </div>
        </div>
    </div>
</footer>
<!---Разметка для модального окна---->
<div id="iw-modal" class="iw-modal">
    <div class="iw-modal-wrapper">
        <div class="iw-CSS-modal-inner">
            <div class="iw-modal-header">
                <h3 class="iw-modal-title">Закажите прямо сейчас!</h3>
                <a href="#close" title="Закрыть" class="iw-close">x</a>
            </div>
            <div class="iw-modal-text">
                <div class="emailform-subtitle" id="form-message"></div>
                <form class="ajax-form" method="POST">
                    <select id="service-form" name="service" class="checked form-control-select margin-top">
                        <option value="0">Выберите услугу*</option>
                        <option value="1">Продвижение Вконтакте</option>
                        <option value="2">Продвижение Инстаграм</option>
                        <option value="3">Реклама Яндекс.Директ</option>
                        <option value="4">Создание сайта</option>
                    </select>
                    <input type="text" id="site-form" name="site" class="form-control margin-top" placeholder="Есть ли у Вас сайт? Укажите ссылку">
                    <input type="text" id="tel-form" name="tel" class="checked form-control margin-top" placeholder="Телефон*">
                    <input type="text" id="email-form" name="email" class="checked form-control margin-top" placeholder="E-mail*">
                    <input type="text" id="group-form" name="group" class="form-control margin-top" placeholder="Укажите ссылку на Вашу группу">
                    <input type="text" id="comm-form" name="comm" class="form-control margin-top" placeholder="Комментарий">
                    <input type="submit" class="btn btn-danger margin-top" value="ЗАКАЗАТЬ!">
                </form>
            </div>
        </div>
    </div>
</div>
<!---end.Разметка для модального окна---->
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="/assets/js/jquery.min.js"></script>
<script src="/bootstrap/js/bootstrap.min.js"></script>
<script src="/assets/js/bootstrap-scrollspy.min.js"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="/assets/js/masonry.pkgd.min.js"></script>
<script src="/assets/js/scripts.min.js"></script>
<script src="/assets/js/scripts.js"></script>
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });

    $('.hidetext').readmore({ //вызов плагина
        speed: 500, //скорость анимации показать скрыть текст
        collapsedHeight: 400, //высота блока краткого текста в px
        moreLink: '<a href="#" class="btn btn-default">Подробнее</a>', //Ссылка на раскрытие блока
        lessLink: '<a href="#" class="btn btn-default">Скрыть</a>' //Ссылка на скрытие блока
    });

    $('.iw-close').click(function () {
        $('#form-message').html('');
    });

    //Работа Попап окна
    $('.ajax-form').find('.checked').addClass('empty_field');
    $(function() {
        $('.ajax-form').submit(function (e) {
            const form = $(this);
            form.find('.checked').each(function(){
                if($(this).val() != 0 && $(this).val().length != 0){
                    // Если поле не пустое удаляем класс-указание
                    $(this).removeClass('empty_field');
                } else {
                    // Если поле пустое добавляем класс-указание
                    $(this).addClass('empty_field');
                }
            });
            var sizeEmpty = form.find('.empty_field').size();
            if (sizeEmpty === 0) {
                $.ajax({
                    url: 'sendmail.php',
                    type: "POST",
                    cache: false,
                    data: {
                        service: $('#service-form').val(),
                        site: $('#site-form').val(),
                        tel: $('#tel-form').val(),
                        email: $('#email-form').val(),
                        group: $('#group-form').val(),
                        comm: $('#comm-form').val()
                    },
                    success: function (msg) {
                        if (msg == 'ok') {
                            $('#form-message').html('Ваша анкета успешно отправлена! В ближайшее время мы с Вами свяжемся!');
                            form.find('.form-control').each(function(){
                                $(this).val("");
                            });
                            $('.form-control-select').val(0);
                        }
                    }
                });
            } else {
                $('#form-message').html('Заполните обязательные поля!');
                return false;
            }
            return false;
        });
    });

    //Работа основной формы
    $('.ajax-form-main').find('.checked-main').addClass('empty_field_main');
    $(function() {
        $('.ajax-form-main').submit(function (e) {
            const form = $(this);
            form.find('.checked-main').each(function(){
                if($(this).val() != 0 && $(this).val().length != 0){
                    // Если поле не пустое удаляем класс-указание
                    $(this).removeClass('empty_field_main');
                } else {
                    // Если поле пустое добавляем класс-указание
                    $(this).addClass('empty_field_main');
                }
            });
            var sizeEmpty = form.find('.empty_field_main').size();
            if (sizeEmpty === 0) {
                $.ajax({
                    url: 'sendmail.php',
                    type: "POST",
                    cache: false,
                    data: {
                        service: $('#service-form-main').val(),
                        site: $('#site-form-main').val(),
                        tel: $('#tel-form-main').val(),
                        email: $('#email-form-main').val(),
                        group: $('#group-form-main').val(),
                        comm: $('#comm-form-main').val()
                    },
                    success: function (msg) {
                        if (msg == 'ok') {
                            $('#form-message-main').html('Ваша анкета успешно отправлена! В ближайшее время мы с Вами свяжемся!');
                            form.find('.form-control').each(function(){
                                $(this).val("");
                            });
                            $('.form-control-select-main').val(0);
                        }
                    }
                });
            } else {
                $('#form-message-main').html('Заполните обязательные поля!');
                return false;
            }
            return false;
        });
    });

    $(function(){
        $("#tel-form").mask("8(999) 999-9999");
    });
    $(function(){
        $("#tel-form-main").mask("8(999) 999-9999");
    });

</script>
<script type="text/javascript" src="https://vk.com/js/api/openapi.js?159"></script>
<!-- VK Widget -->
<div id="vk_community_messages"></div>
<script type="text/javascript">
    VK.Widgets.CommunityMessages("vk_community_messages", 72307279, {expandTimeout: "10000",disableExpandChatSound: "1",tooltipButtonText: "Здравствуйте! Есть вопросы? Пишите!"});
</script>
</body>
</html>
