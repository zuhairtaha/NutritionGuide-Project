<?php

class options_mdl extends CI_Model
{

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
}

?>