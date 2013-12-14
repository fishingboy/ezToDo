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
		$data = $this->todo_model->get_list();
		$content = $this->parser->parse("show_view", array('data' => $data), true);
	    $this->parser->parse("main_view", array('content' => $content));
	}

	public function get_def()
	{
		$a = get_defined_constants('user');
		echo "<pre>" . print_r($a, TRUE). "</pre>";
	}
}
