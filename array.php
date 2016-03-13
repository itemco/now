<?php

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

#testing serialize

$filter = [[1,2],[1,3]];
fnDebug("filter", $filter);
$ser = serialize($filter);
fnDebug("serialized", $ser);
$json = json_encode($filter,true);
fnDebug("json", $json);

#filters extended, default values per plugin. Labels are always row 0 so don't have to specify them.

$filters["df"] = [[1,2],[1,3]];
$filters["free"] = [[1,2],[1,3],[1,5]];
fnDebug("filters per plugin", $filters);

#servers, systems, logins and more, this should work nicely! Add roles and environments later!

$db["server"]["efocapp1u"]["system"] = "focus";
$db["server"]["efocapp1u"]["env"] = "E";
$db["server"]["efocweb1u"]["system"] = "focus";
$db["server"]["efocweb1u"]["env"] = "E";
$db["server"]["eodassv2u"]["system"] = "utdata";
$db["server"]["eodassv2u"]["env"] = "E";
$db["server"]["epinsrv1u"]["system"] = "pin";
$db["server"]["epinsrv1u"]["env"] = "E";
$db["server"]["emedsrv1u"]["system"] = "digdis";
$db["server"]["emedsrv1u"]["env"] = "E";

fnDebug("db[server]-array", $db["server"]);

$db["system"]["focus"]["name"] = "Focus";
$db["system"]["focus"]["user"] = "focus2";
$db["system"]["utdata"]["name"] = "Utdata";
$db["system"]["utdata"]["user"] = "streamserve";
$db["system"]["pin"]["name"] = "PIN";
$db["system"]["pin"]["user"] = "pin";
$db["system"]["digdis"]["name"] = "Digitaldistribution";
$db["system"]["digdis"]["user"] = "digdis";

fnDebug("db[system]-array", $db["system"]);

$db["login"]["andhan"]["systems"] = ["focus","utdata","pin","digdis"];
$db["login"]["ronkru"]["systems"] = ["utdata"];

fnDebug("db[login]-array", $db["login"]);

#now so if I know "efocweb1u"...
$host = "emedsrv1u";
fnDebug("host", $host);
$login = "andhan";
fnDebug("login", $login);

$system = $db["server"][$host]["system"];
fnDebug("system", $system);
$system_name = $db["system"][$system]["name"];
fnDebug("system_name", $system_name);
$user = $db["system"][$system]["user"];
fnDebug("user", $user);

$access = FALSE;
if (in_array($system, $db["login"][$login]["systems"])) {
  $access = TRUE;
}
fnDebug("User have access to this server?", $access);


#Avvakta med roles, lite klurigt med flera roller  TF utdata, DEV digdis osv och olika rättigheter i E,G,P!


?>

