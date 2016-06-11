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
    /* الرئيسة */

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
    /* الصفحات */

    function header($title = null)
    {
        $data["options"]    = $this->options_model->get_options();
        $data["categories"] = $this->food_categories_model->get_food_categories();
        $data["pages"]      = $this->pages_model->getPages();
        $data["parts"]      = $this->parts_model->get_parts();
        $data["title"]      = $title;
        if ($this->session->logged_in) {
            $this->load->model("posts_model");
            $data["counts"] = $this->posts_model->user_count_posts_comments($this->session->user_id);
        }

        $this->load->view("main/template/header", $data);
    }
    // ------------------------------------------
    /* عرض التنبيهات والأخطاء */

    function footer()
    {
        $data["options"] = $this->options_model->get_options();
        $this->load->view("main/template/footer", $data);
        $this->options_model->add_visit();
    }
    // ------------------------------------------

    /* الهيدر */

    function about()
    {
        /* http://themes.getbootstrap.com/ */
    }

    // ------------------------------------------
    /* الفوتر */

    function contact_us()
    {
        $this->header("اتصل بنا");
        $this->load->view("main/contact/view");
        $this->footer();
    }

    // ------------------------------------------

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
    /* صفحة فورم اتصل بنا */

    function categories()
    {
        $data["categories"] = $this->food_categories_model->get_food_categories();
        $this->header("التصنيفات الغذائية");
        $this->load->view("main/categories/view_all", $data);
        $this->footer();
    }
    // ------------------------------------------
    /* إرسالة الرسالة */

    function category($id)
    {
        $this->load->model("food_stuffs_model");
        $data["food_stuffs"] = $this->food_stuffs_model->get_food_stuffs_of_category($id);
        if (!$data["food_stuffs"]) {
            $this->alert("رابط التصنيف الذي طلبته غير موجود أو أنه لايوجد فيه مواد غذائية بعد");
            return;
        }
        $data["id"] = $id;
        $this->header($data["food_stuffs"][0]->fc_title);
        $this->load->view("main/categories/view", $data);
        $this->footer();
    }

    // ------------------------------------------
    /* التصنيفات الغذائية */

    /* عرض كافة التصنيفات */

    function alert($msg = "")
    {
        $this->header($msg);
        $data["error"] = $msg;
        $this->load->view('main/alert/view', $data);
        $this->footer();
    }
    // ------------------------------------------

    /* عرض تصنيف */

    function food($id)
    {
        $this->load->model("food_stuffs_model");
        $data["food_stuff"] = $this->food_stuffs_model->get_food_stuff($id);
        if (!$data["food_stuff"]) {
            $this->alert("لايوجد مادة غذائية بالرابط المطلوب");
            return;
        }
        $data["id"] = $id;
        $this->header($data["food_stuff"][0]->f_title);
        $this->load->view("main/food_stuff/view", $data);
        $this->footer();
    }
    // ------------------------------------------
    /* المواد الغذائية */

    function parts()
    {
        $data['parts'] = $this->parts_model->get_parts_with_last_post();
        $this->header("أقسام الموقع");
        $this->load->view("main/part/view_parts", $data);
        $this->footer();
    }

    // ------------------------------------------
    /* أقسام الموقع */

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
            $this->alert("رابط قسم خاطئ أو قسم فارغ");
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

    /* عند فتح قسم يظهر فيه مقالاته كروابط */

    function post($id)
    {

        $this->load->model("posts_model");
        $data["post"] = $this->posts_model->get_post($id);
        if (!$data["post"]) {
            $this->alert("لايوجد مقال بالرابط المطلوب");
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
    /* عرض مقال */

    function add_post()
    {
        if (!$this->session->logged_in) {
            $this->alert("هذه الصفحة تحتاج صلاحيات عضو. قم بتسجيل الدخول أو سجل عضوية جديدة إن كنت جديداً");
            return;
        }
        $this->load->model("parts_model");
        $data['parts'] = $this->parts_model->get_parts();

        $this->header("إضافة مقال جديد");
        $this->load->view("main/post/add", $data);
        $this->footer();
    }
    // ------------------------------------------
    /* إضافة مقال جديد */

    function insert_post()
    {
        if (!$this->session->logged_in) {
            $this->alert("هذه الصفحة تحتاج صلاحيات عضو. قم بتسجيل الدخول أو سجل عضوية جديدة إن كنت جديداً");
            return;
        }
        /* تفحص قيم المقال من طرف السيرفر (تم فحصها من طرف العميل أيضاً) */
        $error = "";
        if (!$this->input->post('post_title')) $error .= "لم تدخل العنوان ";
        if (!$this->input->post('post_part')) $error .= "لم تحدد القسم";
        if (!$this->input->post('post_content')) $error .= "لم تكتب محتوى للمقال";
        if (!$this->input->post('post_tags')) $error .= "لم تضف الكلمات الدلالية";
        if ($error != "") {
            $this->alert("لديك الأخطاء التالية: " . $error);
            return;
        }

        $this->load->model("posts_model");
        $data = [
            "post_title"     => $this->input->post('post_title'),
            "post_part_id"   => $this->input->post('post_part'),
            "post_content"   => $this->input->post('post_content'),
            "post_tags"      => $this->input->post('post_tags'),
            "post_author_id" => $this->input->post('author_id'),
            "post_visits"    => 0,
            "post_approved"  => 0
        ];
        $this->posts_model->add_post($data);
        $this->alert("تم إضافة المقال " . $data["post_title"] . " سيظهر بعد موافقة الإدارة ");
    }

    // ------------------------------------------
    /* إدخال المقال إلى قاعدة البيانات */

    function user_posts()
    {
        if (!$this->session->logged_in) {
            $this->alert("هذه الصفحة خاصة بالأعضاء. قم بالانضمام إلينا عبر التسجيل أو سجل دخولك إن كنت عضواً في موقعنا");
            return;
        }
        $user_id = $this->session->user_id;
        $this->load->model("posts_model");
        $data["posts"] = $this->posts_model->get_user_posts($user_id);
        $this->header("مقالاتي");
        $this->load->view("main/post/user_posts", $data);
        $this->footer();
    }
    // ------------------------------------------
    /* عرض مقالات المستخدم */

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
    /* إضافة تعليق */

    function user_comments()
    {
        if (!$this->session->logged_in) {
            $this->alert("هذه الصفحة خاصة بالأعضاء. قم بالانضمام إلينا عبر التسجيل أو سجل دخولك إن كنت عضواً في موقعنا");
            return;
        }
        $user_id = $this->session->user_id;
        $this->load->model("posts_model");
        $data["comments"] = $this->posts_model->get_user_comments($user_id);
        $this->header("تعليقاتي");
        $this->load->view("main/post/user_comments", $data);
        $this->footer();
    }
    // ------------------------------------------
    /* تعليقات المستخدم */

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
    /* البحث  */

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
                        $this->alert("لم يتم التسجيل");
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
                $this->alert("لم تدخل كافة البيانات");
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
    /* المستخدمين */

    /* تسجيل عضوية جديدة */

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

    /* تسجيل الدخول */

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
            $u          = $data['user'][0];
            $role_admin = false;
            if ($u->user_role == "admin")
                $role_admin = true;
            $user_data = [
                'logged_in'       => TRUE,
                'logged_in_admin' => $role_admin,
                "user_id"         => $u->user_id,
                "user_name"       => $u->user_name,
                "user_photo"      => $u->user_photo,
                "user_last_login" => $u->user_last_login,
                "user_role"       => $u->user_role,
                "user_active"     => $u->user_active
            ];
            $this->session->set_userdata($user_data);
            echo "true";
        } else echo "<p class='alert alert-danger'>بيانات دخول غير صحيحة</p>";

    }
    // ------------------------------------------

    /* تسجيل الخروج: تفريغ السيشن وإعادة توجيه */
    function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url());
    }
    // ------------------------------------------

    /* صفحة تفعيل العضوية */
    function active_page()
    {
        if (!$this->session->logged_in) {
            $this->alert("غير مخول بالدخول لهذا الرابط. يجب أن تسجل الدخول أولاً");
            return;
        }
        $this->load->model("users_model");
        $data['user'] = $this->users_model->get_user($this->session->user_id);
        $this->header("تفعيل العضو");
        $this->load->view("main/user/active_page", $data);
        $this->footer();
    }

    // ------------------------------------------
    /* رابط تفعيل العضو الوارد من بريده */
    function active($code)
    {
        $this->load->model('users_model');
        $data['user'] = $this->users_model->active($code);

        if ($data['user']) {
            // login ------
            if ($data['user']) {
                $u = $data['user'][0];
                if ($u->user_role == "admin") $role_admin = true;
                else $role_admin = false;
                $user_data = [
                    'logged_in'       => true,
                    'logged_in_admin' => $role_admin,
                    "user_id"         => $u->user_id,
                    "user_name"       => $u->user_name,
                    "user_photo"      => $u->user_photo,
                    "user_last_login" => $u->user_last_login,
                    "user_role"       => $u->user_role,
                    "user_active"     => $u->user_active
                ];
                $this->session->set_userdata($user_data);

            }
            // -------------
            $this->header("تم تفعيل حسابك");
            $this->load->view('main/user/active_done', $data);
            $this->footer();
        } else $this->alert("لم يتم تفعيل حسابك! إذا كان لديك مشكلة راسل إدارة الموقع");


    }
    // ------------------------------------------
    /* لتجريب بعض الأمور */

    function test()
    {
        if (mail('info@webcode-sy.com', 'the subject', 'the message'))
            echo "yes";
        else echo "no";
    }
// ------------------------------------------
    /*  الخلاصة الإخبارية RSS */

    function rss()
    {
        $this->load->helper("my_helper");
        $this->load->model("posts_model");
        $data["last_posts"] = $this->posts_model->get_last_posts(6);
        $data["options"]    = $this->options_model->get_options();
        $this->load->view("main/post/rss", $data);
    }

    // ------------------------------------------
    /* Bbody Mass Index مؤشر كتلة الجسم */

    function BMI()
    {
        $this->header("الوضع الصحي");
        $this->load->view('main/page/bmi');
        $this->footer();
    }
    // ------------------------------------------

}