<?php
   class options_mdl extends CI_Model{
        
        public function select_options(){  
            $sel_query = $this->db->query("SELECT * FROM options")  ; 
            $result = $sel_query->result_array() ; 
            return $result ;           
        }
        
        public function update_options($ins_data){
            //echo '<pre>'; print_r($ins_data);
            $this->db->where('id' , 1 ) -> 
            update('options' , $ins_data) ; 
        }
        }
?>