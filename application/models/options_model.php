<?php

class options_model extends CI_Model
{
    /* جلب إعدادات الموقع (اسم, وصف, صفحات التواصل الاجتماعي) */
    public function get_options()
    {
        return $this->db->query("
        SELECT * FROM options
    ")->result();
    }

    /* تحديث إعدادات الموقع */
    public function update_options($ins_data)
    {
        $this->db->where('id', 1)
            ->update('options', $ins_data);
    }

    /* إضافة تسجيلة عند كل زيارة للموقع */
    function add_visit()
    {
        $data = array(
            'visit_date' => date("Y-m-d H:m:s"),
            'visitor_ip' => $this->input->ip_address()
        );
        $this->db->insert('statistics', $data);
    }

    /* المتواجدون الآن: عملياً المتواجدون آخر خمس دقائق */
    function online()
    {
        $sql = "
        SELECT count( visit_date ) AS online
        FROM statistics
        WHERE visit_date >= (
        SELECT DATE_SUB( MAX( visit_date ) , INTERVAL 5
        MINUTE )
        FROM statistics )
    ";
        $q   = $this->db->query($sql);
        return $q->result();
    }

    /* جلب إحصائيات الزوار لآخر 15 يوم */
    function get_statistics()
    {
        $sql = "
            SELECT
              DATE(visit_date) AS d,
              COUNT(DISTINCT (visitor_ip)) AS h ,
              COUNT(visitor_ip) AS h2
            FROM
              `statistics`
            GROUP BY d
            ORDER BY d DESC
            LIMIT 0, 15
    ";
        $q   = $this->db->query($sql);
        return $q->result();

    }

    /* إحصاء عدد الأعضاء */
    function users_count()
    {
        return $this->db->count_all_results('users');
    }

    /* إحصاء عدد المقالات */
    function posts_count(){
        return $this->db->count_all_results('posts');
    }

    /* إحصاء عدد التعليقات */
    function comments_count(){
        return $this->db->count_all_results('comments');
    }

}