<?php
    
class Curl
{
    protected $log = array();
    protected $status = 0; /* 0=log, 1=success, 2=info, 3=warning, 4=danger */
    protected $result = array();
    protected $api_usr;
    protected $api_key;

    public function __construct()
    {
    }

    #catch calls to invalid functions
    public function __call($function, $arguments) {
    }

    private function set_status($level) {
        if ($level >= $this->status) {
            $this->status = $level;
        }    
    }

    public function get_status() {
        return $this->status;
    }

    public function get_log() {
        return $this->log;
    }

    public function get_result() {
        return $this->result;
    }

    public function set_api_usr($input) {
        $this->api_usr = $input;
    }

    public function set_api_key($input) {
        $this->api_key = $input;
    }

    public function get($url) {
        $result = array();
        #try{
        #sample: curl -X GET -H "API_USR: poptroll" -H "API_KEY: abc123" http://sieformat.com/api/products/125
        $headers = array("API_USR:".$this->api_usr, "API_KEY:".$this->api_key);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_HTTPGET, true); 
        curl_setopt($ch, CURLOPT_FAILONERROR, true); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
        curl_setopt($ch, CURLOPT_FRESH_CONNECT, true); 
        $json = curl_exec($ch);
        $curl_errno = curl_errno($ch);
        $curl_error = str_replace("\n", "", curl_error($ch));
        if ($curl_error) {
            throw new Exception("Curl error: ".$curl_errno." - ".$curl_error);
        }
        curl_close($ch);
        #fnDebug($json);
        $result = json_decode($json, true);
        #fnDebug($result);
        #} catch( Exception $e ) {
        #}
        return $result;
    }

}
?>
