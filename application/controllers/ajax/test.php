<?php
class Test extends CI_Controller
{
    public function index()
    {
        $ret = array('status' => 'very good!');
        echo json_encode($ret);
    }
}
