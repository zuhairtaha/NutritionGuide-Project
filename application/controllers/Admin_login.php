<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin_login extends CI_Controller
{
    /* صفحة تسجيل الدخول */
    function index($err = 0)
    {
        $data["err"] = $err;
        $this->load->view('control/users/login', $data);
    }

// ----------------------------------------------------------- 
    function login()
    {
        /* التحقق من بيانات دخول المدير إلى لوحة التحكم */
        $this->load->model("users_model");
        $user_name = $this->input->post('username');
        $password  = sha1($this->input->post('password'));
        $admin     = $this->users_model->cheack_admin($user_name, $password);
        if ($admin) {
            $userData = [
                'logged_in' => TRUE,
                "user_id"         => $admin[0]->user_id,
                "user_name"       => $admin[0]->user_name,
                "user_photo"      => $admin[0]->user_photo,
                "user_last_login" => $admin[0]->user_last_login
            ];
            $this->session->set_userdata($userData);
            redirect('./control');
        } else {
            redirect(base_url('admin_login/1'));
        }
    }

// ------------------------------------------------------------------------
    /* إعادة ضبط كلمة المرور */
    function reset()
    {
        $this->load->model("users_model");
        $email         = $this->input->post('email1');
        $random_string = sha1(mt_rand(10000, 99999) . time());
        $new_password  = substr($random_string, 0, 7);

        $exist = $this->users_model->is_exist_email($email, $new_password);
        if ($exist) {
            $this->load->library('email');
            $this->email->from('info@nitrition-guide.com', 'الدليل الغذائي الإلكتروني');
            $this->email->to($email);
            $this->email->subject('استعادة كلمة مرور حسابك');
            $msg = '<div style="text-align: center;"><img src="http://nitrition-guide.com/assets/img/logo.png" /></div>';
            $msg .= '<p>كلمة المرور الخاصة بك هي </p>';
            $msg .= '<p>' . $new_password . '</p>';
            $msg.= '<hr /><a href="'.base_url().'">الدليل الغذائي الإلكتروني</a>';
            $this->email->message($msg);
            $this->email->set_mailtype('html');
            $this->email->send();
            echo '<p>تم ارسال كلمة المرور الخاصة بك إلى بريدك</p> <p>ملاحظة: قد تجد الرسالة في البريد الغير هام junk mail</p>';
        } else {
            echo 'يبدو أن هذا البريد الالكتروني غير مسجل لدينا';
        }
    }
// ------------------------------------------------------------------------


}