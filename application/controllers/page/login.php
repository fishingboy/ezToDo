<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
        $this->load->model("login_model");
        $this->load->model("login_model");
	}

	public function index()
	{
        $fmSubmit = $this->input->post('fmSubmit');
        if ($fmSubmit == 'ok')
        {
            $account  = $this->input->post('fmAccount');
            $password = $this->input->post('fmPassword');
            $back_url = $this->input->post('fmBackUrl');
            $user_data = $this->login_model->check_login_password($account, $password);
            if ($user_data !== false)
            {
                $this->session->set_userdata($user_data);
                header("Location: {$back_url}");
                exit;
            }
        }

        $back_url = $this->input->get('back_url');
        $this->parser->parse("page/login_view", array('back_url' => $back_url));
    }

    public function test()
    {
        echo $this->session->userdata('account') . "<br>";
        echo $this->session->userdata('password') . "<br>";
    }

    public function logout()
    {
        $this->session->sess_destroy();
        header("Location: /");
    }
}
