<?php

#global include
require_once("../includes/global.inc.php");

#activate class(es)...
$OUT = new OUT;

#fetch output original from class, only to show in debug, we DON'T need to do this!
#$dummy = $OUT->get();

#start timer
$OUT->timer_start();

#set executed date-time
$OUT->set_request("executed", date("Y-m-d H:i:s"));

#set response-method
$OUT->set_request("method", $_SERVER['REQUEST_METHOD']);

#show GET...
fnDebug("GET", $_GET);

#split GET into keys
$arr = array_keys($_GET);
fnDebug("get (array)", $arr);

#pick path
$path = trim(strtolower($arr[0]), "/");
fnDebug("path", $path);

$split = explode("/", $path);
fnDebug("split", $split);

#somehow . are replaced with _ in array, weird!
$temp = explode("_",$split[0]);
$host = $temp[0];
$OUT->set_request("host", $host);
$OUT->set_request("domain", $domain);

#fetch user for server, this array should be stored in db, not here!
$server["emedsrv1u"]["user"] = "digdis";
$server["efocapp1u"]["user"] = "focus2";
$server["efocweb1u"]["user"] = "focus2";
$server["eodassv2u"]["user"] = "streamserve";
$server["epinsrv1u"]["user"] = "pin";
$user = $server[$host]["user"];
if (!$user) {
  $user = "UNKNOWN";
}
fnDebug("user", $user);

#add user to request-output
$OUT->set_request("user", $user);

#res?!
$res = $split[1];
fnDebug("res", $res);

#NEEDS WORK! Because it wont be enough when doing db-stuff
#but hey, I could add the title from db, ex "File List" aso, see below $cmd

#get plugin
$plugin = $split[2];
$OUT->set_request("plugin", $plugin);

#get params (if any)
$params = null;
if (isset($_GET["params"])) {
  $params = $_GET["params"];
}
$OUT->set_request("params", $params);

#get layout (if any)
$layout = null;
if (isset($_GET["layout"])) {
  $layout = $_GET["layout"];
}
$OUT->set_request("layout", $layout);

#get filter (if any)
$filter = null;
if (isset($_GET["filter"])) {
  $filter = $_GET["filter"];
}
$OUT->set_request("filter", $filter);

#check if 'res' is valid, eg sh or db - NEEDS WORK!!!
if (!in_array($res, ["sh","cs","df"])) {
  $OUT->error("Resource '$res' is not valid");
}

#hard coded cmd-array - This should be fetched from DB (once)! or once everyday (eg cahced).
#oh wait, I could use ["cache"] to set individual times, 0 = no cache
$cmd["ls"]["title"] = "List files and directories";
$cmd["ls"]["cmd"] = "sh/ls.sh $params";
$cmd["ls"]["cache"] = 0;
$cmd["lsd"]["title"] = "List files";
$cmd["lsd"]["cmd"] = "sh/lsd.sh $params";
$cmd["lsd"]["cache"] = 0;
$cmd["lsf"]["title"] = "List directories";
$cmd["lsf"]["cmd"] = "sh/lsf.sh $params";
$cmd["lsf"]["cache"] = 0;
$cmd["df"]["title"] = "Disc info";
$cmd["df"]["cmd"] = "sh/df.sh $params";
$cmd["df"]["cache"] = 60;
$cmd["free"]["title"] = "Memory info";
$cmd["free"]["cmd"] = "sh/free.sh $params";
$cmd["free"]["cache"] = 60;
$cmd["rpm"]["title"] = "Show installed rpm-packages";
$cmd["rpm"]["cmd"] = "sh/rpm.sh $params";
$cmd["rpm"]["cache"] = 300;
$cmd["cpu"]["title"] = "CPU-info";
$cmd["cpu"]["cmd"] = "sh/cpu.sh $params";
$cmd["cpu"]["cache"] = 300;
$cmd["ps"]["title"] = "Process info";
$cmd["ps"]["cmd"] = "sh/ps.sh $params";
$cmd["ps"]["cache"] = 120;
$cmd["who"]["title"] = "Who am I ?";
$cmd["who"]["cmd"] = "sh/who.sh $params";
$cmd["who"]["cache"] = 0;
$cmd["fif"]["title"] = "Files in folders count";
$cmd["fif"]["cmd"] = "sh/fif.sh $params";
$cmd["fif"]["cache"] = 0;
$cmd["cat"]["title"] = "View file";
$cmd["cat"]["cmd"] = "sh/cat.sh $params";
$cmd["cat"]["cache"] = 0;

#These will have to change, not sure how yet
$cmd["digdis"]["title"] = "Digitaldistribution service status";
$cmd["digdis"]["cmd"] = "cs/digdis.sh $params";
$cmd["digdis"]["cache"] = 120;
$cmd["utdata"]["title"] = "Utdata service status";
$cmd["utdata"]["cmd"] = "cs/utdata.sh $params";
$cmd["utdata"]["cache"] = 120;

#fnDebug("cmd array", $cmd);

#check if command given is an existing one (eg one of the above)
if (!array_key_exists($plugin, $cmd)) {
  $OUT->error("Plugin '$plugin' is not valid");
}
#set req-title in output
$OUT->set_request("title", $cmd[$plugin]["title"]);

#build cmd-string depending on if params is present - NEEDS WORK!!!
if (isset($_GET["params"]) && $params != "") {
  $exec = trim(str_replace("[params]", $params, $cmd[$plugin]["cmd"])); #not sure how to add params yet! str_replace?
} else {
  $exec = trim(str_replace("[params]", "", $cmd[$plugin]["cmd"])); #remove [params] from command, if any
}
fnDebug("exec", $exec);

