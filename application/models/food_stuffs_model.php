<?php

class Food_stuffs_model extends CI_Model
{
    /* جلب المواد ال    غذائية */
    function get_food_stuffs($offset, $limit)
    {
        return $this->db->query("
        SELECT fc.fc_title , fs.*
        FROM food_stuffs AS fs
        INNER JOIN food_categories AS fc
        ON (fs.f_category_id = fc.fc_id)
        ORDER BY fs.f_id DESC
        LIMIT $offset, $limit
        ")->result();
    }

    /* جلب عدد سجلات الجدول الكلية */
    function count_food_stuffs()
    {
        $sql = "SELECT count(*) total FROM food_stuffs ";
        return $this->db->query($sql)->result();
    }

    /* جلب مادة غذاية حسب الآي دي */
    function get_food_stuff($id)
    {
        $sql = "
                SELECT food_stuffs.* , food_categories.fc_title
                FROM food_stuffs INNER JOIN food_categories
                ON (food_stuffs.f_category_id = food_categories.fc_id)
                WHERE (food_stuffs.f_id <=>$id)
            ";
        return $this->db->query($sql)->result();
    }

    /* تعديل مادة غذائية */
    function update_food_stuff($data, $id)
    {

        $this->db->where('f_id', $id)->update('food_stuffs', $data);
    }

    /* إضافة مادة غذائية */
    function add_food_stuff($data)
    {
        $this->db->insert("food_stuffs", $data);
    }

    /* حذف مادة غذائية */
    function delete_food_stuff($id)
    {
        $this->db->where('f_id', $id)->delete('food_stuffs');
    }

    /* جلب عينة عشوائية */
    function get_random_sample($limit)
    {
        $sql = " SELECT f_title, f_image, f_id FROM food_stuffs ORDER BY RAND() LIMIT $limit ";
        return $this->db->query($sql)->result();
    }

    /* جلب المواد الغذائية الموجودة في تصنيف ما له الآي دي الممرر */
    function get_food_stuffs_of_category($id)
    {
        $sql = "
                SELECT
                s.f_id
                , s.f_title
                , s.f_image
                , c.fc_title
            FROM
                food_stuffs AS s
                INNER JOIN food_categories AS c
                    ON (s.f_category_id = c.fc_id)
            WHERE (s.f_category_id <=>$id)
            ";
        return $this->db->query($sql)->result();
    }

    /* البحث عن مواد غذائية حسب كلمة نص معين */
    function search($key)
    {
        $sql = "
                SELECT s.f_id , s.f_title , s.f_image , c.fc_title
                FROM
                food_stuffs AS s
                INNER JOIN food_categories AS c
                    ON (s.f_category_id = c.fc_id)
            WHERE (s.f_title LIKE '%$key%')";
        $q   = $this->db->query($sql);
        if ($q->num_rows() > 0)
            return $q->result();
        else return false;
    }

}