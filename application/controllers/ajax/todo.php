<?php
class Todo extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ( ! $this->_check_priv())
        {
            echo json_encode(['status' => FALSE]);
            exit;
        }
    }

    public function set_sn()
    {

    }

    /**
     * 刪除 todo
     */
    public function del($ids)
    {
        $ids = explode(",", $ids);

        // 檢查是否有傳入 jobID
        if ( ! $ids || count($ids) == 0)
        {
            echo json_encode(['status' => FALSE, 'msg' => 'no todoIDs']);
            exit;
        }

        // 刪除 Job
        $this->load->model("todo_model");
        $this->todo_model->del_todo($ids);

        // 回傳訊息
        $ret = ['status' => TRUE, 'msg' => 'del success!'];
        echo json_encode($ret);
    }

    /**
     * 檢查權限(未實作)
     * @return boolean 判斷是否有權限
     */
    public function _check_priv()
    {
        return TRUE;
    }
}
