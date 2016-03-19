<?php

#global include
require_once("../includes/global.inc.php");
require_once("../includes/tree.inc.php");

#activate class(es)...
$OUT = new OUT;

#fetch output original from class, only to show in debug, we DON'T need to do this!
#$dummy = $OUT->get();

#start timer
$OUT->timer_start();

#set executed date-time
#$OUT->set_request("executed", date("Y-m-d H:i:s"));

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

#split path to an array
$split = explode("/", $path);
fnDebug("split", $split);

#get plugin
$plugin = $split[0];
$OUT->set_request("plugin", $plugin);

#get host (if any)
$host = $split[1];
$OUT->set_request("host", $host);

#get user (if any)
$user = $split[2];
$OUT->set_request("user", $user);

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
#if (!in_array($res, ["sh","cs","df"])) {
#  $OUT->error("Resource '$res' is not valid");
#}

#hard coded cmd-array - This should be fetched from DB (once)! or once everyday (eg cahced).
#oh wait, I could use ["cache"] to set individual times, 0 = no cache

#$cmd["df"]["title"] = "Disc info";
$cmd["df"]["cmd"] = "exec/df.sh";
$cmd["df"]["cache"] = 60;
$cmd["df"]["host"] = "optional";
$cmd["df"]["user"] = "reject";
$cmd["df"]["params"] = "reject";
$cmd["df"]["type"] = "tbl";

#$cmd["ps"]["title"] = "Process info";
$cmd["ps"]["cmd"] = "exec/ps.sh $params";
$cmd["ps"]["cache"] = 120;
$cmd["ps"]["host"] = "optional";
$cmd["ps"]["user"] = "reject";
$cmd["ps"]["params"] = "optional";
$cmd["ps"]["type"] = "tbl";

#$cmd["ls"]["title"] = "List files and directories";
$cmd["ls"]["cmd"] = "exec/ls.sh $params";
$cmd["ls"]["cache"] = 0;
$cmd["ls"]["host"] = "required";
$cmd["ls"]["user"] = "required";
$cmd["ls"]["params"] = "required";
$cmd["ls"]["type"] = "tbl";

#$cmd["cat"]["title"] = "View file";
$cmd["cat"]["cmd"] = "exec/cat.sh $params";
$cmd["cat"]["cache"] = 0;
$cmd["cat"]["host"] = "required";
$cmd["cat"]["user"] = "required";
$cmd["cat"]["params"] = "required";
$cmd["cat"]["type"] = "txt"; #eg data[txt], and base64-encoded, use this flag to know!

#$cmd["dbs"]["title"] = "Database predefined query";
$cmd["dbs"]["cmd"] = "exec/dbs.pl $params";
$cmd["dbs"]["cache"] = 0;
$cmd["dbs"]["host"] = "required";
$cmd["dbs"]["user"] = "required";
$cmd["dbs"]["params"] = "required";
$cmd["dbs"]["type"] = "tbl";

$cmd["pb"]["cmd"] = "exec/pb.sh $params";

$cmd["tree"]["cmd"] = "exec/tree.sh $params";
$cmd["tail"]["cmd"] = "exec/tail.sh $params";

#special for dbs (just testing)
if ($plugin == "dbs") {
  $params = "/opt/focus2/batch/conf/db.properties 'SELECT name, value FROM systemvalue'";
}

#validate inputs

if ($cmd[$plugin]["host"] == "required") {
  if (empty($host)) {
    $OUT->error("Plugin '$plugin' require hostname in path");
  }
}
if ($cmd[$plugin]["host"] == "reject") {
  if ($host) {
    $OUT->error("Plugin '$plugin' don't want hostname in path");
  }
}
if ($cmd[$plugin]["user"] == "required") {
  if (empty($user)) {
    $OUT->error("Plugin '$plugin' require user in path");
  }
}
if ($cmd[$plugin]["user"] == "reject") {
  if ($user) {
    $OUT->error("Plugin '$plugin' don't want user in path");
  }
}
if ($cmd[$plugin]["params"] == "required") {
  if (empty($params)) {
    $OUT->error("Plugin '$plugin' require params in path");
  }
}
if ($cmd[$plugin]["params"] == "reject") {
  if ($params) {
    $OUT->error("Plugin '$plugin' don't want params in path");
  }
}
  

#Tanken med optional "host" är att man då ALLTID hämtar allt data från cache
#Den ger då en lista på alla servrar med totaler typ, så /api/df/ hämtar cache "df--"
# eller en summering av alla cache-variabler som heter df-*"

