<?php

class options_mdl extends CI_Model
{
    // -------------------------------------------------------
    /*йФгхз гАчягаи Ф гАймоМк АлоФА езогогй гАЦФчз*/
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
    /*йФгхз гАчягаи Ф гАймоМк Ф гАежгщи АлоФА гАйуДМщгй */
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
    /*йФгхз гАчягаи Ф гАймоМк Ф гАежгщи АлоФА гАЦФго*/
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