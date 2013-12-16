<?php
class Todo_model extends CI_Model
{
    /**
     * 取得工作列表
     */
    public function get_list()
    {
        $sql = "SELECT * FROM `todo` WHERE status='1' ORDER BY sn, id ASC";
        $query = $this->db->query($sql);
        return $query->result();
    }

    /**
     * 取得工作
     */
    public function get_todo($todoID)
    {
        if ($todoID == 0)
        {
            $this->del_tmp_todo();
            $sql = "INSERT INTO `todo` SET createTime=now()";
            $query = $this->db->query($sql);
            $todoID = $this->db->insert_id();
        }

        $sql = "SELECT * FROM `todo` WHERE id=?";
        $query = $this->db->query($sql, array($todoID));
        return $query->row();
    }

    /**
     * 新增工作
     */
    public function add_todo($todoID, $data)
    {
        $this->db->where('id', $todoID)->update('todo', $data); 
        return $this->db->insert_id();
    }

    /**
     * 刪除工作
     */
    public function del_todo($todoID)
    {
        $this->db->where('id', $todoID)->delete('todo'); 
        return TRUE;
    }

    /**
     * 刪除多餘工作
     */
    public function del_tmp_todo()
    {
        $this->db->where('status', 0)->delete('todo'); 
        return TRUE;
    }
}