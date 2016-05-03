<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Food_categories_model extends CI_Model
{
    /* جلب التصنيفات */
    function get_food_categories()
    {
        $sql = "
        SELECT c.*, COUNT(s.f_id) AS num_foods
        FROM food_stuffs AS s
          INNER JOIN food_categories AS c
            ON (s.f_category_id = c.fc_id)
        GROUP BY c.fc_title
        ORDER BY fc_level ASC
            ";
        return $this->db->query($sql)->result();
    }

    /* إضافة تصنيف */
    function add_food_category($data)
    {
        $this->db->insert("food_categories", $data);
    }

    /* تحديث تصنيف */
    function update_food_category($data, $id)
    {
        $this->db->where('fc_id', $id);
        $this->db->update('food_categories', $data);
    }

    /* حذف تصنيف */
    function delete_food_category($id)
    {
        $this->db->where('fc_id', $id);
        $this->db->delete('food_categories');
    }

}
