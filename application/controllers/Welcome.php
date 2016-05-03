<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller
{
    /* الباني */
    public function __construct()
    {
        parent::__construct();
        /* موديلات يتم تحميلها على مستوى الكلاس بأكمله */
        $this->load->model("options_model");
        $this->load->model("food_categories_model");
        $this->load->model("pages_model");
        $this->load->model("parts_model");
    }

// ------------------------------------------
    /* هيدر الموقع */
    function header($title = null)
    {
        $data["options"]    = $this->options_model->get_options();
        $data["categories"] = $this->food_categories_model->get_food_categories();
        $data["pages"]      = $this->pages_model->getPages();
        $data["parts"]      = $this->parts_model->get_parts();
        $data["title"]      = $title;

        $this->load->view("main/template/header", $data);
    }
    // ------------------------------------------
    /* فوتر الموقع */
    function footer()
    {

        $this->load->view("main/template/footer");
        $this->options_model->add_visit();
    }
    // ------------------------------------------

    /* الصفحة الرئيسة وتحوي: عينة عشوائية لثمانية مواعد غذائية */
    public function index()
    {
        $this->load->model("food_stuffs_model");
        $this->load->model("posts_model");
        $this->load->model("posts_model");
        $this->load->model("parts_model");
        $this->load->helper("my_helper");

        $data["categories"]         = $this->food_categories_model->get_food_categories();
        $data["random_food_stuffs"] = $this->food_stuffs_model->get_random_sample(10);
        $data["last_posts"]         = $this->posts_model->get_last_posts(6);
        $data["most_read_posts"]    = $this->posts_model->get_most_read_posts(6);
        $data["parts"]              = $this->parts_model->get_parts();
        $this->header();
        $this->load->view("main/home/content", $data);
        $this->footer();
    }

    // ------------------------------------------
    /* الصفحات */
    function page($id)
    {
        $data["page"] = $this->pages_model->getPage($id);
        if (!$data["page"]) {
            $this->error("رابط صفحة خاطئ");
            return;
        }
        $this->header($data["page"][0]->page_title);
        $this->load->view("main/page/view", $data);
        $this->footer();
    }

    // ------------------------------------------

    function about()
    {
        /* http://themes.getbootstrap.com/ */
    }

    // ------------------------------------------
    /* صفحة فورم اتصل بنا */
    function contact_us()
    {
        $this->header("اتصل بنا");
        $this->load->view("main/contact/view");
        $this->footer();
    }
    // ------------------------------------------
    /* إرسالة الرسالة */
    function send_mail()
    {
        $this->load->library("email");
        $data["name"]    = $this->input->post('name');
        $data["email"]   = $this->input->post('email');
        $data["subject"] = $this->input->post('subject');
        $data["msg"]     = $this->input->post('msg');
        $this->load->view("main/contact/send_mail", $data);

    }

    // ------------------------------------------
    /* التصنيفات الغذائية */

    /* عرض كافة التصنيفات */
    function categories()
    {
        $data["categories"] = $this->food_categories_model->get_food_categories();
        $this->header("التصنيفات الغذائية");
        $this->load->view("main/categories/view_all", $data);
        $this->footer();
    }
    // ------------------------------------------

    /* عرض تصنيف */
    function category($id)
    {
        $this->load->model("food_stuffs_model");
        $data["food_stuffs"] = $this->food_stuffs_model->get_food_stuffs_of_category($id);
        if (!$data["food_stuffs"]) {
            $this->error("رابط التصنيف الذي طلبته غير موجود أو أنه لايوجد فيه مواد غذائية بعد");
            return;
        }
        $data["id"] = $id;
        $this->header($data["food_stuffs"][0]->fc_title);
        $this->load->view("main/categories/view", $data);
        $this->footer();
    }
    // ------------------------------------------
    /* المواد الغذائية */
    function food($id)
    {
        $this->load->model("food_stuffs_model");
        $data["food_stuff"] = $this->food_stuffs_model->get_food_stuff($id);
        if (!$data["food_stuff"]) {
            $this->error("لايوجد مادة غذائية بالرابط المطلوب");
            return;
        }
        $data["id"] = $id;
        $this->header($data["food_stuff"][0]->f_title);
        $this->load->view("main/food_stuff/view", $data);
        $this->footer();
    }

    // ------------------------------------------
    /* أقسام الموقع */
    function parts()
    {
        $data['parts'] = $this->parts_model->get_parts_with_last_post();
        $this->header("أقسام الموقع");
        $this->load->view("main/part/view_parts", $data);
        $this->footer();
    }
    // ------------------------------------------

    /* عند فتح قسم يظهر فيه مقالاته كروابط */
    function   part($id, $offset = 0)
    {
        $this->load->helper("my_helper");
        $this->load->library('pagination');
        $config['base_url']  = base_url() . "part/$id/";
        $config['per_page']  = 6;
        $limit               = $config['per_page'];
        $config['num_links'] = 6;
        $data['posts']       = $this->parts_model->get_posts_of_part($id, $offset, $limit);
        if (!$data['posts']) {
            $this->error("رابط قسم خاطئ أو قسم فارغ");
            return;
        }
        $config['total_rows']       = $this->parts_model->count_total_rows_of_part($id);
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

        $this->header($data['posts'][0]->part_title);
        $this->load->view('main/part/view_part_posts', $data);
        $this->footer();
    }
    // ------------------------------------------
    /* عرض مقال */
    function post($id)
    {
        $this->load->model("posts_model");
        $data["post"] = $this->posts_model->get_post($id);
        if (!$data["post"]) {
            $this->error("لايوجد مقال بالرابط المطلوب");
            return;
        }
        $this->header($data['post'][0]->post_title);
        $this->load->view('main/post/view', $data);
        $this->footer();
    }
    // ------------------------------------------
    /* البحث  */
    function search()
    {
        $key     = $this->input->post('key');
        $section = $this->input->post('section');
        if (!$key && !$section) {
            echo "لم تدخل كلمة البحث أو تختر القسم";
            return;
        }
        /* البحث عن مقالات */
        if ($section == "search_posts") {
            $this->load->model("posts_model");
            $data["posts"] = $this->posts_model->search($key);
            if (!$data["posts"]) {
                echo "لا يوجد نتائج لما طلبت";
                return;
            }
            $data["key"] = $key;
            $this->load->view('main/post/search_results', $data);
        } /* البحث عن مواد غذائية */
        elseif ($section == "search_stuffs") {
            $this->load->model("food_stuffs_model");
            $data["food_stuffs"] = $this->food_stuffs_model->search($key);
            if (!$data["food_stuffs"]) {
                echo "لا يوجد مادة غذائية مطابقة للاسم الذي طلبت";
                return;
            }
            $this->load->view("main/food_stuff/search_results", $data);
        }
    }
// ------------------------------------------
    /* المستخدمين */

    /* تسجيل عضوية جديدة */
    function register()
    {
        $this->load->model("users_model");
        $data["countries"] = $this->users_model->get_countries;
        $this->load->helper("my_helper");
        $this->header("تسجيل عضوية جديدة");
        $this->load->view('main/user/register', $data);
        $this->footer();
    }




















    // ------------------------------------------
    /* صفحة الخطأ */
    function error($msg = "")
    {
        $this->header("خطأ");
        $data["error"] = $msg;
        $this->load->view('main/error/view', $data);
        $this->footer();
    }
}
