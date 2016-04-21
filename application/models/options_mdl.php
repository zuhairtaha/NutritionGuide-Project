<?php

class options_mdl extends CI_Model
{
    // -------------------------------------------------------
    /*����� ������� � ������� ����� ������� ������*/
    public function select_options()
    {
        return $this->db->query("
        SELECT * FROM options
    ")->result();
    }

    public function update_options($ins_data)
    {
      
        $this->db->where('id', 1)->update('options', $ins_data);
    }
    // -------------------------------------------------------
    /*����� ������� � ������� � ������� ����� ��������� */
    public function select_food_categories()
    {
        return $this->db->query("
        SELECT * FROM food_categories
    ")->result();
    }
    
    public function update_food_categories($ins_data, $id)
    {
      
        $this->db->where('id', $id)->update('food_categories', $ins_data);
    }
    
    public function insert_food_categories($ins_data)
    {
        $query = 'INSTERT INTO food_categories (';
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
    // -------------------------------------------------------
    /*����� ������� � ������� � ������� ����� ������*/
    public function select_food_stuffs()
    {
        return $this->db->query("
        SELECT * FROM food_stuffs
    ")->result();
    }
    
    public function update_food_stuffs($ins_data, $id)
    {
      
        $this->db->where('id', $id)->update('food_stuffs', $ins_data);
    }
    public function insert_food_stuffs($ins_data)
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
}

?>