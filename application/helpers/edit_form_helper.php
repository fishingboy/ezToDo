<?php
/**
 * 快速建立表單
 * @author Leo Kuo
 */
class LK_Form
{
    var $id;            // 表單 id
    var $action;        // 表單送出位置
    var $method;        // 表單 method (GET/POST)
    var $title;         // 表單標題
    var $rows;          // 表單列
    var $row_index = 0; // 表單編號
    var $output;        // 輸出暫存

    /**
     * 初始化設定
     */
    public function __construct($param)
    {
        $this->id     = ($param['id']) ? $param['id'] : NULL;
        $this->action = ($param['action']) ? $param['action'] : NULL;
        $this->method = ($param['method']) ? $param['method'] : NULL;
        $this->title  = ($param['title']) ? $param['title'] : NULL;
        $this->rows   = ($param['rows']) ? $param['rows'] : NULL;
    }

    /**
     * 新增一列
     */
    public function add_row($param)
    {
        $row_index++;
        $this->rows[$row_index] = $param;
    }

    /**
     * 新增一欄
     */
    public function add_field($param)
    {
        
    }

    /**
     * 表單輸出
     */
    public function output()
    {
        return $output;
    }
}