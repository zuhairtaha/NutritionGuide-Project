<?php
/**
 * Created by PhpStorm.
 * User: zuhair
 * Date: 21/04/2016
 * Time: 02:06 ص
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends CI_Model
{
    /* التحقق من اسم المستخدم وكلمة المرور للمدير قبل الدخول إلى لوحة التحكم */
    function cheack_admin($username, $password)
    {
        $sq = "SELECT * FROM  users
               WHERE user_name <=> \"$username\"
               AND user_password <=> \"$password\"
               AND user_role<=>'admin'
                  ";
        $q  = $this->db->query($sq)->result();

        if ($q) {
            $user_id = $q[0]->user_id;
            $this->db->query(" UPDATE users SET
                               user_last_login = CURRENT_TIMESTAMP
                               WHERE user_id = $user_id
                               ");
            return $q;
        } else
            return false;
    }

    /* تحديث كلمة المرور إذا كان البريد الالكتروني موجود */
    function is_exist_email($email, $new_password)
    {
        $this->db->where('user_email', $email);
        $q = $this->db->get('users');
        if ($q->num_rows() > 0) {
            $pass = ["user_password" => sha1($new_password)];
            $this->db->where('user_email', $email);
            $this->db->update('users', $pass);
            return true;
        } else return false;
    }

    /* جلب كافة المستخدمين */
    function get_users()
    {
        $q = $this->db->get("users");
        if ($q->num_rows() > 0) return $q->result();
        else return false;
    }

    /* جلب مستخدم حسب الآي دي */
    function get_user($id)
    {
        $this->db->where("user_id", $id);
        $q = $this->db->get("users");
        if ($q->num_rows() > 0) return $q->result();
        else return false;
    }

    /* تعديل بيانات مستخدم */
    function update_user($data, $user_id)
    {
        $this->db->where("user_id", $user_id);
        $this->db->update("users", $data);
    }

    /* جلب البلاد (عند تسجيل مستخدم يختار البلد) */
    function get_countries()
    {
        $q = $this->db->get("country");
        return $q->result();
    }

    /* تسجيل مستخدم جديد */
    function register($user)
    {
        if ($this->db->insert("users", $user))
            return $this->db->insert_id();
        else
            return false;
    }

    /* تفحص بريد الكتروني إذا كان مسجل مسبقاً */
    function check_email_if_exist($email)
    {
        $this->db->where("user_email", $email);
        $q = $this->db->get("users");
        if ($q->num_rows() > 0) return true;
        else return false;

    }

    /* تفحص بيانات الدخول عند تسجيل الدخول */
    function check_login_data($user_name, $user_password)
    {
        // echo '<pre>'; print_r($user_name.','.$user_password); echo '</pre>'; die();
        $sq = "SELECT * FROM  users
               WHERE user_name <=> \"$user_name\"
               AND user_password <=> \"$user_password\"
              ";
        $q  = $this->db->query($sq)->result();

        if ($q) {
            $user_id = $q[0]->user_id;
            $this->db->query(" UPDATE users SET
                               user_last_login = CURRENT_TIMESTAMP
                               WHERE user_id = $user_id
                               ");
            return $q;
        } else
            return false;

    }

    /* تنشيط عضوية عن طريق كود التفعيل */
    function active($code)
    {
        $str = preg_replace('/\D/', '', $code); /* أخذ الرقم من الكود الواصل */
        $id  = ($str + 7) / 70; /* فك تشفير الرقم إلى الآي دي */
        $this->db->where("user_id", $id);
        $q = $this->db->get("users");
        if ($q->num_rows() > 0) { /* إذا وجد عضو يحمل هذا الآي دي */
            $this->db->query("
                UPDATE users 
                SET user_active = 1
                WHERE user_id = $id
        ");
            return $q->result();

        } else return false;
    }

} // end user_model class