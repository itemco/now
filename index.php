<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>master.sthlm.net</title>
<link href="/css/bootstrap.min.css" rel="stylesheet">

<!-- custom styles -->
<style>

.col-xs-12, .col-xs-6 {
padding: 0.5em;
}

.btn {
width: 100%;
}

.jumbotron {
padding-top: 0em;
padding-bottom: 1.5em;
}

</style>

</head>
<body>

<!-- php stuff -->
<?php

#global include
require("/includes/global.inc.php");

$get = array_keys($_GET);
$split = explode("/", $get[0]);
$env = strtolower($split[0]);
$sys = strtolower($split[1]);
$srv = strtolower($split[2]);

fnDebug("get-stuff", "home / ".$env." / ".$sys." / ".$srv);

$tree["e"]["focus"]["efocapp1u"] = TRUE;
$tree["e"]["focus"]["efocweb1u"] = TRUE;
$tree["e"]["utdata"]["eodassv2u"] = TRUE;

#men va fan! Vill ju bara ha en array att verifiera path mot!
#SKIP ENVIRONMENT, TREAT AS AN ATTRIBUTE!!!

fnDebug("tree", $tree);

if (array_key_exists($env, $tree)) {
  fnDebug("Env is ok!");
}
if (array_key_exists($sys, $tree[$env])) {
  fnDebug("System is ok!");
}
if (array_key_exists($srv, $tree[$env][$sys])) {
  fnDebug("Server is ok!");
}




?>

<!-- header -->

<!-- jombtron -->
<div class="jumbotron">
<div class="container">
<h2>E - Focus - Servers</h2>
<p>Buttons below indicates status by color for servers belonging to this system. Click to see details.</p>
<div class="container-fluid">
<div class="row">
<div class="col-xs-6 col-sm-4 col-md-3 col-lg-2">
<button type="button" class="btn btn-lg btn-danger">efocapp1u<br/><small>2 alerts</small></button>
</div>
<div class="col-xs-6 col-sm-4 col-md-3 col-lg-2">
<button type="button" class="btn btn-lg btn-success">efocweb1u<br/><small>OK</small></button>
</div>
<div class="col-xs-6 col-sm-4 col-md-3 col-lg-2">
<button type="button" class="btn btn-lg btn-warning">efocweb1u<br/><small>3 warnings</small></button>
</div>
</div>
</div>
</div>
</div>

<!-- page content -->
<div class="container-fluid">

<h1>Hello, world!</h1>

<div class="row">
<div class="col-xs-12 col-sm-4 col-md-3 col-lg-2">
<div class="panel panel-danger">
<div class="panel-heading"><span class="panel-title">PROD</span></div>
<div class="panel-body">
<h5>Systems</h5>
<div class="progress">
  <div class="progress-bar progress-bar-success" style="width: 60%">6</div>
  <div class="progress-bar progress-bar-warning" style="width: 30%">3</div>
  <div class="progress-bar progress-bar-danger" style="width: 10%">1</div>
</div>
<h5>Servers</h5>
<div class="progress">
  <div class="progress-bar progress-bar-success" style="width: 70%">12</div>
  <div class="progress-bar progress-bar-warning" style="width: 25%">4</div>
  <div class="progress-bar progress-bar-danger" style="width: 5%">1</div>
</div>
<h5>Checks</h5>
<div class="progress">
  <div class="progress-bar progress-bar-success" style="width: 80%">36</div>
  <div class="progress-bar progress-bar-warning" style="width: 17%">7</div>
  <div class="progress-bar progress-bar-danger" style="width: 3%">1</div>
</div>
</div>
</div>
</div>

</div>

<!-- js includes -->
<script src="/js/jquery.min.js" type="text/javascript"></script>
<script src="/js/bootstrap.min.js" type="text/javascript"></script>
<!-- cusom js -->
<script>

$(document).ready(function() {
  console.log("document loaded");
});
 
$(window).load(function() {
  console.log("window loaded");
});

</script>
</body>
</html>

