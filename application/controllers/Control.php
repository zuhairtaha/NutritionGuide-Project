<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Control extends CI_Controller
{
    /* قالب لوحة التحكم: هيدر وفوتر */
    /* الهيدر */
    function header($title = "لوحة تحكم موقع الدليل الغذائي")
    {
        $data['title'] = $title;
        // جلب رابط الصفحة الحالية وتمريره إلى متغير في جافا سكربت بهدف تلوين خلفية زر الصحفة التي نحن فيها عن طريق جي كويري
        $data['segment1'] = $this->uri->segment(2) ? $this->uri->segment(2) : "index";
        $this->load->view('control/template/header', $data);
    }

    /* الفوتر */
    function footer()
    {
        $this->load->view('control/template/footer');
    }

    // =============================================================================
    // الصفحة الرئيسة للوحة التحكم وفيها بعض الإحصائيات عن الموقع
    public function index()
    {
        $this->header("لوحة التحكم | إحصائيات");
        $this->load->view('control/statistics');

    }

    // =============================================================================

    // صفحة الإعدادات : اسم الموقع وروابط الصحفات الاجتماعية
    function options()
    {
        $this->header("إعدادات");
<<<<<<< HEAD
        $this->load->model('options_model');
        $data['options'] = $this->options_model->get_options();
        $this->load->view('control/options', $data);
        $this->footer();
    }

    /*تابع لتحديث جدول إعدادات الموقع*/
    function update_settings()
    {
        $this->load->model('options_model');
        $ins_data = [
            'site_name'        => $_POST['siteName'],
            'site_tags'        => '',
            'site_description' => $_POST['siteDesc'],
            'facebook'         => $_POST['facebook'],
            'twitter'          => $_POST['twitter'],
            'youtube'          => $_POST['youtube']
        ];
        $this->options_model->update_options($ins_data);
=======
        $this->load->model('options_mdl');
        $data['options'] = $this->options_mdl->select_options();
        
        $this->load->view('control/options', $data);
        $this->footer();
    }
    // -------------------------------------------------------
    /*تابع لتحديث جدول إعدادات الموقع*/
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
            'fc_title' => $_POST['fc_title'],
            'fc_description' => $_POST['fc_description'],
            'fc_image' => $_POST['fc_image'],
            'fc_level' => $_POST['fc_level'],
            'fc_author_id' => $_POST['fc_author_id']);

        $this->options_mdl->update_food_categories($ins_data, $id);
        redirect($this->input->server('HTTP_REFERER')); // الرجعوع للصفحة السابقة
    }
    // -------------------------------------------------------
    /*تابع للإضافة في جدول التصنيفات */
    function insert_food_categories()
    {
        $this->load->model('options_mdl');
        $ins_data = array(
            'fc_title' => $_POST['fc_title'],
            'fc_description' => $_POST['fc_description'],
            'fc_image' => $_POST['fc_image'],
            'fc_level' => $_POST['fc_level'],
            'fc_author_id' => $_POST['fc_author_id']);

        $this->options_mdl->insert_food_categories($ins_data);
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
    /*تابع للإضافة في جدول المواد الغذائية*/
    function insert_food_stuffs()
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

        $this->options_mdl->insert_food_stuffs($ins_data);
>>>>>>> origin/master
        redirect($this->input->server('HTTP_REFERER')); // الرجعوع للصفحة السابقة
    }
    // =============================================================================
    /* التصنيفات الغذائية */
    function food_categories()
    {
        $this->load->model("food_categories_model");
        $data['food_categories'] = $this->food_categories_model->get_food_categories();
        $this->header("التصنيفات الغذائية");
        $this->load->view("control/food_categories/view", $data);
        $this->footer();
    }

    /* إضافة تصنيف جديد */
    function add_food_category()
    {
        $this->load->model("food_categories_model");
        $data = [
            "fc_title"     => $_POST['title'],
            "fc_image"     => $_POST['imagesUpNames'],
            "fc_level"     => $_POST['categoryLevel'],
            "fc_author_id" => 1,
        ];
        $this->food_categories_model->add_food_category($data);
        redirect($_SERVER["HTTP_REFERER"]);
    }

    /* جلب تصنيف */
    function get_food_category($id)
    {
        $this->load->model("food_categories_model");
        echo $this->food_categories_model->get_food_category($id);
    }

    /* تعديل تصنيف */
    function update_food_category($id)
    {
        $this->load->model("food_categories_model");
        $data = [
            "page_title"      => $_POST['PagesTitle'],
            "page_content"    => $_POST['PageBody2'],
            "page_level"      => $_POST['PageLevel'],
            "page_updated_at" => date("Y-m-d H:i:s"),
            "page_author_id"  => 1,
        ];

        $this->food_categories_model->update_food_category($id, $data);
        redirect($_SERVER["HTTP_REFERER"]);

    }

    /* حذف تصنيف */
    function delete_food_category($id)
    {
        $this->load->model("food_categories_model");
        $this->food_categories_model->delete_food_category($id);
    }
    // =============================================================================
    /* المواد الغذائية */
    /* عرض المواد الغذائية */
    function get_food_stuffs()
    {
        $this->load->model('options_mdl');
        $data['food_categories'] = $this->options_mdl->get_food_stuffs();
    }
    // -------------------------------------------------------
    /* تحديث مادة غذائية  */
    function update_food_stuffs()
    {
        $this->load->model('food_stuffs_model');
        $ins_data = [
            'f_id'            => $_POST['f_id'],
            'f_title'         => $_POST['f_title'],
            'f_size'          => $_POST['f_size'],
            'f_weight'        => $_POST['f_weight'],
            'f_calories'      => $_POST['f_calories'],
            'f_proteins'      => $_POST['f_proteins'],
            'f_fats'          => $_POST['f_fats'],
            'f_carbohydrates' => $_POST['f_carbohydrates'],
            'f_cholesterol'   => $_POST['f_cholesterol'],
            'f_calcium'       => $_POST['f_calcium'],
            'f_iron'          => $_POST['f_iron'],
            'f_sodium'        => $_POST['f_sodium'],
            'f_image'         => $_POST['f_image'],
            'f_category_id'   => $_POST['f_category_id']
        ];
        $this->food_stuffs_model->update_food_stuff($ins_data, $_POST['f_id']);
        redirect($this->input->server('HTTP_REFERER')); // الرجعوع للصفحة السابقة
    }
    // -------------------------------------------------------
    /* إضافة  المواد الغذائية*/
    function insert_food_stuffs()
    {
        $this->load->model('food_stuffs_model');
        $ins_data = [
            'f_id'            => $_POST['f_id'],
            'f_title'         => $_POST['f_title'],
            'f_size'          => $_POST['f_size'],
            'f_weight'        => $_POST['f_weight'],
            'f_calories'      => $_POST['f_calories'],
            'f_proteins'      => $_POST['f_proteins'],
            'f_fats'          => $_POST['f_fats'],
            'f_carbohydrates' => $_POST['f_carbohydrates'],
            'f_cholesterol'   => $_POST['f_cholesterol'],
            'f_calcium'       => $_POST['f_calcium'],
            'f_iron'          => $_POST['f_iron'],
            'f_sodium'        => $_POST['f_sodium'],
            'f_image'         => $_POST['f_image'],
            'f_category_id'   => $_POST['f_category_id']
        ];
        $this->food_stuffs_model->add_food_stuff($ins_data);
        redirect($this->input->server('HTTP_REFERER')); // الرجعوع للصفحة السابقة
    }

    // =============================================================================
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
    // =============================================================================
    /* لوحة الإدارة .. الصفحات (محتوى صفحات مثل صفحة الهرم الغذائي, من نحن, ... الخ) */

    /* الصفحات */
    function pages($offset = 0)
    {
        $this->load->model("pages_model");
        $data['pages'] = $this->pages_model->getPages();
        $this->header("الصفحات");
        $this->load->view('control/pages', $data);
        $this->footer();
    }

    /* إضافة صفحة */
    function addPage()
    {
        $this->load->model("pages_model");
        $data = [
            "page_title"      => $_POST['title'],
            "page_content"    => $_POST['pageBody'],
            "page_level"      => $_POST['pageLevel'],
            "page_created_at" => date("Y-m-d H:i:s"),
            "page_author_id"  => 1,
        ];
        $this->pages_model->addPage($data);
        redirect($_SERVER["HTTP_REFERER"]);
    }

    /* جلب صفحة عن طريق الآي دي */
    function getPageBody($id)
    {
        $this->load->model("pages_model");
        echo $this->pages_model->getPageBodyEdt($id);
    }

    /* تعديل صفحة */
    function updatePage($id)
    {
        $this->load->model("pages_model");
        $data = [
            "page_title"      => $_POST['PagesTitle'],
            "page_content"    => $_POST['PageBody2'],
            "page_level"      => $_POST['PageLevel'],
            "page_updated_at" => date("Y-m-d H:i:s"),
            "page_author_id"  => 1,
        ];

        $this->pages_model->updatePage($id, $data);
        redirect($_SERVER["HTTP_REFERER"]);

    }

    /* حذف صفحة */
    function deletePage($id)
    {
        $this->load->model("pages_model");
        $this->pages_model->deletePage($id);
    }
    // =============================================================================
    /* الأعضاء */
    function users()
    {
        $this->header("الأعضاء");
        $this->footer();
    }

    function logout()
    {

    }

<<<<<<< HEAD
    // =============================================================================
=======

    // -------------------------------------------------------
>>>>>>> origin/master
    /* التعليقات */


}
