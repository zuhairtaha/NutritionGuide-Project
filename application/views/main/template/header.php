<!DOCTYPE html>
<html lang="ar-AR">
<head>
    <meta charset="utf-8">
    <title>
        <?
        $T = $title != null ? $title : $options[0]->site_name;
        echo $T;
        ?>
    </title>
    <!-- jQuery مكتبة جي كويري -->
    <script src="<?= base_url() ?>assets/js/jquery-1.9.1.min.js"></script>

    <!-- slick slider مكتبة سلايدشو أفقي -->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/slick/slick-theme.css"/>

    <!-- bootstrap + theme + rtl support -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/bootstrap-3.3.6/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="<?= base_url() ?>assets/bootstrap-3.3.6/css/bootstrap-theme.min.css"/>
    <link rel="stylesheet" href="<?= base_url() ?>assets/bootstrap-3.3.6/css/bootstrap-rtl.min.css"/>
    <script src="<?= base_url() ?>assets/bootstrap-3.3.6/js/bootstrap.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- jQuery form (ajax forms) مكتبة تعتمد على جي كويري لتفعيل الأجاكس على النماذج (فورم -->
    <script src="<?= base_url() ?>assets/js/jquery.form.js"></script>
    <!-- custom js -->

    <!-- font awesome / icons مكتبة أيقونات الخطوط الشهيرة -->
    <link rel='stylesheet' href='<?= base_url() ?>assets/font-awesome-4.6.1/css/font-awesome.min.css' type='text/css'/>

    <!-- themify-icons مكتبة أيقونات خطوط -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/themify-icons/themify-icons.css">

    <!--[if lt IE 8]><!-->
    <link rel="stylesheet" href="<?= base_url() ?>assets/themify-icons/ie7/ie7.css">
    <!--<![endif]-->

    <!-- auto-grow textarea -->
    <script src="<?= base_url() ?>assets/js/autoGrowTextarea.js"></script>
    <script> var base_url = '<?=base_url()?>'; </script>

    <!-- custom css -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/welcome.css"/>
    <!-- common css -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/common.css"/>

    <!-- custom js -->
    <script src="<?= base_url() ?>assets/js/myscript.js"></script>

    <!-- مكتبة مؤثرات حركية -->
    <!-- https://daneden.github.io/animate.css/ المصدر -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/animate.min.css"/>


    <!-- أيقونة الموقع -->
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url() ?>assets/img/home_favicon.ico">

    <!-- مؤثرات حركية عند مرور الماوس على الصور -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/set1.css"/>


    <!-- إضافة جي كويري لعرض التاريخ بصيغة (منذ ... مضت) -->
    <script src="<?= base_url() ?>assets/js/jquery.timeago.js"></script>
    <script src="<?= base_url() ?>assets/js/jquery.timeago.ar.js"></script>
    <script type="text/javascript">
        jQuery(document).ready(function () {
            $("time.timeago").timeago();
        });
    </script>
    <!-- RSS feed -->
    <link rel="alternate" type="application/rss+xml" title="" href="<?= base_url() ?>rss"/>
    <meta name="google-site-verification" content="f8gqqGjaGb5-VI6mmY-iptd_D8yuElBC7TF9TC3ehxQ" />
</head>
<body>


