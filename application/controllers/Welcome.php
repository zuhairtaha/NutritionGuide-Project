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
    /* فوتر الموقع */

    function error($msg = "")
    {
        $this->header("خطأ");
        $data["error"] = $msg;
        $this->load->view('main/error/view', $data);
        $this->footer();
    }
    // ------------------------------------------

    /* الصفحة الرئيسة وتحوي: عينة عشوائية لثمانية مواعد غذائية */

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
    /* الصفحات */

    function footer()
    {
        $data["options"] = $this->options_model->get_options();
        $this->load->view("main/template/footer", $data);
        $this->options_model->add_visit();
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
    function part($id, $offset = 0)
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
        $data["post_id"]  = $id;
        $data["comments"] = $this->posts_model->get_comments($id);
        $this->load->view('main/post/comments', $data);

        $this->footer();
    }
    // ------------------------------------------
    /* إضافة تعليق */
    function add_comment()
    {
        $this->load->model("posts_model");
        $comment = [
            "comment_post_id" => $this->input->post('comment_post_id'),
            "comment_user_id" => $this->input->post('comment_user_id'),
            "comment_content" => strip_tags($this->input->post('comment_content'))
        ];
        $this->posts_model->add_comment($comment);
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
        /* إذا كان تم إرسال بيانات تسجيل عبر الفورم */
        if ($_POST) {
            $data = [
                "user_name"              => $this->input->post('user_name'),
                "user_email"             => $this->input->post('user_email'),
                "user_password"          => sha1($this->input->post('user_password')),
                "user_country"           => $this->input->post('user_country'),
                "user_gender"            => $this->input->post('user_gender'),
                "user_birthDate"         => $this->input->post('user_birthDate'),
                "user_ip"                => $this->input->ip_address(),
                "user_registration_date" => date("Y-m-d", time()),
                "user_last_login"        => date("Y-m-d", time()),
            ];

            /* التحقق من ملئ الحقول من طرف السيرفر (إضافة إلى أنه تم التحقق من طرف الكلينت) */
            if ($data["user_name"] && $data["user_email"] && $data["user_password"] &&
                $data["user_country"] && $data["user_gender"] && $data["user_birthDate"]
            ) {
                /* إذا تبين بأن البريد موجود في قاعدة البيانات نظهر له خيار استعادة كلمة المرور */
                if ($this->users_model->check_email_if_exist($data["user_email"])) {
                    $this->header("هذا البريد الالكتروني مسجل مسبقاً");
                    $this->load->view("main/user/already_registered", $data);
                    $this->footer();
                } else {
                    /* إن تم إدخال بيانات صحيحة يتم تسجيل دخول المستخدم بعد إضافته في قاعدة البيانات */
                    $user_id = $this->users_model->register($data);
                    if (!$user_id) {
                        $this->error("لم يتم التسجيل");
                        return;
                    }
                    /* إضافة بيانات المستخدم إلى السيشين */
                    $user_data = [
                        'logged_in' => true,
                        'user_name' => $data["user_name"],
                        'user_id'   => $user_id
                    ];
                    $this->session->set_userdata($user_data);
                    $this->index();
                }
            } else { /* إن قام المستخدم بمحاولة تخطي فحص البيانات من طرف الكلينت */
                $this->error("لم تدخل كافة البيانات");
            }
            return;
        }
        /* في حال لم يتم إرسال بيانات عبر الفورم يتم إظهار فورم التسجيل */
        $data["countries"]       = $this->users_model->get_countries();
        $data["user_current_ip"] = $this->input->ip_address();
        $this->load->helper("my_helper");
        $this->header("تسجيل عضو جديد");
        $this->load->view('main/user/register', $data);
        $this->footer();
    }
    // ------------------------------------------
    /* تسجيل الدخول */

    public function index()
    {
        $this->load->model("food_stuffs_model");
        $this->load->model("posts_model");
        $this->load->model("parts_model");
        $this->load->helper("my_helper");

        $data["categories"]         = $this->food_categories_model->get_food_categories();
        $data["random_food_stuffs"] = $this->food_stuffs_model->get_random_sample(10);
        $data["last_posts"]         = $this->posts_model->get_last_posts(6);
        $data["last_comments"]      = $this->posts_model->get_last_comments(6);
        $data["most_read_posts"]    = $this->posts_model->get_most_read_posts(6);
        $data["parts"]              = $this->parts_model->get_parts();
        $this->header();
        $this->load->view("main/home/slideShow");
        $this->load->view("main/home/content", $data);
        $this->footer();
    }
    // ------------------------------------------
    /* تسجيل الخروج: تفريغ السيشن وإعادة توجيه */

    function login()
    {
        $err = "";
        $this->load->model("users_model");
        $user_name     = $this->input->post('user_name');
        $user_password = $this->input->post('user_password');

        if (!$user_name) $err .= "<p>لم تدخل اسم المستخدم</p>";
        if (!$user_password) $err .= "<p>لم تدخل كلمة المرور</p>";
        if ($err != "") {
            echo "<div class='alert alert-danger'>" . $err . "</div>";
            return;
        }
        $sha1_password = sha1((string)$user_password); 
        //echo '<pre>'; print_r($user_name.','. $sha1_password); echo '</pre>'; die();
        $data['user'] = $this->users_model->check_login_data($user_name, $sha1_password);
        if ($data['user']) {
            $user_data = [
                'logged_in'       => TRUE,
                "user_id"         => $data['user'][0]->user_id,
                "user_name"       => $data['user'][0]->user_name,
                "user_photo"      => $data['user'][0]->user_photo,
                "user_last_login" => $data['user'][0]->user_last_login,
                "user_role"       => $data['user'][0]->user_role,
                "user_active"     => $data['user'][0]->user_active
            ];
            $this->session->set_userdata($user_data);
            echo "true";
        } else echo "<p class='alert alert-danger'>بيانات دخول غير صحيحة</p>";

    }
    // ------------------------------------------
    /* صفحة تفعيل العضوية */

    function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url());
    }
    // ------------------------------------------
    /* رابط تفعيل العضو الوارد من بريده */

    function active_page()
    {
        if (!$this->session->logged_in) {
            $this->error("غير مخول بالدخول لهذا الرابط. يجب أن تسجل الدخول أولاً");
            return;
        }
        $this->load->model("users_model");
        $data['user'] = $this->users_model->get_user($this->session->user_id);
        $this->header("تفعيل العضو");
        $this->load->view("main/user/active_page", $data);
        $this->footer();
    }

    // ------------------------------------------

    function active($code)
    {
        $this->load->model('users_model');
        $data['user'] = $this->users_model->active($code);

        if ($data['user']) {
            // login ------
            if ($data['user']) {
                $user_data = [
                    'logged_in'       => TRUE,
                    "user_id"         => $data['user'][0]->user_id,
                    "user_name"       => $data['user'][0]->user_name,
                    "user_photo"      => $data['user'][0]->user_photo,
                    "user_last_login" => $data['user'][0]->user_last_login,
                    "user_role"       => $data['user'][0]->user_role,
                    "user_active"     => $data['user'][0]->user_active
                ];
                $this->session->set_userdata($user_data);

            }
            // -------------
            $this->header("تم تفعيل حسابك");
            $this->load->view('main/user/active_done', $data);
            $this->footer();
        } else $this->error("لم يتم تفعيل حسابك! إذا كان لديك مشكلة راسل إدارة الموقع");


    }
    // ------------------------------------------
    /* التغذية الإخبارية RSS feed */

    function test()
    {
        echo '<meta charset="utf-8" />';
        echo '<form action="" method="post" accept-charset="UTF-8" >';
        echo '<input type="text" value="زهير" name="zz" />';
        echo '<button type="submit">submit</button>';
        echo '</form>';

        if ($_POST) {
            echo $this->input->post('zz');
        }
    }
// ------------------------------------------
    /*  الوضع الصحي */

    function rss()
    {
        $this->load->helper("my_helper");
        $this->load->model("posts_model");
        $data["last_posts"] = $this->posts_model->get_last_posts(6);
        $data["options"]    = $this->options_model->get_options();
        $this->load->view("main/post/rss", $data);
    }

    // ------------------------------------------
    /* صفحة الخطأ */

    function BMI()
    {
        $this->header("الوضع الصحي");
        $this->load->view('main/page/bmi');
        $this->footer();
    }
}
