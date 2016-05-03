<?php
/**
 * Created by PhpStorm.
 * User: zuhair
 * Date: 01/05/2016
 * Time: 11:19 م
 */
$err = '';
if (!$email) $err .= '<h4 class="alert alert-danger"><i class="glyphicon glyphicon-remove"></i>لم تدخل البريد الإلكتروني</h4>';
elseif (filter_var($email, FILTER_VALIDATE_EMAIL) == false)
    $err .= '<h4 class="alert alert-danger"><i class="glyphicon glyphicon-remove"></i>البريد الالكتروني غير صالح</h4>';
if (!$msg) $err .= '<h4 class="alert alert-danger"><i class="glyphicon glyphicon-remove"></i>لم تدخل نص الرسالة</h4>';
$ip      = $this->input->ip_address();
$country = get_country();
$msg     = "<div style='font-family:arial,serif; font-size:16px; text-align:right; direction:rtl;'>"
    . "<p>" . nl2br($msg) . "</p>"
    . "<hr/>"
    . "<p>المرسل: $name</p>"
    . "<p>موضوع الرسالة</p>"
    . "<p>أرسلت عبر موقع دليل التغذية الالكتروني</p>"
    . "<p>آي بي المرسل $ip</p>"
    . "<p>البلد $country</p>"
    . "</div>";
if ($err == null) {
    $this->load->library('email');
    $this->email->from($email, $name)
        ->to('info@nitrition-guide.com')
        ->subject($subject)
        ->message($msg)
        ->set_mailtype('html');

    if ($this->email->send())
        echo '<h4 class="alert alert-success"><i class="glyphicon glyphicon-ok"></i> تم الإرسال بنجاح</h4>';
    else echo $this->email->print_debugger();
} else echo $err;