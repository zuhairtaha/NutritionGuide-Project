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
                        <? if ($this->session->logged_in_admin) { ?>
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
        <div id="controlPanelMenu" class="col-md-2 col-sm-1 col-xs-1 control-list-col fullHeight">
            <div class="list-group rtl right_control_list">

                <!--   أقسام لوحة التحكم    -->

                <a href="<?= base_url() ?>control" data-cat="index"
                   class="list-group-item no-border-radius ">
                    <i class="ti-bar-chart cpanel_part_icon"></i>
                    <span class="visible-lg visible-md ">الرئيسة</span>
                    <i class="ti-angle-left pull-left visible-lg visible-md"></i>
                </a>

                <a href="<?= base_url() ?>control/food_categories" data-cat="food_categories"
                   class="cPanelMenuAnchor list-group-item no-border-radius">
                    <i class="fa fa-cutlery cpanel_part_icon"></i>
                    <span class="visible-lg visible-md ">تصنيفات الأغذية </span>
                    <i class="ti-angle-left pull-left visible-lg visible-md"></i>
                </a>

                <a href="<?= base_url() ?>control/food_stuffs" data-cat="food_stuffs,edit_food_stuff"
                   class=" list-group-item no-border-radius">
                    <i class="ti-apple cpanel_part_icon"></i>
                    <span class="visible-lg visible-md ">المواد الغذائية</span>
                    <i class="ti-angle-left pull-left visible-lg visible-md"></i>
                </a>

                <a href="<?= base_url() ?>control/parts" data-cat="parts"
                   class="list-group-item no-border-radius">
                    <i class="ti-view-list cpanel_part_icon"></i>
                    <span class="visible-lg visible-md ">أقسام الموقع</span>
                    <i class="ti-angle-left pull-left visible-lg visible-md"></i>
                </a>

                <a href="<?= base_url() ?>control/posts" data-cat="posts"
                   class="list-group-item no-border-radius">
                    <i class="ti-pencil-alt cpanel_part_icon"></i>
                    <span class="visible-lg visible-md ">المقالات</span>
                    <i class="ti-angle-left pull-left visible-lg visible-md"></i>
                </a>

                <a href="<?= base_url() ?>control/comments" data-cat="comments"
                   class="list-group-item no-border-radius">
                    <i class="ti-comments cpanel_part_icon"></i>
                    <span class="visible-lg visible-md ">التعليقات</span>
                    <i class="ti-angle-left pull-left visible-lg visible-md"></i>
                </a>

                <a href="<?= base_url() ?>control/pages" data-cat="pages"
                   class="list-group-item no-border-radius">
                    <i class="ti-files cpanel_part_icon"></i>
                    <span class="visible-lg visible-md ">الصفحات</span>
                    <i class="ti-angle-left pull-left visible-lg visible-md"></i>
                </a>

                <a href="<?= base_url() ?>control/users" data-cat="users"
                   class="list-group-item no-border-radius">
                    <i class="ti-user cpanel_part_icon"></i>
                    <span class="visible-lg visible-md ">الأعضاء</span>
                    <i class="ti-angle-left pull-left visible-lg visible-md"></i>
                </a>

                <a href="<?= base_url() ?>control/options" data-cat="options"
                   class="cPanelMenuAnchor list-group-item no-border-radius">
                    <i class="fa fa-cogs cpanel_part_icon"></i>
                    <span class="visible-lg visible-md ">إعدادات</span>
                    <i class="ti-angle-left pull-left visible-lg visible-md"></i>
                </a>




            </div>

        </div>
        <div class="col-md-10 col-sm-11 col-xs-11 " id="controlPanelContent">

