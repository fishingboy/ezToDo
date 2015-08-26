<?php
/**
* 工作時間計算
*/
class Worktime
{
    /**
     * 把時間歸零(回到午夜)
     */
    const RESET_TIME = TRUE;

    /**
     * CI 實體
     * @var object
     */
    private $_CI;

    /**
     * 星期的中文顯示
     * @var array
     */
    private $_weekday = [
        '日',
        '一',
        '二',
        '三',
        '四',
        '五',
        '六',
    ];

    /**
     * worktime 的 config 內容
     * @var array
     */
    private $_config;

    function __construct()
    {
        $this->_CI = & get_instance();
        $this->_CI->load->config('worktime');
        $this->_config = $this->_CI->config->item('worktime');
    }

    /**
     * 取得 worktime 的設定
     * @return array 設定值
     */
    public function get_config()
    {
        return $this->_config;
    }

    /**
     * 取得完工日期
     * @param  string  $start 開始時間(Y-m-d H:i:s)
     * @param  integer $hours 工時(小時)
     * @return string         完成時間
     */
    public function get_due_time($start_time, $hours)
    {
        // 工作時間
        $work_minute = intval($hours * 60);

        // 計算工時
        $curr_time = $start_time;
        $add_day = $add_minute = 0;
        while (1)
        {
            // 計算那天的可工作時間，並修改 $curr_time 為當天的上班開始時間
            $can_work_time = $this->_get_can_work_time($curr_time);
            if ($work_minute <= $can_work_time)
            {
                // 找到了
                $add_minute = $work_minute;
                break;
            }

            $work_minute -= $can_work_time;
            $add_day++;
            $curr_time = $this->_get_next_time($start_time, ['add_day' => $add_day], self::RESET_TIME);
        }

        // 輸出完工日期
        return $this->_get_next_time($curr_time, [
            'add_minute' => $add_minute,
        ]);
    }

    /**
     * 取得某個日期是星期幾
     * @param  string $time Y-m-d
     * @return integer      星期幾 (星期日是 0)
     */
    public function get_week($time)
    {
        // 去掉時間
        $time = explode(' ', $time)[0];
        list($year, $month, $day) = explode('-', $time);
        $unixtime = mktime(0, 0, 0, $month, $day, $year);
        return date("w", $unixtime);
    }

    /**
     * 取得星期的中文
     * @param  integer $week 星期幾
     * @return string        中文的星期
     */
    public function get_week_name($time)
    {
        return $this->_weekday[$this->get_week($time)];
    }

    /**
     * 取得該時間的工作日還可以工作的時間有幾分鐘？
     * @param  string $time 時間(Y-m-d H:i:s)
     * @return integer      還可以工作的時間(分鐘)
     */
    private function _get_can_work_time(&$time)
    {
        // 取得星期幾
        $week = $this->get_week($time);

        // 如果不是工作日則直接回傳 0
        if ( ! isset($this->_config[$week]))
        {
            return 0;
        }

        // 取得設定
        $c = (isset($this->_config[$week])) ? $this->_config[$week] : NULL;

        // 切割時間
        $time_array = $this->_split_time($time);
        $curr_time = $time_array['hour'] . ':' . $time_array['minute'];

        // 還沒上班;
        if ($curr_time < $c['start'])
        {
            // 將開始時間設為上班時間
            $curr_time = $c['start'];
            $time = $time_array['year'].'-'.
                    $time_array['month'].'-'.
                    $time_array['day'].' '.
                    $c['start'].':'.
                    $time_array['sec'];
        }
        else
        // 上班時間
        if ($c['start'] < $curr_time && $curr_time < $c['end'])
        {
        }
        else
        {
            // echo "下班時間!<br>";
            return 0;
        }

        return $this->_get_time_length($curr_time, $c['end']);
    }

    /**
     * 取得下一個時間點
     * @param  string $time 時間
     * @param  array $param 增加的時間
     * @example:
     * $param = [
     *     'add_year'   => ...,
     *     'add_month'  => ...,
     *     'add_day'    => ...,
     *     'add_hour'   => ...,
     *     'add_minute' => ...,
     *     'add_sec'    => ...,
     * ]
     * @param boolean $reset 是否歸零(時間設為午夜)
     * @return string       加上一段時間後的新時間
     */
    private function _get_next_time($time, $param, $reset = FALSE)
    {
        $time_array = $this->_split_time($time);

        // 時間歸零(回到午夜)
        if ($reset)
        {
            $time_array['hour'] = $time_array['minute'] = $time_array['sec'] = 0;
        }

        // 判斷加多少時間(防呆)
        $param['add_year']   = (isset($param['add_year']))   ? intval($param['add_year']) : 0;
        $param['add_month']  = (isset($param['add_month']))  ? intval($param['add_month']) : 0;
        $param['add_day']    = (isset($param['add_day']))    ? intval($param['add_day']) : 0;
        $param['add_hour']   = (isset($param['add_hour']))   ? intval($param['add_hour']) : 0;
        $param['add_minute'] = (isset($param['add_minute'])) ? intval($param['add_minute']) : 0;
        $param['add_sec']    = (isset($param['add_sec']))    ? intval($param['add_sec']) : 0;

        // 重組時間
        $unixtime = mktime($time_array['hour']   + $param['add_hour'],
                           $time_array['minute'] + $param['add_minute'],
                           $time_array['sec']    + $param['add_sec'],
                           $time_array['month']  + $param['add_month'],
                           $time_array['day']    + $param['add_day'],
                           $time_array['year']   + $param['add_year']);
        return date('Y-m-d H:i:s', $unixtime);
    }

    /**
     * 切割時間
     * @param  string $time 時間
     * @return array =[
     *             'year'   => ...,
     *             'month'  => ...,
     *             'day'    => ...,
     *             'hour'   => ...,
     *             'minute' => ...,
     *             'sec'    => ...,
     *         ];
     */
    private function _split_time($time)
    {
        $tmp = explode(' ', $time);
        list($year, $month, $day) = explode('-', $tmp[0]);
        list($hour, $minute, $sec) = explode(':', $tmp[1]);

        return [
            'year'   => $year,
            'month'  => $month,
            'day'    => $day,
            'hour'   => $hour,
            'minute' => $minute,
            'sec'    => $sec,
        ];
    }

    /**
     * 取得兩個時間點內有幾分鐘
     * @param  string $start_time 開始時間 ex: 09:00
     * @param  string $end_time   結束時間 ex: 18:00
     * @return integer            分鐘
     */
    private function _get_time_length($start_time, $end_time)
    {
        $start = explode(':', $start_time);
        $end   = explode(':', $end_time);
        return ($end[0] * 60 + $end[1]) - ($start[0] * 60 + $start[1]);
    }
}

/* End of file worktime.php */
/* Location: ./application/libraries/worktime.php */