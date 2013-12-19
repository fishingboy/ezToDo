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
		$status = $this->input->get('status');
        $status = ($status !== FALSE) ? $status : 1;
		$data = $this->todo_model->get_list($status);
		$view_data = array
		(
			'status' => $status,
			'data'   => $data
		);
		$content = $this->parser->parse("page/content_view", $view_data, true);
	    $this->parser->parse("page/main_view", array('content' => $content));
	}

	public function get_def()
	{
		$a = get_defined_constants('user');
		echo "<pre>" . print_r($a, TRUE). "</pre>";
	}
}