#$cmd["lsd"]["title"] = "List files";
$cmd["lsd"]["cmd"] = "exec/lsd.sh $params";
$cmd["lsd"]["cache"] = 0;
#$cmd["lsf"]["title"] = "List directories";
$cmd["lsf"]["cmd"] = "exec/lsf.sh $params";
$cmd["lsf"]["cache"] = 0;
#$cmd["free"]["title"] = "Memory info";
$cmd["free"]["cmd"] = "exec/free.sh $params";
$cmd["free"]["cache"] = 60;
#$cmd["rpm"]["title"] = "Show installed rpm-packages";
$cmd["rpm"]["cmd"] = "exec/rpm.sh $params";
$cmd["rpm"]["cache"] = 300;
#$cmd["cpu"]["title"] = "CPU-info";
$cmd["cpu"]["cmd"] = "exec/cpu.sh $params";
$cmd["cpu"]["cache"] = 300;
#$cmd["who"]["title"] = "Who am I ?";
$cmd["who"]["cmd"] = "exec/who.sh $params";
$cmd["who"]["cache"] = 0;
#$cmd["fif"]["title"] = "Files in folders count";
$cmd["fif"]["cmd"] = "exec/fif.sh $params";
$cmd["fif"]["cache"] = 0;

#These will have to change, not sure how yet
#$cmd["digdis"]["title"] = "Digitaldistribution service status";
$cmd["digdis"]["cmd"] = "exec/cs.sh $params";
$cmd["digdis"]["cache"] = 120;
#$cmd["utdata"]["title"] = "Utdata service status";
$cmd["utdata"]["cmd"] = "exec/cs.sh $params";
$cmd["utdata"]["cache"] = 120;

#fnDebug("cmd array", $cmd);

#check if command given is an existing one (eg one of the above)
if (!array_key_exists($plugin, $cmd)) {
  $OUT->error("Plugin '$plugin' is not valid");
}
#set req-title in output
#$OUT->set_request("title", $cmd[$plugin]["title"]);


#special for dbs (just testing)
if ($plugin == "dbs") {
  $params = '/opt/focus2/batch/conf/db.properties "SELECT name, value FROM systemvalue"';
}

#build cmd-string depending on if params is present - NEEDS WORK!!!
if (isset($_GET["params"]) && $params != "") {
  $exec = trim(str_replace("[params]", $params, $cmd[$plugin]["cmd"])); #not sure how to add params yet! str_replace?
} else {
  $exec = trim(str_replace("[params]", "", $cmd[$plugin]["cmd"])); #remove [params] from command, if any
}
fnDebug("exec", $exec);

#build ssh-command, in case we have to execute it (cache depreciated)
#obs, not necessarily a ssh-command, could be curl or something else
#we could run ssh with now@localhost though, to make things easier :)
if (empty($user)) {
  $user= "andhan"; #should be user "now" or similar, using andhan while debugging other stuff
}
$ssh = "ssh $user@$host 'bash -s' -- < $exec 2>&1";
if ($plugin == "dbs") {
  #$params = str_replace("'", "\'", $params); #must have \ before '
  $ssh = "ssh $user@$host 'perl - $params' -- < $exec 2>&1";
}
fnDebug("ssh-command", $ssh);

#build a cache-variable that we can use to save result in cache
#not sure how to handle params vs cache, added here for now
$cache_var = $plugin."-".$host."-".$user."-".$params;
fnDebug("cache_var", $cache_var);

#fetch from cache (if it's there)
$cache_timeout = $cmd[$plugin]["cache"];
if ($result = apc_fetch($cache_var)) {
  fnDebug("Checking cache", "Cache is fresh (<".$cache_timeout."s), returning cached result");
  $OUT->set_response("source", "cache");
} else {
  fnDebug("Checking cache","Not in cache, executing command");
  $OUT->set_response("source", "live");
  #executing ssh-command
  $result = trim(shell_exec($ssh));
  fnDebug("result", $result);

  #bail out on errors, class returns valid array and exits
  if (strstr($result, "Could not resolve hostname")) {
    $OUT->error($result);
  }
  if (strstr($result, "key verification failed")) {
    $OUT->error("Host key verification failed");
  }
  if (strstr($result, "Permission denied")) {
    $OUT->error("Permission denied for user '$user'");
  }
  #this might need some work, might wanna cache db-queries in the future, and they will prolly contain params
  if ($cache_timeout > 0) {
    apc_add($cache_var, $result, $cache_timeout);
    fnDebug("Saved to cache as '$cache_var' for ".$cache_timeout."s");
  } else {
    fnDebug("NOT saved to cache as '$cache_var' cache-timeout is set to 0");
  }
}
$src = base64_encode($result);

#response are |-delimted, make it into an array
$array = explode(PHP_EOL, $result);
$rows = 0;
foreach ($array as $row) {
  $row = preg_replace('/\s\s+/', ' ', $row);
  $split = array_map('trim', explode("|", $row));
  $data[] = $split;
  $rows++;
}
$tbl = $data;

#handle cat and tail differently...
$txt = [];
if ($plugin == "cat" || $plugin == "tail") {
  $tbl = [];
  $txt = base64_encode($result);
}

#handle tree-command, make it into jstree-format...
if ($plugin == "tree") {
  $tree = fnCreateTree($tbl);
  $tbl = $tree;
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
  $OUT->set_src([]);
  $OUT->set_tbl([]);
  $OUT->set_txt([]);
  $OUT->set_pie([]);
  $OUT->set_bar([]);
} else {
  $OUT->set_response("alert", "success");
  $OUT->set_response("message", "Resource fetched successfully");
  $OUT->set_response("rows", $rows);
  $OUT->set_response("size", strlen(serialize($data)));
  $OUT->set_src($src);
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

