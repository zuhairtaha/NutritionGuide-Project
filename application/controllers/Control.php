<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Control extends CI_Controller
{
    // ------------------------------------------ constructor
    public function __construct()
    {
        parent::__construct();

        $data = array('lang' => 'ar');
        $this->session->set_userdata($data);


        $c1 = false;
        $c2 = false;
        if (current_url() == base_url("control/up1") || current_url() == base_url("control/up2") || current_url() == base_url("usercp")) $c1 = true;
        if ($this->session->userdata('logged_in_admin') == true) $c2 = true;
        if ($c1 == false && $c2 == false) redirect(base_url("admin_login"));
    }
    // -------------------------------------------

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
        $this->load->model('options_model');
        $this->options_model->add_visit();
        $this->load->view('control/template/footer');
    }

    // =============================================================================
    // الصفحة الرئيسة للوحة التحكم وفيها بعض الإحصائيات عن الموقع
    public function index()
    {
        $this->load->model('options_model');
        $data['hits']   = $this->options_model->get_statistics();
        $data['online'] = $this->options_model->online();
        $this->header("لوحة التحكم | إحصائيات");
        $this->load->view('control/statistics', $data);
        $this->footer();

    }

    // =============================================================================

    // صفحة الإعدادات : اسم الموقع وروابط الصحفات الاجتماعية
    function options()
    {
        $this->header("إعدادات");
        $this->load->model('options_model');
        $data['options'] = $this->options_model->get_options();
        $this->load->view('control/options', $data);
        $this->footer();
    }
    // ------------------------------------------
    /*تابع لتحديث جدول إعدادات الموقع*/
    function update_settings()
    {
        $this->load->model('options_model');
        $ins_data = [
            'site_name'        => $this->input->post('siteName'),
            'site_tags'        => '',
            'site_description' => $this->input->post('siteDesc'),
            'facebook'         => $this->input->post('facebook'),
            'twitter'          => $this->input->post('twitter'),
            'youtube'          => $this->input->post('youtube')

        ];
        $this->options_model->update_options($ins_data);
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
    // ------------------------------------------
    /* إضافة تصنيف جديد */
    function add_food_category()
    {
        $this->load->model("food_categories_model");
        $data = [
            "fc_title"     => $this->input->post('title'),
            "fc_image"     => $this->input->post('imagesUpNames'),
            "fc_level"     => $this->input->post('categoryLevel'),
            "fc_author_id" => 1,
        ];
        $this->food_categories_model->add_food_category($data);
        redirect($_SERVER["HTTP_REFERER"]);
    }
    // ------------------------------------------
    /* صفحة الإضافة التي تحمل في المودال */
    function add_food_category_modal()
    {
        $this->load->view("control/food_categories/add");
    }

    // ------------------------------------------

    /* تعديل تصنيف */
    function update_food_category($id)
    {
        $this->load->model("food_categories_model");
        $data = [
            "fc_title"     => $this->input->post('title'),
            "fc_image"     => $this->input->post('imagesUpNames'),
            "fc_level"     => $this->input->post('categoryLevel'),
            "fc_author_id" => 1,
        ];
        $this->food_categories_model->update_food_category($data, $id);
        redirect($_SERVER["HTTP_REFERER"]);
    }
    // ------------------------------------------

    /* صفحة التعديل التي تحمل في المودال */
    function edit_food_category_modal()
    {
        $data = [
            "title" => $_POST["title"],
            "id"    => $_POST["id"],
            "level" => $_POST["level"],
            "img"   => $_POST["img"]
        ];
        $this->load->view("control/food_categories/edit", $data);
    }
    // ------------------------------------------
    /* حذف تصنيف */
    function delete_food_category($id)
    {
        $this->load->model("food_categories_model");
        $this->food_categories_model->delete_food_category($id);
    }
    // =============================================================================
    /* المواد الغذائية */
    /* عرض المواد الغذائية */
    function food_stuffs($offset = 0)
    {
        $this->load->model('food_stuffs_model');

        $this->load->library('pagination');
        $config['base_url']      = base_url() . "control/food_stuffs/";
        $config['per_page']      = 6;
        $limit                   = $config['per_page'];
        $config['num_links']     = 6;
        $data['food_categories'] = $this->food_stuffs_model->get_food_stuffs($offset, $limit);
        $totalRows               = $this->food_stuffs_model->count_food_stuffs();
        $config['total_rows']    = $totalRows[0]->total;
        /* for bootstrap */
        $config['full_tag_open']    = "<ul class='pagination'>";
        $config['full_tag_close']   = "</ul>";
        $config['num_tag_open']     = '<li>';
        $config['num_tag_close']    = '</li>';
        $config['cur_tag_open']     = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close']    = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open']    = "<li>";
        $config['next_tagl_close']  = "</li>";
        $config['prev_tag_open']    = "<li>";
        $config['prev_tagl_close']  = "</li>";
        $config['first_tag_open']   = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open']    = "<li>";
        $config['last_tagl_close']  = "</li>";

        $this->pagination->initialize($config);

        $this->header("المواد الغذائية");
        $this->load->view("control/food_stuffs/view", $data);
        $this->footer();
    }


    // ------------------------------------------
    /* تعديل مادة غذائية */
    function edit_food_stuff($id)
    {
        $this->load->model('food_stuffs_model');
        $this->load->model("food_categories_model");

        $data['food_categories'] = $this->food_categories_model->get_food_categories();
        $data['food_stuff']      = $this->food_stuffs_model->get_food_stuff($id);

        $this->header("تعديل مادة غذائية");
        $this->load->view("control/food_stuffs/edit", $data);
        $this->footer();
    }
    // ------------------------------------------

    /* تحديث مادة غذائية  */
    function update_food_stuff($id)
    {
        $this->load->model('food_stuffs_model');
        $data = [
            'f_title'         => $this->input->post('f_title'),
            'f_size'          => $this->input->post('f_size'),
            'f_weight'        => $this->input->post('f_weight'),
            'f_calories'      => $this->input->post('f_calories'),
            'f_proteins'      => $this->input->post('f_proteins'),
            'f_fats'          => $this->input->post('f_fats'),
            'f_carbohydrates' => $this->input->post('f_carbohydrates'),
            'f_cholesterol'   => $this->input->post('f_cholesterol'),
            'f_calcium'       => $this->input->post('f_calcium'),
            'f_iron'          => $this->input->post('f_iron'),
            'f_sodium'        => $this->input->post('f_sodium'),
            'f_image'         => $this->input->post('imagesUpNames'),
            'f_bast'          => $this->input->post('f_bast'),
            'f_category_id'   => $this->input->post('f_category_id')
        ];
        $this->food_stuffs_model->update_food_stuff($data, $id);
        redirect(base_url() . 'control/food_stuffs/');
    }
    // -------------------------------------------------------
    /* مودال إضافة المواد الغذائية */
    function add_food_stuff_modal()
    {
        $this->load->model("food_categories_model");
        $data['food_categories'] = $this->food_categories_model->get_food_categories();
        $this->load->view("control/food_stuffs/add", $data);
    }
    // ------------------------------------------

    /* إضافة  المواد الغذائية*/
    function add_food_stuff()
    {
        $this->load->model('food_stuffs_model');
        $data = [
            'f_title'         => $this->input->post('f_title'),
            'f_size'          => $this->input->post('f_size'),
            'f_weight'        => $this->input->post('f_weight'),
            'f_calories'      => $this->input->post('f_calories'),
            'f_proteins'      => $this->input->post('f_proteins'),
            'f_fats'          => $this->input->post('f_fats'),
            'f_carbohydrates' => $this->input->post('f_carbohydrates'),
            'f_cholesterol'   => $this->input->post('f_cholesterol'),
            'f_calcium'       => $this->input->post('f_calcium'),
            'f_iron'          => $this->input->post('f_iron'),
            'f_sodium'        => $this->input->post('f_sodium'),
            'f_image'         => $this->input->post('imagesUpNames'),
            'f_bast'          => $this->input->post('f_bast'),
            'f_category_id'   => $this->input->post('f_category_id')
        ];
        $this->food_stuffs_model->add_food_stuff($data);
        redirect($this->input->server('HTTP_REFERER')); // الرجعوع للصفحة السابقة
    }
    // ------------------------------------------

    /* حذف مادة غذائية */
    function delete_food_stuff($id)
    {
        $this->load->model("food_stuffs_model");
        $this->food_stuffs_model->delete_food_stuff($id);
    }


    // =============================================================================
    /* أقسام الموقع: نصائح غذائية , نصائح عامة, معلومات إثرائية */
    /* أقسام الموقع */
    public function parts()
    {
        $this->header("أقسام الموقع ");
        $this->load->model("parts_model");
        $data['parts'] = $this->parts_model->get_parts();

        $this->load->view("control/parts/view", $data);
        $this->footer();
    }
    // ------------------------------------------
    /* إضافة قسم جديد */
    function add_part()
    {
        $this->load->model("parts_model");
        $data = [
            "part_title"       => $this->input->post('title'),
            "part_image"       => $this->input->post('imagesUpNames'),
            "part_level"       => $this->input->post('partLevel'),
            "part_description" => $this->input->post('part_description')
        ];
        $this->parts_model->add_part($data);
        redirect($_SERVER["HTTP_REFERER"]);
    }
    // ------------------------------------------
    /* صفحة الإضافة التي تحمل في المودال */
    function add_part_modal()
    {
        $this->load->view("control/parts/add");
    }

    // ------------------------------------------

    /* تعديل قسم */
    function update_part($id)
    {

        $this->load->model("parts_model");
        $data = [
            "part_title"       => $this->input->post('title'),
            "part_image"       => $this->input->post('imagesUpNames'),
            "part_level"       => $this->input->post('partLevel'),
            "part_description" => $this->input->post('part_description')
        ];
        $this->parts_model->update_part($data, $id);
        redirect($_SERVER["HTTP_REFERER"]);
    }
    // ------------------------------------------

    /* صفحة التعديل التي تحمل في المودال */
    function edit_part_modal()
    {
        $data = [
            "title" => $_POST["title"],
            "id"    => $_POST["id"],
            "level" => $_POST["level"],
            "img"   => $_POST["img"],
            "desc"  => $_POST["desc"]
        ];
        $this->load->view("control/parts/edit", $data);
    }
    // ------------------------------------------
    /* حذف قسم */
    function delete_part($id)
    {
        $this->load->model("parts_model");
        $this->parts_model->delete_part($id);
    }

    // =============================================================================
    /* المقالات */

    /* عرض المقالات */
    function posts($offset = 0)
    {
        $this->load->model("parts_model");
        $data['parts'] = $this->parts_model->get_parts();
        $this->load->model("posts_model");
        $this->load->helper("my_helper");

        $this->load->library('pagination');
        $config['base_url']   = base_url() . "control/posts/";
        $config['per_page']   = 6;
        $limit                = $config['per_page'];
        $config['num_links']  = 6;
        $data['posts']        = $this->posts_model->get_posts($offset, $limit);
        $totalRows            = $this->posts_model->count_total_posts();
        $config['total_rows'] = $totalRows[0]->total;

        $config['full_tag_open']    = "<ul class='pagination'>";
        $config['full_tag_close']   = "</ul>";
        $config['num_tag_open']     = '<li>';
        $config['num_tag_close']    = '</li>';
        $config['cur_tag_open']     = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close']    = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open']    = "<li>";
        $config['next_tagl_close']  = "</li>";
        $config['prev_tag_open']    = "<li>";
        $config['prev_tagl_close']  = "</li>";
        $config['first_tag_open']   = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open']    = "<li>";
        $config['last_tagl_close']  = "</li>";

        $this->pagination->initialize($config);

        $this->header("المقالات");
        $this->load->view('control/posts/view', $data);
        $this->footer();
    }

