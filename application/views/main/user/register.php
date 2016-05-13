<p class="alert alert-danger" id="errors_p" style="display: none;"></p>

<div id="regFormInpt">
    <form action="" method="post" class="form" name="register_form" id="register_form">

        <!-- اسم المستخدم -->
        <div class="form-group">
            <label for="user_name"><i class="fa fa-user"></i> اسم المستخدم</label>
            <input type="text" placeholder="ضع اسمك" name="user_name" id="user_name" class="form-control" value="">
        </div>

        <!-- البريد الالكتروني -->
        <div class="form-group">
            <label for="user_email"><i class="glyphicon glyphicon-envelope"></i> البريد الالكتروني</label>
            <input type="email" placeholder="أدخل بريدك الإلكترني" name="user_email" id="user_email" class="form-control"
                   value="">
        </div>

        <!-- كلمة المرور -->
        <div class="form-group">
            <label for="user_password"><i class="fa fa-key"></i> كلمة المرور</label>
            <input type="password" placeholder="كلمة المرور" name="user_password" id="user_password"
                   class="form-control"
                   value="">
        </div>

        <!-- البلد -->
        <? $current_country_code = "SY"; // strtoupper(get_country()); ?>
        <div class="form-group">
            <label for="country"><i class="glyphicon glyphicon-globe"></i> اختر البلد</label>
            <select class="form-control" id="user_country" name="user_country">
                <? foreach ($countries as $country): ?>
                    <option value="<?= $country->country_code ?>"
                        <? if ($current_country_code == $country->country_code) echo ' selected="selected" '; ?> >
                        <?= $country->country_name_ar ?>
                    </option>
                <? endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <b>الجنس: </b> &nbsp;&nbsp;&nbsp;&nbsp;
            <label class="radio-inline">
                <input type="radio" checked="checked" name="user_gender" id="male" value="male">
                <i class="fa fa-male" aria-hidden="true"></i> ذكر
            </label>

            <label class="radio-inline">
                <input type="radio" name="user_gender" id="female" value="female">
                <i class="fa fa-female" aria-hidden="true"></i> أنثى
            </label>
        </div>

        <div class="form-group">
            <label for="user_birthDate"><i class="fa fa-calendar"></i> تاريخ الميلاد</label>
            <input type="text" placeholder="yyyy-mm-dd تاريخ الميلاد" name="user_birthDate" id="user_birthDate"
                   class="form-control"
                   value="">
        </div>


        <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-user-plus"></i> تسجيل</button>

    </form>
</div>


<!-- Bootstrap Date-Picker Plugin -->
<script type="text/javascript"
        src="<?= base_url() ?>assets/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet"
      href="<?= base_url() ?>assets/css/bootstrap-datepicker3.css"/>
<script>
    $(document).ready(function () {
        var date_input = $('input[name="user_birthDate"]'); //our date input has the name "date"
        // var container  = $(".container form").length > 0 ? $(".container form").parent() : "body";
        date_input.datepicker({
            format: 'yyyy-mm-dd',
            // container: container,
            todayHighlight: true,
            autoclose: true
        })
    })
</script>