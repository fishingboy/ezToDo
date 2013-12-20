<?php
class Todo_model extends CI_Model
{
    var $_CI;

    public function __construct()
    {
        $_CI = & get_instance();
    }

    /**
     * 取得工作列表
     */
    public function get_list($status=1)
    {
        if ($status)
        {
            $order = ($status == 1) ? "sn, todoID" : "completeTime DESC, updateTime DESC";
            $sql = "SELECT * FROM `todo` WHERE status='$status' ORDER BY {$order}";
        }
        else
            $sql = "SELECT * FROM `todo` WHERE status!='0' ORDER BY sn, todoID ASC";
        
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

        $sql = "SELECT * FROM `todo` WHERE todoID=?";
        $query = $this->db->query($sql, array($todoID));
        return $query->row();
    }

    /**
     * 新增工作
     */
    public function add_todo($todoID, $data)
    {
        // 更新資料
        $this->db->where('todoID', $todoID)->update('todo', $data); 

        // 重整順序
        $this->rebuild_sn();

        // 傳回 id 
        return $this->db->insert_id();
    }

    /**
     * 刪除工作
     */
    public function del_todo($todoID)
    {
        $this->db->where('todoID', $todoID)->delete('todo'); 
        $this->rebuild_sn();
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

    /**
     * 排序
     */
    public function sort_todo($todoID, $sn)
    {
        // 插入到兩點之間
        $this->_CI->debug_info['sn'] = $sn;
        
        $sn = intval($sn . '0') + 5;
        $sql = "UPDATE `todo` SET sn=? WHERE todoID=?";
        $this->db->query($sql, array($sn, $todoID));

        $this->_CI->debug_info['todoID'] = $todoID;
        $this->_CI->debug_info['update_sn'] = $sn;

        // 重整順序
        $this->rebuild_sn();
        return TRUE;
    }

    /**
     * 重新整理順序
     */
    public function rebuild_sn()
    {
        $sql = "UPDATE todo as T,
                       (
                            SELECT todoID, (@rownum := @rownum + 10) as rownum
                            FROM todo, (SELECT @rownum :=0) as R
                            WHERE status='1'
                            ORDER BY sn ASC, todoID ASC
                       ) as SN
                SET T.sn = SN.rownum
                WHERE T.todoID=SN.todoID";
        $this->db->query($sql);
        return TRUE;
    }
}