<!DOCTYPE html>
<html lang="ar-AR">
<head>
    <meta charset="utf-8">
    <title><?= $title ?></title>
    <!-- jQuery -->
    <script src="<?= base_url() ?>assets/js/jquery-1.9.1.min.js"></script>

    <!-- bootstrap + theme + rtl support -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/bootstrap-3.3.6/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="<?= base_url() ?>assets/bootstrap-3.3.6/css/bootstrap-theme.min.css"/>
    <link rel="stylesheet" href="<?= base_url() ?>assets/bootstrap-3.3.6/css/bootstrap-rtl.min.css"/>
    <script src="<?= base_url() ?>assets/bootstrap-3.3.6/js/bootstrap.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="Shortcut Icon" href="http://1carsyria.net/files/favicons/favicon-cog.ico" type="image/x-icon"/>

    <!-- jQuery form (ajax forms) -->
    <script src="<?= base_url() ?>assets/js/jquery.form.js"></script>
    <!-- custom js -->

    <script> var seg1 = "<?=$segment1?>"; </script>

    <!-- font awesome / icons -->
    <link rel='stylesheet' href='<?= base_url() ?>assets/font-awesome-4.6.1/css/font-awesome.min.css' type='text/css'/>
    <!-- themify-icons -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/themify-icons/themify-icons.css">
    <!--[if lt IE 8]><!-->
    <link rel="stylesheet" href="<?= base_url() ?>assets/themify-icons/ie7/ie7.css">
    <!--<![endif]-->

    <!-- auto-grow textarea -->
    <script src="<?= base_url() ?>assets/js/autoGrowTextarea.js"></script>
    <script> var base_url = '<?=base_url()?>'; </script>

    <!-- custom css -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/control.css"/>
    <!-- common css -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/common.css"/>

    <!-- custom js -->
    <script src="<?= base_url() ?>assets/js/myscript.js"></script>

    <!-- مكتبة مؤثرات حركية -->
    <!-- https://daneden.github.io/animate.css/ المصدر -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/animate.min.css"/>

    <!-- إضافة جي كويري لعرض التاريخ بصيغة (منذ ... مضت) -->
    <script src="<?= base_url() ?>assets/js/jquery.timeago.js"></script>
    <script src="<?= base_url() ?>assets/js/jquery.timeago.ar.js"></script>
    <script type="text/javascript">
        jQuery(document).ready(function () {
            $("time.timeago").timeago();
        });
    </script>

</head>
<body>
<div class="container-fluid no-padding">
    <div class="row no-margin">
        <nav class="navbar navbar-inverse no-border-radius no-margin">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                            data-target="#bs-example-navbar-collapse-9" aria-expanded="false"><span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#"><i class="ti-settings"></i> لوحة التحكم</a></div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-9">
                    <ul class="nav navbar-nav">
                        <li><a href="<?= base_url() ?>"><i class="ti-home"></i> رئيسية الموقع</a></li>
                        <!-- إذا كان المدير مسجلاً دخوله -->
                        <? if ($this->session->logged_in) { ?> 
                            <li>
                                <a href="#" data-toggle="tooltip" data-placement="bottom"
                                   title="آخر دخول: <?= $this->session->user_last_login ?>">
                                    <i class="ti-user"></i> <?= $this->session->user_name ?> </a>


                            </li>
                        <? } ?>
                        <li><a href="<?= base_url() ?>control/logout"><i class="ti-share-alt"></i> خروج</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>


    <div class="row no-margin">
        <div id="controlPanelMenu" class="col-md-2 col-sm-1 control-list-col fullHeight">
            <div class="list-group rtl">

                <!--   أقسام لوحة التحكم    -->

                <a href="<?= base_url() ?>control" data-cat="index"
                   class="list-group-item no-border-radius ">
                    <i class="ti-bar-chart"></i>
                    <span class="rightMenuText">الرئيسة</span>
                    <i class="ti-angle-left pull-left"></i>
                </a>

                <a href="<?= base_url() ?>control/food_categories" data-cat="food_categories"
                   class="cPanelMenuAnchor list-group-item no-border-radius">
                    <i class="fa fa-cutlery"></i>
                    <span class="rightMenuText">تصنيفات الأغذية </span>
                    <i class="ti-angle-left pull-left"></i>
                </a>

                <a href="<?= base_url() ?>control/food_stuffs" data-cat="food_stuffs,edit_food_stuff"
                   class=" list-group-item no-border-radius">
                    <i class="ti-apple"></i>
                    <span class="rightMenuText">المواد الغذائية</span>
                    <i class="ti-angle-left pull-left"></i>
                </a>

                <a href="<?= base_url() ?>control/parts" data-cat="parts"
                   class="list-group-item no-border-radius">
                    <i class="ti-view-list"></i>
                    <span class="rightMenuText">أقسام الموقع</span>
                    <i class="ti-angle-left pull-left"></i>
                </a>

                <a href="<?= base_url() ?>control/posts" data-cat="posts,edit_post"
                   class="list-group-item no-border-radius">
                    <i class="ti-pencil-alt"></i>
                    <span class="rightMenuText">المقالات</span>
                    <? if ($new_posts) { ?>
                        <span id="new_posts" class="badge"><?=$new_posts?></span>
                    <? } else { ?>
                        <i class="ti-angle-left pull-left"></i>
                    <? } ?>
                </a>

                <a href="<?= base_url() ?>control/comments" data-cat="comments"
                   class="list-group-item no-border-radius">
                    <i class="ti-comments"></i>
                    <span class="rightMenuText">التعليقات</span>
                    <? if ($new_comments) { ?>
                        <span id="new_comments" class="badge"><?=$new_comments?></span>
                    <? } else { ?>
                        <i class="ti-angle-left pull-left"></i>
                    <? } ?>
                </a>

                <a href="<?= base_url() ?>control/pages" data-cat="pages"
                   class="list-group-item no-border-radius">
                    <i class="ti-files"></i>
                    <span class="rightMenuText">الصفحات</span>
                    <i class="ti-angle-left pull-left"></i>
                </a>

                <a href="<?= base_url() ?>control/users" data-cat="users,edit_user"
                   class="list-group-item no-border-radius">
                    <i class="ti-user"></i>
                    <span class="rightMenuText">الأعضاء</span>
                    <i class="ti-angle-left pull-left"></i>
                </a>

                <a href="<?= base_url() ?>control/options" data-cat="options"
                   class="cPanelMenuAnchor list-group-item no-border-radius">
                    <i class="fa fa-cogs"></i>
                    <span class="rightMenuText">إعدادات</span>
                    <i class="ti-angle-left pull-left"></i>
                </a>


            </div>

        </div>
        <div class="col-md-10 col-sm-11" id="controlPanelContent">

