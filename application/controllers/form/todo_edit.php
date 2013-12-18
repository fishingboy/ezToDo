<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Todo_edit extends CI_Controller 
{
    public $debug_info;

	public function __construct()
	{
		parent::__construct();
        $this->load->library("parser");
		$this->load->model("todo_model");
	}

    /**
     * 編輯畫面
     */
	public function index($todoID=0)
	{
        // 取得工作
        $todo = $this->todo_model->get_todo($todoID);

        // 整理 view data
        $view_data = array
        (
            'todoID'      => $todo->todoID,
            'todo_title'  => $todo->title,
            'todo_note'   => $todo->note,
            'todo_status' => $todo->status,
            'todo_sn'     => $todo->sn,
            'todo_hours'  => ($todo->hours) ? $todo->hours : '',
        );

        // 呼叫 view
		$this->parser->parse("form/todo_edit_view", $view_data);
	}

    /**
     * 編輯送出
     */
    public function submit($todoID=0)
    {
        // 取得參數
        $fmTitle  = $this->input->post('fmTitle');
        $fmNote   = $this->input->post('fmNote');
        $fmHours  = $this->input->post('fmHours');
        $fmStatus = $this->input->post('fmStatus');
        $fmSN     = $this->input->post('fmSN');

        // 整理新增資料
        $insert_data = array
        (
            'title'      => $fmTitle,
            'note'       => $fmNote,
            'hours'      => $fmHours,
            'status'     => 1,
            'updateTime' => date('Y-m-d H:i:s'),
            'sn'         => ($fmStatus) ? $fmSN : 99999999
        );

        // 寫入工作
        $this->todo_model->add_todo($todoID, $insert_data);

        // 畫面重整
        echo "<script>parent.location.reload(true);</script>";
    }

    /**
     * 刪除工作
     */
    public function del($todoID)
    {
        $this->todo_model->del_todo($todoID);
        $sql = $this->db->last_query();
        $ret = array('status' => TRUE, 'sql' => $sql,  'msg' => '刪除完畢!');
        echo json_encode($ret);
    }

    public function sort($todoID, $sn)
    {
        $this->todo_model->sort_todo($todoID, $sn);
        $ret = array('status' => TRUE, 'msg' => '排序完畢!', 'debug_info' => $this->debug_info);
        echo json_encode($ret);
    }
}
