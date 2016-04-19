<!DOCTYPE html>
<html lang="ar-AR">
<head>
    <meta charset="utf-8">
    <title>لوحة التحكم</title>
    <!-- jQuery -->
    <script src="<?= base_url() ?>assets/js/jquery-1.9.1.min.js"></script>

    <!-- bootstrap + theme + rtl support -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/bootstrap-3.3.6/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="<?= base_url() ?>assets/bootstrap-3.3.6/css/bootstrap-theme.min.css"/>
    <link rel="stylesheet" href="<?= base_url() ?>assets/bootstrap-3.3.6/css/bootstrap-rtl.min.css"/>
    <script src="<?= base_url() ?>assets/bootstrap-3.3.6/js/bootstrap.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- jQuery form (ajax forms) -->
    <script src="<?= base_url() ?>assets/js/jquery.form.js"></script>
    <!-- custom js -->
    <script src="<?= base_url() ?>assets/js/controlPanel.js"></script>
    <script src="<?= base_url() ?>assets/js/pr1-script.js"></script>
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
                        <li class="active"><a href="#"><i class="ti-home"></i> رئيسية الموقع</a></li>
                        <li><a href="#"><i class="glyphicon glyphicon-log-out"></i> خروج</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>

    <div class="row no-margin">
        <div id="controlPanelMenu" class="col-md-2 com-sm-1 control-list-col fullHeight">
            <div class="list-group rtl">
                <a href="" class="list-group-item no-border-radius "><i class="ti-user"></i>
                    <span>الرئيسة</span>
                    <i class="ti-angle-left pull-left"></i></a>
                <a href="" class="list-group-item no-border-radius"><i class=" ti-email"></i>
                    <span>الأعضاء</span>
                    <i class="ti-angle-left pull-left"></i></a>
                <a href="" class="list-group-item no-border-radius active1"><i class="ti-comment-alt"></i>
                    <span>الضبط</span>
                    <i class="ti-angle-left pull-left"></i></a>
                <a href="" class="list-group-item no-border-radius"><i class="ti-world"></i>
                    <span>أقسام الموقع</span>
                    <i class="ti-angle-left pull-left"></i></a>
                <a href="" class="list-group-item no-border-radius"><i class="ti-files"></i>
                    <span>الخروج</span>
                    <i class="ti-angle-left pull-left"></i></a>
                <a class="list-group-item no-border-radius"><i class="ti-server"></i>
                    <span>المواضيع</span>
                    <i class="ti-angle-left pull-left"></i></a>
                <a id="collapseMenu" href="#" class="list-group-item no-border-radius">
                    <i id="collapseIcon" class="ti-angle-double-right"></i>
                    <i id="unCollapseIcon" class="ti-angle-double-left"></i>
                    <span>طي القائمة</span>
                </a>
            </div>

        </div>
        <div class="col-md-10 col-sm-11" id="controlPanelContent">

