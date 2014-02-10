<?php
class Login_model extends CI_Model
{
    var $_CI;

    public function __construct()
    {
        $_CI = & get_instance();
    }

    /**
     * 請先登入
     */
    public function is_login_first()
    {
        $visit = $this->input->get('visit');
        if ($visit == 1 || $this->session->userdata('visit_mode') == 1)
        {
            define('VISIT_MODE', TRUE);
        }

        if (!$this->is_login())
        {
            $this->go_login_page();
            exit;
        }
        define('USER_ACCOUNT', $this->session->userdata('account'));
    }

    /**
     * 檢查是否已登入
     */
    public function is_login()
    {
        $account = $this->session->userdata('account');
        return ($account) ? TRUE : FALSE;
    }

    /**
     * 跳到登入頁面
     */
    public function go_login_page()
    {
        $back_url = urlencode($_SERVER['REQUEST_URI']);
        header("location: " . BASE_URL . "/page/login?back_url=$back_url");
        exit;
    }

    /**
     * 檢查帳號密碼
     */
    public function check_login_password($account, $password)
    {
        $query = $this->db->query("SELECT * FROM user WHERE account=?", array($account));
        if ($query->num_rows() == 0) return FALSE;
        if ($query->row()->password == md5($password))
        {
            return $query->row();
        }
        else
        {
            return false;
        }
    }
}