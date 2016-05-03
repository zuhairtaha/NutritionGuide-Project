<form action="" method="" class="form">
    <div class="form-group">
        <label for="user_name"><i class="fa fa-user"></i> اسم المستخدم</label>
        <input type="text" placeholder="ضع اسمك" name="user_name" id="user_name" class="form-control" value="">
    </div>

    <div class="form-group">
        <label for="user_email"><i class="glyphicon glyphicon-envelope"></i> البريد الالكتروني</label>
        <input type="text" placeholder="أدخل بريدك الإلكترني" name="user_email" id="user_email" class="form-control"
               value="">
    </div>

    <div class="form-group">
        <label for="user_password"><i class="ti-key"></i> كلمة المرور</label>
        <input type="text" placeholder="كلمة المرور" name="user_password" id="user_password" class="form-control"
               value="">
    </div>


    <div class="form-group">
        <label for="country"><i class="glyphicon glyphicon-globe"></i> اختر البلد</label>
        <select class="form-control" id="country" name="country">
            <? foreach ($countries as $country): ?>
                <option><?=$country-></option>
            <? endforeach; ?>

        </select>


    </div>

    <button type="button" class="btn btn-primary btn-block"><i class="fa fa-user-plus"></i> تسجيل</button>

</form>
