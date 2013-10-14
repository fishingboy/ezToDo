<?php
class Todo_model extends CI_Model
{
    public function get_list()
    {
        $sql = "SELECT * FROM `todo` ORDER BY id ASC";
        $query = $this->db->query($sql);
        return $query->result();
    }
}