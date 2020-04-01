<?php 

class Blog_model extends CI_Model{
    
    public function getBlogs($limit, $offset)
    {
        $filter = $this->input->get('search');
        $this->db->like('title', $filter);
        $this->db->or_like('content', $filter);

        $this->db->limit($limit, $offset);
        $this->db->order_by('date', 'desc');

        $query = $this->db->get("blog");
        return $query;
    }

    public function getTotalBlogs()
    {
        $filter = $this->input->get('search');
        $this->db->like('title', $filter);
        $query = $this->db->count_all_results("blog");
        return $query;
    }

    public function getSingleBlog($field, $value)
    {
        $this->db->where($field, $value);
        return $this->db->get("blog");
    }

    public function insertBlog($title, $url, $content, $cover){
        $this->db->query("INSERT INTO blog (title, url, content, cover) VALUES ('$title', '$url', '$content', '$cover')");
        return $this->db->insert_id();
    }

    public function updateBlog($id, $title, $url, $content, $cover){
        $this->db->query("UPDATE blog SET title = '$title', url = '$url', content = '$content', cover = '$cover' WHERE id = '$id'");
        return $this->db->affected_rows();
    }

    public function deleteBlog($id){
        $this->db->query("DELETE FROM blog WHERE id = '$id'");
        return $this->db->affected_rows();
    }
}

?>