<?php
/**
 * Created by PhpStorm.
 * User: zuhair
 * Date: 21/04/2016
 * Time: 02:06 ص
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Pages_model extends CI_Model
{
    /* جلب الصفحات */
    function getPages()
    {
        $sql = "
        SELECT page_id,page_title,page_created_at,page_level,page_updated_at
        FROM pages
        ORDER BY page_level ASC
      ";
        return $this->db->query($sql)->result();
    }

    /* إضافة صفحة */
    function addPage($data)
    {
        $this->db->insert("pages", $data);
    }

    /* جلب محتوى صفحة */
    function getPageBodyEdt($id)
    {
        $q = $this->db->where('page_id', $id)->get('pages')->row();
        return $q->page_content;
    }

    /* تحديث صفحة */
    function updatePage($id, $data)
    {
        $this->db->where('page_id', $id);
        $this->db->update('pages', $data);
    }

    /* حذف صفحة */
    function deletePage($id)
    {
        $this->db->where('page_id', $id);
        $this->db->delete('pages');
    }

    /* جلب صفحة */
    function getPage($id)
    {
        $sql = "
        SELECT *
        FROM pages
        WHERE page_id<=>$id
        ORDER BY page_level ASC
      ";
        return $this->db->query($sql)->result();
    }

}
