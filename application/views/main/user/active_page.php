<?
$id      = $this->session->user_id;
$r       = substr(str_shuffle(str_repeat("abcdefghijklmnopqrstuvwxyz", 5)), 0, 5);
$msg     = "<h1>لتفعيل عضويتك فضلاً اضغط على الرابط التالي<br /><a href=\"" . base_url() . "active/" . $r . ($id * 53 - 7) . "\">Activate your account</a></h1>";
$to      = $user[0]->user_email;
$subject = "تفعيل عضويتك في موقع دليل التغذية الإلكتروني";
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= 'From: <info@nitrition-guide.com>' . "\r\n";
mail($to, $subject, $msg, $headers,'-f info@nitrition-guide.com');
?>
<p>تم إرسال رابط التفعيل إلى بريدك الالكتروني</p>
<p><?= $to ?></p>
<p>قم بزيارته والضغط على رابط التفعيل</p>