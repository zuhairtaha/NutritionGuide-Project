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
}