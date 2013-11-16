<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Todo_edit extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("todo_model");
	}

	public function index()
	{
		echo '編輯畫面';
	}
}
