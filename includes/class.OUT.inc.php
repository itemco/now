<?php
    
class OUT
{
    protected $result = [];
    private $timer_start;

    public function __construct()
    {
      $this->result["request"]["method"] = "N/A";
      $this->result["request"]["plugin"] = "N/A";
      $this->result["request"]["host"] = "NA/";
      #$this->result["request"]["domain"] = "NA/";
      $this->result["request"]["user"] = "N/A";
      #$this->result["request"]["title"] = "NA/";
      $this->result["request"]["params"] = "N/A";
      $this->result["request"]["layout"] = "N/A";
      $this->result["request"]["filter"] = "N/A";
      #$this->result["request"]["executed"] = "N/A";
      $this->result["response"]["alert"] = "N/A";
      $this->result["response"]["message"] = "N/A";
      $this->result["response"]["rows"] = "N/A";
      $this->result["response"]["size"] = "N/A";
      $this->result["response"]["time"] = "N/A";
      $this->result["response"]["source"] = "N/A";
      $this->result["data"]["tbl"] = "N/A";
      $this->result["data"]["txt"] = "N/A";
      $this->result["data"]["pie"] = "N/A";
      $this->result["data"]["bar"] = "N/A";
    }

    # set data

    public function set_request($key, $val) {
      fnDebug(__CLASS__."->".__FUNCTION__." ($key)", $val);
      $this->result["request"][$key] = $val;
    }
    public function set_response($key, $val) {
      fnDebug(__CLASS__."->".__FUNCTION__." ($key)", $val);
      $this->result["response"][$key] = $val;
    }
    public function set_tbl($arr) {
      fnDebug(__CLASS__."->".__FUNCTION__, $arr);
      $this->result["data"]["tbl"] = $arr;
    }
    public function set_txt($arr) {
      fnDebug(__CLASS__."->".__FUNCTION__, $arr);
      $this->result["data"]["txt"] = $arr;
    }
    public function set_pie($arr) {
      fnDebug(__CLASS__."->".__FUNCTION__, $arr);
      $this->result["data"]["pie"] = $arr;
    }
    public function set_bar($arr) {
      fnDebug(__CLASS__."->".__FUNCTION__, $arr);
      $this->result["data"]["bar"] = $arr;
    }

    # set error

    public function error($message) {
      fnDebug(__CLASS__."->".__FUNCTION__, "$message");
      $this->result["response"]["alert"] = "danger";
      $this->result["response"]["message"] = $message;
      $this->result["response"]["rows"] = 0;
      $this->result["response"]["size"] = 0;
      $this->result["response"]["time"] = 0;
      $this->result["data"]["tbl"] = [];
      $this->result["data"]["txt"] = [];
      $this->result["data"]["pie"] = [];
      $this->result["data"]["bar"] = [];
      echo $this->get_json();
      exit; 
    }

    # set timer

    public function timer_start() {
      $this->timer_start = microtime(true);
      fnDebug(__CLASS__."->".__FUNCTION__, $this->timer_start);
    }
    public function timer_stop() {
      $timer_stop = microtime(true);
      fnDebug(__CLASS__."->".__FUNCTION__, $timer_stop);
      $timer_start = $this->timer_start;
      $timer_exec = number_format(($timer_stop-$timer_start), 3);
      $this->result["response"]["time"] = $timer_exec;
    }

    #get
 
    public function get() {
      $result = $this->result;
      fnDebug(__CLASS__."->".__FUNCTION__, $result);
      return $result;
    }
    public function get_json() {
      $result = $this->result;
      fnDebug(__CLASS__."->".__FUNCTION__, $result);
      return json_encode($result, true);
    }
}

?>
