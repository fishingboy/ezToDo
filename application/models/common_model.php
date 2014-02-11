<?php
class Common_model extends CI_Model
{
    var $_CI;

    public function __construct()
    {
        $_CI = & get_instance();
        $this->page_init();
    }

    /**
     * 登入狀態
     */
    public function page_init()
    {
        // 判斷是否已登入
        if ($this->session->userdata('account'))
        {
            define('USER_ACCOUNT', $this->session->userdata('account'));
        }

        // 觀察者模式
        if ($this->input->get('visit') == 1 || $this->session->userdata('visit_mode') == 1)
        {
            define('VISIT_MODE', 1);
            $this->session->set_userdata('visit_mode', 1);
        }
        else
        {
            define('VISIT_MODE', 0);
            $this->session->set_userdata('visit_mode', 0);
        }
    }
}