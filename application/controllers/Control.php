<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Control extends CI_Controller
{
    // قالب لوحة التحكم
    // هيدر لوحة التحكم ويمرر له العنوان
    function header($title = "لوحة تحكم موقع الدليل الغذائي")
    {
        $data['title'] = $title;
        // جلب رابط الصفحة الحالية وتمريره إلى متغير في جافا سكربت بهدف تلوين خلفية زر الصحفة التي نحن فيها عن طريق جي كويري
        $data['segment1'] = $this->uri->segment(2) ? $this->uri->segment(2) : "index";
        $this->load->view('control/template/header', $data);
    }

    // فوتر لوحة التحكم
    function footer()
    {
        $this->load->view('control/template/footer');
    }

    // -------------------------------------------------------
    // الصفحة الرئيسة للوحة التحكم وفيها بعض الإحصائيات عن الموقع
    public function index()
    {
        $this->header("لوحة التحكم | إحصائيات");
        $this->load->view('control/statistics');

    }

    // صفحة الإعدادات : اسم الموقع وروابط الصحفات الاجتماعية
    function options()
    {
        $this->header("إعدادات");
        $this->load->model('options_mdl');
        $data['options'] = $this->options_mdl->select_options();
        
        $this->load->view('control/options', $data);
        $this->footer();
    }

    function update_settings()
    {
        $this->load->model('options_mdl');
        // $ins_data['update_settings'] = array( هي كانت غلط كانت هيك
        $ins_data = array(
            'site_name' => $_POST['siteName'],
            'site_tags' => '',
            'site_description' => $_POST['siteDesc'],
            'facebook' => $_POST['facebook'],
            'twitter' => $_POST['twitter'],
            'youtube' => $_POST['youtube']);

        $this->options_mdl->update_options($ins_data);
        redirect($this->input->server('HTTP_REFERER')); // الرجعوع للصفحة السابقة
    }
    // -------------------------------------------------------
    /*تابع للقراء من جدول التصنيفاتء */
    function get_food_categories()
    {
       $this->load->model('options_mdl');
       $data['food_categories'] = $this->options_mdl->select_food_categories();
    }
    // -------------------------------------------------------
    /*تابع لتحديث جدول التصنيفات  */
    function update_food_categories()
    {
        $this->load->model('options_mdl');
        $ins_data = array(
            'fc_id' => $_POST['fc_id'],
            'fc_title' => $_POST['fc_title'],
            'fc_description' => $_POST['fc_description'],
            'fc_image' => $_POST['fc_image'],
            'fc_level' => $_POST['fc_level'],
            'fc_author_id' => $_POST['fc_author_id']);

        $this->options_mdl->update_food_categories($ins_data, $id);
        redirect($this->input->server('HTTP_REFERER')); // الرجعوع للصفحة السابقة
    }
    // -------------------------------------------------------
    /*تابع للقراءة من جدول المواد الغذائية*/
    function get_food_stuffs()
    {
       $this->load->model('options_mdl');
       $data['food_categories'] = $this->options_mdl->select_food_stuffs();
    }
    // -------------------------------------------------------
    /*تابع لتحديث جدول المواد الغذائية*/
    function update_food_stuffs()
    {
        $this->load->model('options_mdl');
        $ins_data = array(
            'f_id' => $_POST['f_id'],
            'f_title' => $_POST['f_title'],
            'f_size' => $_POST['f_size'],
            'f_weight' => $_POST['f_weight'],
            'f_calories' => $_POST['f_calories'],
            'f_proteins' => $_POST['f_proteins']);
            'f_fats' => $_POST['f_fats']);
            'f_carbohydrates' => $_POST['f_carbohydrates']);
            'f_cholesterol' => $_POST['f_cholesterol']);
            'f_calcium' => $_POST['f_calcium']);
            'f_iron' => $_POST['f_iron']);
            'f_sodium' => $_POST['f_sodium']);
            'f_image' => $_POST['f_image']);
            'f_category_id' => $_POST['f_category_id']);

        $this->options_mdl->update_food_stuffs($ins_data, $id);
        redirect($this->input->server('HTTP_REFERER')); // الرجعوع للصفحة السابقة
    }
    
    // -------------------------------------------------------
    /* التصنيفات الأساسية للغذاء */
    function food_categories()
    {
        $this->header("التصنيفات الأساسية للغذاء");
        $this->load->view("control/food_categories/view");
        $this->footer();
    }

    // -------------------------------------------------------
    /* المواد الغذائية */
    function food_stuffs()
    {
        $this->header("المواد الغذائية");
        $this->load->view("control/food_stuffs/view");
        $this->footer();
    }

    // -------------------------------------------------------
    /* أقسام الموقع: نصائح غذائية , نصائح عامة, معلومات إثرائية */
    function categories()
    {
        $this->header("أقسام الموقع");
        $this->footer();
    }

    /* المواضيع \المنشورات في أقسام الموقع  */
    function posts()
    {
        $this->header("المواضيع");
        $this->footer();
    }

    /* التعليقات */
    function comments()
    {
        $this->header("التعليقات");
        $this->footer();
    }
    // -------------------------------------------------------
    /* الصفحات: الهرم الغذائي, من نحن, اتصل بنا... */

    function pages()
    {
        $this->header("الصفحات");
        $this->footer();
    }
    // -------------------------------------------------------
    // الأعضاء
    function users()
    {
        $this->header("الأعضاء");
        $this->footer();
    }

    function logout()
    {

    }


    // -------------------------------------------------------
    /* التعليقات */

}
