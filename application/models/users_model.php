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
    // ------------------------------------------
    /* هل البريد الالكتروني موجود للعضو */
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

    // ------------------------------------------
    function get_users()
    {
        $q = $this->db->get("users");
        if ($q->num_rows() > 0) return $q->result();
        else return false;
    }

    // ------------------------------------------
    function get_countries()
    {
        $q = $this->db->get("country");
        return $q->result();
    }

}