// ------------------------------------------
    /* إضافة مقال */
    function add_post()
    {
        $this->load->model("posts_model");
        $data = [
            "post_title"     => $this->input->post('post_title'),
            "post_part_id"   => $this->input->post('post_part'),
            "post_content"   => $this->input->post('post_content'),
            "post_tags"      => $this->input->post('post_tags'),
            "post_author_id" => $this->input->post('author_id'),
            "post_visits"    => 0
        ];
        $this->posts_model->add_post($data);
        redirect($this->input->server('HTTP_REFERER'));
    }

// ------------------------------------------
    /* حذف مقال */
    function delete_post($id)
    {
        $this->load->model("posts_model");
        $this->posts_model->delete_post($id);
    }

// ------------------------------------------
    /* جلب محتوى مقال */
    function get_post_by_id($id)
    {
        $this->load->model("posts_model");
        echo $this->posts_model->get_post_by_id($id);
    }

    // ------------------------------------------
    /* تعديل مقال */
    function update_post($id)
    {
        $data = [
            "post_title"     => $this->input->post('post_title_edit'),
            "post_part_id"   => $this->input->post('post_part_edi'),
            "post_content"   => $this->input->post('post_content_edit'),
            "post_tags"      => $this->input->post('post_tags_edit'),
            "post_author_id" => $this->input->post('author_id'),
            "post_visits"    => 0
        ];
        $this->load->model("posts_model");
        $this->posts_model->update_post($data, $id);
        redirect($this->input->server('HTTP_REFERER'));
    }

    // =============================================================================
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
    // ------------------------------------------
    /* إضافة صفحة */
    function addPage()
    {
        $this->load->model("pages_model");
        $data = [
            "page_title"      => $this->input->post('title'),
            "page_content"    => $this->input->post('pageBody'),
            "page_level"      => $this->input->post('pageLevel'),
            "page_created_at" => date("Y-m-d H:i:s"),
            "page_author_id"  => $this->session->user_id,
        ];
        $this->pages_model->addPage($data);
        redirect($_SERVER["HTTP_REFERER"]);
    }
    // ------------------------------------------
    /* جلب صفحة عن طريق الآي دي */
    function getPageBody($id)
    {
        $this->load->model("pages_model");
        echo $this->pages_model->getPageBodyEdt($id);
    }
    // ------------------------------------------
    /* تعديل صفحة */
    function updatePage($id)
    {
        $this->load->model("pages_model");
        $data = [
            "page_title"      => $this->input->post('PagesTitle'),
            "page_content"    => $this->input->post('PageBody2'),
            "page_level"      => $this->input->post('PageLevel'),
            "page_updated_at" => date("Y-m-d H:i:s"),
            "page_author_id"  => $this->session->user_id,
        ];

        $this->pages_model->updatePage($id, $data);
        redirect($_SERVER["HTTP_REFERER"]);

    }
    // ------------------------------------------
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
        $this->load->model("users_model");
        $data['users'] = $this->users_model->get_users();
        $this->header("الأعضاء");
        $this->load->view("control/users/view", $data);
        $this->footer();
    }

    // ------------------------------------------
    function logout()
    {
        $this->session->sess_destroy();
        redirect($_SERVER["HTTP_REFERER"]);

    }
    // =============================================================================
    /* التعليقات */

// ------------------------------------------
}
