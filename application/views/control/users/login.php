<!DOCTYPE html>
<html lang="ar">
<head>
    <meta name="author" content="tahasoft, زهير طه"/>
    <meta name="keywords" content=""/>
    <meta name="description" content=""/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>

    <!-- jQuery -->
    <script src="<?= base_url() ?>assets/js/jquery-1.9.1.min.js"></script>

    <!-- Bootstrap core CSS -->
    <!-- bootstrap + theme + rtl support -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/bootstrap-3.3.6/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="<?= base_url() ?>assets/bootstrap-3.3.6/css/bootstrap-theme.min.css"/>
    <link rel="stylesheet" href="<?= base_url() ?>assets/bootstrap-3.3.6/css/bootstrap-rtl.min.css"/>
    <script src="<?= base_url() ?>assets/bootstrap-3.3.6/js/bootstrap.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="<?= base_url() ?>assets/js/jquery.form.js"></script>
    <!-- common css -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/common.css"/>

    <!-- themify-icons -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/themify-icons/themify-icons.css">

    <!-- مكتبة مؤثرات حركية -->
    <!-- https://daneden.github.io/animate.css/ المصدر -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/animate.min.css"/>

    <style type="text/css">


        body {
            background: rgba(204, 204, 204, 0.23);
            margin: 0;
            background: url(http://i.imgur.com/AMf9X7E.jpg);
            -webkit-background-size: 100%;
            background-size: 100%;
        }

        #userIcon {
            color: #fff;
            background: #2196F3;
            padding: 0.5em;
            border-radius: 255px;
            margin-top: 0.5em;
            font-size: 1.3em;
            display: inline-block;
        }

        .col-lg-6.center-block {
            box-shadow: 0 0 25px 1px gray;
            border-radius: 0.5em;
            background: #fff;
            margin-top: 1.5em;
        }

        .redColor {
            color: #e37045;
        }
    </style>
    <script>
        $(document).ready(function () {

            function anim(el, x) {
                $(el).addClass(x + ' animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function () {
                    $(this).removeClass(x + ' animated');

                });
            }

            /* التحقق من إدخال البيانات Client Side */
            $("#loginForm").submit(function (e) {
                var userName = $("#usrName").val();
                var password = $("#passWrd").val();
                var err      = "";
                if (!userName) err += "<p class='redColor'><i class='ti-alert'></i> لم تدخل اسم المستخدم</p>";
                if (!password) err += "<p class='redColor'><i class='ti-alert'></i> لم تدخل كلمة المرور</p>";
                if (err != "") {
                    e.preventDefault();
                    $(".alertP").hide();
                    $("#errors").html(err);
                    anim($('.center-block'), 'shake');
                }
            });
            /* ------------------------------------------*/

            /* إعادة ضبط كلمة المرور بالأجاكس */
            $("#restPassForm").ajaxForm({
                beforeSend: function (e) {
                    $("#notes").html('جاري التحقق من البريد');
                },
                success: function () {
                },
                complete: function (response) {
                    var r = response.responseText;
                    $("#notes").html(r);
                }
            });
        });
    </script>

    <title>لوحة التحكم</title>
</head>
<body>
<!-- ------------------------------------- body ----------------------------------- -->

<div class="container">
    <div class="row">
        <div class="col-lg-3"></div>
        <div class="col-lg-6 center-block">

            <?
            if ($this->session->logged_in && $this->session->user_role == "admin") {
                redirect(base_url() . "manage/home");
            } else {
                ?>

                <h1 style="text-align: center;margin:auto"><i id="userIcon" class="ti-user"></i></h1>

                <form id="loginForm" action="<?= base_url() ?>admin_login/login" method="post" accept-charset="utf-8">
                    <p>

                    <div class="input-group">
                        <span class="input-group-addon"><i class="ti-user"></i></span>

                        <input type="text" class="form-control" id="usrName" placeholder="اسم المستخدم"
                               name="username"/>
                    </div>

                    <p>

                    <div class="input-group">
                        <span class="input-group-addon"><i class="ti-key"></i></span>

                        <input type="password" class="form-control" id="passWrd" placeholder="كلمة المرور"
                               name="password"/>
                    </div>
                    </p>


                    <?
                    $alert = $err == 1 ? "<p class='redColor alertP'><i class='ti-alert'></i> بيانات دخول غير صحيحة</p>" : "";
                    ?>
                    <p id="errors"><?= $alert ?></p>
                    <!-- Trigger the modal with a button -->
                    <p class="btn btn-link" data-toggle="modal" data-target="#myModal"><i
                            class="ti-lock"></i>
                        نسيت كلمة المرور
                    </p>


                    <button id="submit_login" type="submit" class="btn btn-block btn-lg btn-success"><i
                            class="ti-arrow-circle-right"></i> دخول
                    </button>
                </form>
                <br/>

            <? } ?>

        </div>
        <div class="col-lg-3"></div>
    </div>
</div>


<!-- Modal -->
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

                <form id="restPassForm" class="form" action="<?= base_url() ?>admin_login/reset" method="post">
                    <input class="form-control" type="email" placeholder="بريدك الالكتروني" name="email1"/><br/>
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
<!-- ------------------------------------- / body ----------------------------------- -->
</body>
</html>