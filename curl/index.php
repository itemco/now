<?php

#/curl/index.php (Master)
#
#This page is a relay between index-page and client-webs (servers)
#Users browsing index.html are not allowed to connect to other servers
#but fetch.php is (eg this server is)!
#
#So index.html calls this page with jquery-ajax
#this page takes the input and do curl against clients
#and returns the result-array as is (or maybe optionally filtered)
#
#For security, this page should also validate all user-accesses against AD or similar
#Everytime? Perhaps index-page should do that, and we block this page from being run directly
#

/* auto include classes as they are called */ 
function __autoload($class_name)  
{  
    include_once "class.".$class_name.".inc.php";  
}

function fnDebug($title, $data = "")
{
  if (isset($_GET["debug"])) {
    echo "<pre>";
    if ($title != "") {
      echo "<b>=== $title ===</b><br/>";
    }
    print_r($data);
    echo "</pre>";
  }
}

#consider blocking access to this page except from master!
#but we can do that in .htaccess as well

$caller_ip = $_SERVER["REMOTE_ADDR"];
fnDebug("caller-ip", $caller_ip);

#sample calls to this page:
# https://master.sthlm.net/ls/?params=/var/log/httpd/
# https://master.sthlm.net/free/

#global settings for this page
$domain = "sthlm.net";

#show GET...
fnDebug("GET", $_GET);

$arr = array_keys($_GET);
fnDebug("get (array)", $arr);

$path = trim($arr[0], "/");
fnDebug("path", $path);

$split = explode("/", $path);
fnDebug("split", $split);

#somehow . are replaced with _ in array, weird!
$client = str_replace("_",".",$split[0]);
fnDebug("client", $client);

#add domain if not provided
if (!strstr($client, $domain)) {
  $client = "$client.$domain";
}
fnDebug("client", $client);

#chack that second part is /shell/
#OBS! forced exit here, should build something better!
if ($split[1] != "shell") {
  echo "Second field in path must be /shell/ !";
  exit;
}

#get req
$req = $split[2];
fnDebug("req", $req);

#get params (if any)
$params = $_GET["params"];
fnDebug("params", $params);

#build curl-url depending on if params is present
if (isset($_GET["params"]) && $params != "") {
  $url = "$client/shell/$req/?params=$params";
} else {
  $url = "$client/shell/$req/";
}
fnDebug("url", $url);

#now call the curl-class
fnDebug("running CURL-class...");
$clsCURL = new CURL;
$clsCURL->set_api_usr("kalle");
$clsCURL->set_api_key("abc123");
$output = $clsCURL->get($url);

fnDebug("output", $output);

$json = json_encode($output, true);
echo $json;

?>

