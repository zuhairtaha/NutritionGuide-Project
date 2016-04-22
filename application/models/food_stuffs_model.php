<?php

class Food_stuffs_model extends CI_Model
{
    /*توابع القراءة و التحديث و الإضافة لجدول المواد*/
    function get_food_stuffs()
    {
        return $this->db->query("
        SELECT * FROM food_stuffs
        ")->result();
    }

// ------------------------------------------
    function update_food_stuff($ins_data, $id)
    {
        $this->db->where('id', $id)->update('food_stuffs', $ins_data);
    }

// ------------------------------------------
    function add_food_stuff($ins_data)
    {
        $query = 'INSTERT INTO food_stuffs (';
        foreach ($ins_data as $key => $value) {
            $query .= '`' . $key . '`';
        }
        $query .= ') VALUES (';
        foreach ($array as $value) {
            $query .= '`' . $value . '`';
        }
        $query .= ')';

        $this->db->$query->run();
    }
    // ------------------------------------------

}