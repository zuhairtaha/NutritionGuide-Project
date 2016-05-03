<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin_login extends CI_Controller
{
    /* صفحة تسجيل الدخول */
    function index($err = 0)
    {
        $data["err"] = $err;
        $this->load->view('control/users/login', $data);
    }

// ------------------------------------------
    function login()
    {
        /* التحقق من بيانات دخول المدير إلى لوحة التحكم */
        $this->load->model("users_model");
        $user_name = $_POST["username"];
        $password  = sha1($_POST["password"]);
        $admin     = $this->users_model->cheack_admin($user_name, $password);
        if ($admin) {
            $userData = [
                'logged_in_admin' => TRUE,
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


    // ------------------------------------------
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
            $this->email->from('info@nitritionguide.com', 'Nitrition Guide');
            $this->email->to($email);
            $this->email->subject('استعادة كلمة مرور حسابك في موقع دليل التغذية');
            $msg = 'كلمة المرور الخاصة بك هي ' . $new_password;
            $this->email->message($msg);
            $this->email->send();
            echo 'تم ارسال كلمة المرور الخاصة بك إلى بريدك';
        } else {
            echo 'يبدو أن هذا البريد الالكتروني غير مسجل لدينا';
        }


    }

    // ------------------------------------------


}