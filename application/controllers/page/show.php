<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Show extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("todo_model");
	}

	public function index()
	{
		// 篩選狀態
		$status = $this->input->get('status');
        $status = ($status !== FALSE) ? $status : 1;

        // 取得資料
		$data = $this->todo_model->get_list($status);

		// 資料處理
		for ($i=0, $i_max=count($data); $i < $i_max; $i++) 
		{ 
            $data[$i]->note         = $this->_note($data[$i]->note);
            $data[$i]->createTime   = $this->_time($data[$i]->createTime);
            $data[$i]->hours        = ($data[$i]->hours) ? floatval($data[$i]->hours) : '-';
            $data[$i]->usedHours    = ($data[$i]->usedHours) ? floatval($data[$i]->usedHours) : '-';
            $data[$i]->surplusHours = ($data[$i]->hours != '-') ? $data[$i]->hours - floatval($data[$i]->usedHours) : '-';
		}

		// 整理 view data
		$view_data = array
		(
			'status' => $status,
			'data'   => $data
		);

		// 顯示
		$content = $this->parser->parse("page/content_view", $view_data, true);
	    $this->parser->parse("page/main_view", array('content' => $content));
	}

    /**
     * 描述處理
     */
    private function _note($str)
    {
        return ($str == "") ? "無" : nl2br(htmlspecialchars($str));
    }

    /**
     * 時間處理
     */
    private function _time($time)
    {
        return substr($time, 5, 11);
    }

	public function get_def()
	{
		$a = get_defined_constants('user');
		echo "<pre>" . print_r($a, TRUE). "</pre>";
	}
}
