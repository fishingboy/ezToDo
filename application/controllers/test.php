<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
        $array = array
        (
            'userID'   => 1,
            'userName' => 'Leo.kuo'
        );
        $this->session->set_userdata($array);
	}

    public function get_sess()
    {
        echo $this->session->userdata('userID');
        echo $this->session->userdata('userName');
    }

    public function work()
    {
        header("Content-Type:text/html; charset=utf-8");
        $this->load->library('worktime');
        $time = "2015-08-23";
        echo "<pre>week = " . print_r($this->worktime->get_week($time), TRUE). "</pre>";

        $now = date("Y-m-d H:i:s");
        echo "now = $now <br>";
        echo "<pre>get_due_time = " . print_r($this->worktime->get_due_time($now, 2), TRUE). "</pre>";
    }
}
