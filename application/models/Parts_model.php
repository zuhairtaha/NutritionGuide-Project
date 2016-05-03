<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Parts_model extends CI_Model
{
    /* جلب الأقسام */
    function get_parts()
    {
        $this->db->order_by("part_level");
        $q = $this->db->get("parts");
        if ($q->num_rows() > 0) return $q->result();
        else return false;
    }

    /* جلب الأقسام مع آخر مشاركة من كل قسم */
    function get_parts_with_last_post(){
        $sql = "
                  SELECT
                  table1.*,
                  posts.post_title AS last_post_title,
                  posts.post_author_id AS last_post_author_id,
                  posts.post_date AS last_post_date,
                  users.user_name AS last_post_author_name
                FROM
                  (SELECT
                    parts.*,
                    MAX(posts.post_id) last_post_id
                  FROM
                    posts
                    INNER JOIN parts
                      ON (
                        posts.post_part_id = parts.part_id
                      )
                  GROUP BY part_title
                  ORDER BY post_id ASC) table1
                  INNER JOIN posts
                    ON table1.last_post_id = posts.post_id
                  INNER JOIN users
                    ON users.user_id = posts.post_author_id
            ";
        return $this->db->query($sql)->result();
    }

    /* إضافة قسم */
    function add_part($data)
    {
        $this->db->insert("parts", $data);
    }

    /* تحديث قسم */
    function update_part($data, $id)
    {
        $this->db->where('part_id', $id);
        $this->db->update('parts', $data);
    }

    /* حذف قسم */
    function delete_part($id)
    {
        $this->db->where('part_id', $id);
        $this->db->delete('parts');
    }

    /* جلب أخبار قسم */
    function get_posts_of_part($id, $offset, $limit)
    {
        $sql = "
                SELECT parts.part_title , posts.* , users.user_name, parts.part_image
                FROM posts
                INNER JOIN parts
                ON (posts.post_part_id = parts.part_id)
                INNER JOIN users
                ON (posts.post_author_id = users.user_id)
                WHERE (parts.part_id <=>$id)
                LIMIT $offset, $limit
    ";
        return $this->db->query($sql)->result();
    }

    /* عدد المقالات في قسم */
    function count_total_rows_of_part($id)
    {
        $sql = " SELECT COUNT(*) total FROM posts WHERE post_part_id<=>$id ";
        return $this->db->query($sql)->row()->total;
    }

}

?>
