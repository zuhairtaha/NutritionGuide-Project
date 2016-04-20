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
        $this->load->model('options_mdl') ;
        $data['options'] = $this->options_mdl->select_options() ; 
        $this->load->view('control/options' , $data );
        $this->footer();
    }

    function update_settings()
    {
        
        $this->header("تحديث_الإعدادات");
        
        $this->load->model('options_mdl') ;
        $ins_data = array(
            'site_name' => $_POST['siteName'], 
            'site_tags' => '' , 
            'site_description' => $_POST['siteDesc'],
            'facebook'=> $_POST['facebook'], 
            'twitter'=> $_POST['twitter'],
            'youtube'=> $_POST['youtube']
        );
        
        $this->options_mdl->update_options($ins_data) ; 
        echo 'تم تحديث الإعدادات ' ;
        
                $this->footer();

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
