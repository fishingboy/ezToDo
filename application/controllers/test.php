<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->load->database();
	}
	public function index()
	{
		echo "hello world!";

		$sql = "SELECT * FROM `visit_log` Limit 10";
		$query = $this->db->query($sql);
		echo "<pre>" . print_r($query->result(), TRUE). "</pre>";
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
