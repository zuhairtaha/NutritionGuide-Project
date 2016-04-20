<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Control extends CI_Controller
{
    // قالب لوحة التحكم
    // هيدر لوحة التحكم ويمرر له العنوان
    function header($title = "لوحة تحكم موقع الدليل الغذائي")
    {
        $data['title'] = $title;
        // جلب رابط الصفحة الحالية وتمريره إلى متغير في جافا سكربت بهدف تلوين خلفية زر الصحفة التي نحن فيها عن طريق جي كويري
        $data['segment1'] = $this->uri->segment(1) ? $this->uri->segment(1) : "index";
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
        $this->load->view('control/options');
        $this->footer();
    }

    function options_update()
    {

    }
    // -------------------------------------------------------
    /* التصنيفات الأساسية للغذاء */
    function food_categories()
    {

    }

    // -------------------------------------------------------
    /* المواد الغذائية */
    function food_stuffs()
    {

    }

    // -------------------------------------------------------
    /* أقسام الموقع: نصائح غذائية , نصائح عامة, معلومات إثرائية */
    function categories()
    {

    }

    /* المواضيع \المنشورات في أقسام الموقع  */
    function posts()
    {

    }
    // -------------------------------------------------------
    /* الصفحات: الهرم الغذائي, من نحن, اتصل بنا... */

    function pages()
    {

    }
    // -------------------------------------------------------
    // الأعضاء
    function users()
    {

    }

    function logout()
    {

    }

    function comments()
    {

    }

    // -------------------------------------------------------
    /* التعليقات */

}