<div class="container main-container">
    <!-- شريط العضويات -->

    <div class="row">
        <nav class="navbar navbar-default no-border-radius no-margin-bottom users-navbar">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                            data-target="#users-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="users-navbar-collapse">

                    <ul class="nav navbar-nav">
                        <? if ($this->session->logged_in) { ?>

                            <li>
                                <a href="#"> أهلاً بك
                                    <i class="fa fa-user"></i> <?= $this->session->user_name ?></a>
                            </li>

                            <? if ($this->session->user_role == "admin") { ?> 
                                <li>
                                    <a target="_blank" href="<?= base_url() ?>control"><i class="fa fa-dashboard"></i>
                                        لوحة تحكم الموقع</a>
                                </li>
                            <? } // end if session->user_role=="admin" ?>

                            <!-- زر تفعيل العضوية -->
                            <? if (!$this->session->user_active): ?>
                                <li><a href="<?= base_url() ?>active_page"><i class="ti-check"></i> تفعيل عضويتك</a>
                                </li>
                            <? endif; ?>
                            <li>
                                <a href="<?= base_url() ?>logout"><i class="fa fa-sign-out"></i> تسجيل الخروج</a>
                            </li>

                        <? } else { ?>
                            <li><a id="register-new-user" href="<?= base_url() ?>register"> <i
                                        class="fa fa-user-plus"></i> تسجيل عضو جديد </a></li>
                            <li><a id="user-login-anchor" href="<?= base_url() ?>login"> <i class="fa fa-sign-in"></i>
                                    تسجيل الدخول </a></li>
                        <? } ?>
                    </ul>

                    <!-- مودال تسجيل الدخول -->
                    <div id="login_modal" class="modal fade" tabindex="-1" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header margin-bottom-0 alert alert-warning">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                            aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title"> تسجيل الدخول</h4>
                                </div>
                                <div class="modal-body">
                                    <p id="login_info"></p>

                                    <form id="login_form" class="form" method="post" accept-charset="utf-8"
                                          action="<?= base_url() ?>login">

                                        <div class="form-group">
                                            <label for="user_name"><i class="fa fa-user"></i> اسم المستخدم</label>
                                            <input type="text" placeholder="اسم المستخدم" name="user_name"
                                                   id="user_name" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label for="user_password"><i class="fa fa-key"></i> كلمة المرور</label>
                                            <input type="password" placeholder="كلمة المرور" name="user_password"
                                                   id="user_password" class="form-control">
                                        </div>

                                        <button class="btn btn-success btn-lg btn-block" type="submit"><i
                                                class="fa fa-sign-in"></i> دخول
                                        </button>


                                    </form>

                                    <p class="btn btn-link" data-toggle="modal" data-target="#myModal"><i
                                            class="ti-lock"></i> نسيت كلمة المرور </p>


                                </div>

                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->


                    <!-- مودال تسجيل الدخول -->

                    <!-- بداية مودال نسيت كلمة المرور -->
                    <div id="myModal" class="modal fade" role="dialog">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">أدخل بريدك الالكتروني ليتم إرسال كلمة المرور </h4>
                                </div>
                                <div class="modal-body">
                                    <p id="notes"></p>

                                    <form id="restPassForm" class="form" action="<?= base_url() ?>admin_login/reset"
                                          method="post">
                                        <input class="form-control" type="email" placeholder="بريدك الالكتروني"
                                               name="email1"/><br/>
                                        <button class="btn btn-primary" type="submit">
                                            <i class="glyphicon glyphicon-envelope"></i>
                                            إرسال
                                        </button>
                                    </form>


                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">إغلاق</button>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- نهاية مودال نسيت كلمة المرور -->

                    <!-- مودال البحث -->
                    <div id="search_modal" class="modal fade categoriesModal-lg" tabindex="-1" role="dialog">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header margin-bottom-0 alert alert-warning">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                            aria-hidden="true">&times;</span></button>
                                    <h4 id="searchModalTitle" class="modal-title"><i
                                            class="glyphicon glyphicon-search"></i> البحث</h4>
                                </div>
                                <div class="modal-body" id="searchModalContent">

                                    <!-- حقل البحث النصي, قائمة مكان البحث, زر البحث -->
                                    <div class="row">
                                        <div class="col-lg-12">

                                            <div class="input-group">
                                                <input id="key_search" placeholder="ضع نص البحث هنا ..." type="text"
                                                       class="form-control"
                                                       aria-label="Text input with segmented button dropdown">

                                                <div class="input-group-btn">

                                                    <button type="button" class="btn btn-default dropdown-toggle"
                                                            data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false"><span class="caret"></span> <span
                                                            class="sr-only">Toggle Dropdown</span></button>

                                                    <!-- مكان البحث : مقالات أو مواد -->
                                                    <ul id="search_section_ul" class="dropdown-menu">
                                                        <li value="search_posts"
                                                            class="active search_section_li">
                                                            <a data-search_section="posts" href="#">المقالات</a>
                                                        </li>
                                                        <li value="search_stuffs"
                                                            class="search_section_li">
                                                            <a data-search_section="stuffs" href="#">المواد الغذائية</a>
                                                        </li>
                                                    </ul>

                                                    <button id="action_search" type="button" class="btn btn-default"
                                                            aria-haspopup="true" aria-expanded="false"><i
                                                            class="fa fa-search"></i> بحث
                                                    </button>

                                                </div>

                                            </div>


                                        </div>
                                    </div><!-- /.row -->

                                    <!-- مكان  ظهور نتائج البحث -->
                                    <div class="row">
                                        <div id="search_results_div" class="col-lg-12">
                                            <!-- نتائج البحث تحمل هنا -->
                                        </div>
                                    </div>


                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->

                    <!-- نهاية مودال البحث -->


                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
        <!-- نهاية الشريط الأسود العلوي -->
    </div>


    <!-- نهاية شريط العضويات -->

    <!-- اللوغو -->
    <div class="row visible-sm visible-lg visible-md" id="logo_row">
        <a href="<?= base_url() ?>">
            <img <?= $options[0]->site_name ?>
                title="<?= $options[0]->site_name ?>"
                class="img-responsive"
                src="<?= base_url() ?>assets/img/logo.png"/>
        </a>
    </div>

    <h2 class="visible-xs logo_text"><?= $options[0]->site_name ?></h2>

    <!-- الشريط الأسود العلوي -->
    <div class="row" id="blackNav_row">
        <nav id="black_nav" class="navbar navbar-inverse no-border-radius">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                            data-target="#main-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand active" href="<?= base_url() ?>"><i class="fa fa-home"></i></a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="main-navbar-collapse">
                    <ul class="nav navbar-nav">


                        <li class="dropdown">
                            <a href="<?= base_url() ?>categories" class="dropdown-toggle" data-toggle="dropdown"
                               role="button"
                               aria-haspopup="true" aria-expanded="false"><i class="fa fa-cutlery"></i>
                                التصنيفات الغذائية <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <? foreach ($categories as $category): ?>
                                    <li>
                                        <a href="<?= base_url() ?>category/<?= $category->fc_id ?>"><?= $category->fc_title ?></a>
                                    </li>
                                <? endforeach; ?>

                            </ul>
                        </li>

                        <li class="dropdown">
                            <a href="<?= base_url() ?>parts" class="dropdown-toggle" data-toggle="dropdown"
                               role="button"
                               aria-haspopup="true" aria-expanded="false"><i class="fa fa-list"></i>
                                أقسام الموقع <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <? foreach ($parts as $part): ?>
                                    <li>
                                        <a href="<?= base_url() ?>part/<?= $part->part_id ?>"><?= $part->part_title ?></a>
                                    </li>
                                <? endforeach; ?>
                                <!-- <li role="separator" class="divider"></li> -->


                            </ul>
                        </li>

                        <!-- الصفحات -->
                        <? foreach ($pages as $page): ?>
                            <li class="visible-lg"><a href="<?= base_url() ?>page/<?= $page->page_id ?>">
                                    <i class="fa fa-file-text-o"></i> <?= $page->page_title ?></a></li>
                        <? endforeach; ?>

                        <li>
                            <a class="visible-lg" href="<?= base_url() ?>BMI"><i class="glyphicon glyphicon-heart"></i>
                                الوضع الصحي</a>
                        </li>


                        <li class="visible-lg"><a href="<?= base_url() ?>contact_us"><i
                                    class="glyphicon glyphicon-envelope"></i> اتصل
                                بنا</a></li>


                        <!-- الصفحات كقائمة منسدلة -->
                        <li class="dropdown visible-sm visible-xs">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-haspopup="true" aria-expanded="false"><i class="fa fa-file-text-o"></i>
                                الصفحات <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <? foreach ($pages as $page): ?>
                                    <li>
                                        <a href="<?= base_url() ?>page/<?= $page->page_id ?>"><?= $page->page_title ?></a>
                                    </li>
                                <? endforeach; ?>
                                <li>
                                    <a href="<?= base_url() ?>BMI"><i class="glyphicon glyphicon-heart"></i> الوضع الصحي</a>
                                </li>
                            </ul>
                        </li>


                    </ul>


                    <ul class="nav navbar-nav navbar-left">
                        <li><a id="search_modal_btn" href="#">
                                <i class="glyphicon glyphicon-search"></i> البحث
                            </a></li>
                    </ul>


                    <!-- مودال البحث -->
                    <div id="search_modal" class="modal fade categoriesModal-lg" tabindex="-1" role="dialog">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header margin-bottom-0 alert alert-warning">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                            aria-hidden="true">&times;</span></button>
                                    <h4 id="searchModalTitle" class="modal-title"><i
                                            class="glyphicon glyphicon-search"></i> البحث</h4>
                                </div>
                                <div class="modal-body" id="searchModalContent">

                                    <!-- حقل البحث النصي, قائمة مكان البحث, زر البحث -->
                                    <div class="row">
                                        <div class="col-lg-12">

                                            <div class="input-group">
                                                <input id="key_search" placeholder="ضع نص البحث هنا ..." type="text"
                                                       class="form-control"
                                                       aria-label="Text input with segmented button dropdown">

                                                <div class="input-group-btn">

                                                    <button type="button" class="btn btn-default dropdown-toggle"
                                                            data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false"><span class="caret"></span> <span
                                                            class="sr-only">Toggle Dropdown</span></button>

                                                    <!-- مكان البحث : مقالات أو مواد -->
                                                    <ul id="search_section_ul" class="dropdown-menu">
                                                        <li value="search_posts"
                                                            class="active search_section_li">
                                                            <a data-search_section="posts" href="#">المقالات</a>
                                                        </li>
                                                        <li value="search_stuffs"
                                                            class="search_section_li">
                                                            <a data-search_section="stuffs" href="#">المواد الغذائية</a>
                                                        </li>
                                                    </ul>

                                                    <button id="action_search" type="button" class="btn btn-default"
                                                            aria-haspopup="true" aria-expanded="false"><i
                                                            class="fa fa-search"></i> بحث
                                                    </button>

                                                </div>

                                            </div>


                                        </div>
                                    </div><!-- /.row -->

                                    <!-- مكان  ظهور نتائج البحث -->
                                    <div class="row">
                                        <div id="search_results_div" class="col-lg-12">
                                            <!-- نتائج البحث تحمل هنا -->
                                        </div>
                                    </div>


                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->


                    <!-- نهاية مودال البحث -->


                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
        <!-- نهاية الشريط الأسود العلوي -->
    </div> <!-- نهاية الشريط الأسود العلوي -->