#execute cmd on client with ssh
$ssh = "ssh $user@$host 'bash -s' -- < $exec 2>&1";
fnDebug("ssh-string", $ssh);

#execute it. Now testing with cache!

$ssh_ser = serialize($ssh);
fnDebug("ssh_ser", $ssh_ser);

#alternative saving-path, oh oh and params?!
#No, we should NOT cache "cat" and similar!
$ssh_ser = $host."-".$plugin;
fnDebug("ssh_ser alternative", $ssh_ser);

#fetch from cache (if it's there)

$cache_timeout = $cmd[$plugin]["cache"];

if ($result = apc_fetch($ssh_ser)) {
  fnDebug("Checking cache", "Cache is fresh (<".$cache_timeout."s), returning cached result");
  $OUT->set_response("source", "cache");
} else {
  fnDebug("Checking cache","Not in cache, executing command");
  $OUT->set_response("source", "live");
  $result = trim(shell_exec($ssh));
  #bail out on errors, class returns valid array and exits
  if (strstr($result, "Could not resolve hostname")) {
    $OUT->error($result);
  }
  if (strstr($result, "key verification failed")) {
    $OUT->error("Host key verification failed");
  }
  #this might need some work, might wanna cache db-queries in the future, and they will prollycontain params
  if ($cache_timeout > 0) {
    apc_add($ssh_ser, $result, $cache_timeout);
    fnDebug("Saved to cache for ".$cache_timeout."s");
  } else {
    fnDebug("NOT saved to cache as '$plugin' cache-time is set to 0");
  }
}
#fnDebug("ssh exec result (might be cached)", $result);

if (strstr($result, "Could not resolve hostname")) {
  $OUT->error($result);
}
if (strstr($result, "key verification failed")) {
  $OUT->error("Host key verification failed");
}

#most responses are |-delimted, make it into an array
# cat-result should not be split up in rows!
#WEIRD to set data[0][0] but was because php53 doesnt support it
$array = explode(PHP_EOL, $result);
$rows = 0;
foreach ($array as $row) {
  $row = preg_replace('/\s\s+/', ' ', $row);
  $split = array_map('trim', explode("|", $row));
  $data[] = $split;
  $rows++;
}
$tbl = $data;

#handle cat differently...
$txt = [];
if ($plugin == "cat") {
  $tbl = [];
  $txt = base64_encode($result);
}

#fnDebug("data (array)", $data);

#now build extra data for ["pie"] aso...
#available filters, default values per plugin. Labels are always row 0 so don't have to specify them.
#ObS! Tänk på att sriva över default om man själv satt filter! FIXA SENARE!

$filters["df"]["pie"] = [[1,2,"red"],[1,3,"green"]];
$filters["free"]["pie"] = [[1,2,"red"],[1,3,"green"],[1,5,"orange"]];
$filters["df"]["bar"] = [[1,2,3],[1,"green"],[4,"blue"]];
#fnDebug("filters per plugin", $filters);

#OBS!
#Vi kanse ska ha så här: $filters["df"]["pie"] ? man kan ju tänkas vilja ha filter på tables?
#filter för ex "table" skulle även kunna fungera annorlunda, tex cols=[1,4,5]
#nackdel med detta är att pie och chart troligen alltid har samma filter
#men det kanske inte är hela världen!

#test pie
$i = 0;
$pie = [];
if ($plugin == "df" || $plugin == "free") {
  foreach($filters[$plugin]["pie"] as $k=>$v) {
    $pie[$i]["label"] = $data[0][$v[1]];
    $pie[$i]["value"] = $data[$v[0]][$v[1]];
    $pie[$i]["color"] = $v[2];
    $pie[$i]["highlight"] = $v[2];
    $i++;
  }
}
fnDebug("pie-data", $pie);

#test bar
$i = 0;
$bar = [];
if ($plugin == "df" || $plugin == "free") {
  $bar["labels"] = ["Blocks","Used","Available"]; #see below, need to rethink this, how do I pick'em in one go?
  foreach($filters[$plugin]["bar"] as $k=>$v) {
    if ($i != 0) {
      $bar["datasets"][$i-1]["label"] = $data[$i][0];
      $bar["datasets"][$i-1]["data"] = [10+$i*3,25-$i,15-$i*2]; #pick all values as an array from data using first filter values
      $bar["datasets"][$i-1]["fillColor"] = $v[1];
      $bar["datasets"][$i-1]["strokeColor"] = $v[1];
    }
    $i++;
  }
}
fnDebug("bar-data", $bar);

#now check if there were errors- NEEDS WORK!!!
#fix first section here to use class too!
$response = [];
if ($data[0][0] == "ERROR") {
  $OUT->set_response("alert", "danger");
  $OUT->set_response("message", $data[0][1]);
  $OUT->set_response("rows", 0);
  $OUT->set_response("size", 0);
  $OUT->set_tbl([]);
  $OUT->set_txt([]);
  $OUT->set_pie([]);
  $OUT->set_bar([]);
} else {
  $OUT->set_response("alert", "success");
  $OUT->set_response("message", "Resource fetched successfully");
  $OUT->set_response("rows", $rows);
  $OUT->set_response("size", strlen(serialize($data)));
  $OUT->set_tbl($tbl);
  $OUT->set_txt($txt);
  $OUT->set_pie($pie);
  $OUT->set_bar($bar);
}

#stop timer (class calculates exec-time and saves in output)
$OUT->timer_stop();

#return result to user
echo $OUT->get_json();

?>

