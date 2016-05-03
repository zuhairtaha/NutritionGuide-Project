<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Posts_model extends CI_Model
{
    /* جلب المقالات */
    function get_posts($offset, $limit)
    {
        $sql = "
        SELECT
        parts.part_title
        , posts.post_id
        , posts.post_part_id
        , posts.post_title
        , posts.post_date
        , posts.post_visits
        , posts.post_tags
        , users.user_name
    FROM
        posts
        INNER JOIN parts
            ON (posts.post_part_id = parts.part_id)
        INNER JOIN users
        ON (posts.post_author_id = users.user_id)
        ORDER BY posts.post_id DESC
        LIMIT $offset , $limit
    ";
        return $this->db->query($sql)->result();
    }


    /* عدد كل المقالات */
    function count_total_posts()
    {
        $sql = "SELECT count(*) total FROM posts ";
        return $this->db->query($sql)->result();
    }

    /* إضافة مقال */
    function add_post($data)
    {
        $this->db->insert("posts", $data);
    }

    /* تحديث مقال */
    function update_post($data, $id)
    {
        $this->db->where('post_id', $id);
        $this->db->update('posts', $data);
    }

    /* حذف مقال */
    function delete_post($id)
    {
        $this->db->where('post_id', $id);
        $this->db->delete('posts');
    }

    /* جلب مقال حسب الآي دي (من أجل مودال التعديل) عن طريق الأجاكس */
    function get_post_by_id($id)
    {
        $sql = "SELECT post_content FROM posts WHERE post_id<=>$id";
        return $this->db->query($sql)->row("post_content");
    }

    /* جلب آخر المقالات */
    function get_last_posts($limit)
    {
        $sql = " SELECT post_id,post_title,post_content,post_date FROM posts ORDER BY post_id DESC LIMIT $limit ";
        return $this->db->query($sql)->result();
    }

    /* الأكثر قراءة */
    function get_most_read_posts($limit)
    {
        $sql = " SELECT post_id,post_title,post_content,post_visits FROM posts ORDER BY post_visits DESC LIMIT $limit ";
        return $this->db->query($sql)->result();
    }

    /* جلب مقال */
    function get_post($id)
    {
        $sql = "
                SELECT posts.* , parts.part_id , parts.part_title , users.user_name
                FROM posts
                INNER JOIN parts
                ON (posts.post_part_id = parts.part_id)
                INNER JOIN users
                ON (posts.post_author_id = users.user_id)
                WHERE (posts.post_id <=>$id)
            ";
        $q   = $this->db->query($sql);
        if ($q->num_rows() > 0) {
            $this->db->query("UPDATE posts SET post_visits = post_visits + 1 WHERE post_id = $id");
            return $q->result();
        } else return false;
    }

    /* البحث عن المقالات التي تحوي نص معين */
    function search($key)
    {
        $sql = "
                SELECT parts.part_title , posts.* , users.user_name, parts.part_image
                FROM posts
                INNER JOIN parts
                ON (posts.post_part_id = parts.part_id)
                INNER JOIN users
                ON (posts.post_author_id = users.user_id)
                WHERE (posts.post_title LIKE '%$key%'
                OR posts.post_content LIKE '%$key%'
                OR posts.post_tags LIKE '%$key%')
                LIMIT 10
    ";
        $q = $this->db->query($sql);
        if ($q->num_rows() > 0) return $q->result();
        else return false;
    }


}