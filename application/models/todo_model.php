<?php
class Todo_model extends CI_Model
{
    private $_CI;

    public function __construct()
    {
        $this->_CI = & get_instance();
    }

    /**
     * 取得工作列表
     */
    public function get_list($status=1)
    {
        $status = ($status) ? $status : 0;
        $order = ($status == 1) ? "sn, todoID" : "completeTime DESC, updateTime DESC";
        $sql = "SELECT * FROM `todo` WHERE status=? AND userID=? ORDER BY {$order}";
        $query = $this->db->query($sql, array($status, USER_ID));
        $result = $query->result();


        // 加上完工時間
        $this->load->library('worktime');
        foreach ($result as $key => $row)
        {
            // 開始時間為目前時間
            if ( ! isset($curr_time))
            {
                $curr_time = date('Y-m-d H:i:s');
            }

            // 取得完工時間
            $remain_time = $row->hours - $row->usedHours;
            $curr_time = $this->_CI->worktime->get_due_time($curr_time, $remain_time);
            $result[$key]->due_time = $curr_time;
            $result[$key]->due_weekday = $this->_CI->worktime->get_week_name($curr_time);
        }

        return $result;
    }

    /**
     * 取得工作
     */
    public function get_todo($todoID)
    {
        if ($todoID == 0)
        {
            $this->del_tmp_todo();
            $sql = "INSERT INTO `todo` SET createTime=now(), userID=?";
            $query = $this->db->query($sql, array(USER_ID));
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
        if (is_array($todoID))
        {
            $this->db->where_in('todoID', $todoID)->delete('todo');
        }
        else
        {
            $this->db->where('todoID', $todoID)->delete('todo');
        }

        // 重新排序
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
        $sql = "UPDATE `todo` SET sn=? WHERE todoID=? AND userID=?";
        $this->db->query($sql, array($sn, $todoID, USER_ID));

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
                            WHERE status='1' AND userID=?
                            ORDER BY sn ASC, todoID ASC
                       ) as SN
                SET T.sn = SN.rownum
                WHERE T.todoID=SN.todoID";
        $this->db->query($sql, array(USER_ID));
        return TRUE;
    }
}