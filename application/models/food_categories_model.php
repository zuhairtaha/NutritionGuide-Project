<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Food_categories_model extends CI_Model
{
    /* جلب التصنيفات */
    function get_food_categories()
    {
        $this->db->order_by("fc_level");
        $q = $this->db->get("food_categories");
        if ($q->num_rows() > 0) return $q->result();
        else return false;
    }

    /* إضافة تصنيف */
    function add_food_category($data)
    {
        $this->db->insert("food_categories", $data);
    }

    /* تحديث تصنيف */
    function update_food_category($id, $data)
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
