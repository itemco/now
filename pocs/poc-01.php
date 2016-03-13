<!doctype html>
<html>
<head>
<title>poc-01.php</title>

<link rel="stylesheet" href="../css/bootstrap.min.css">
<script src="../js/jquery.min.js" type="text/javascript"></script>
<script src="../js/bootstrap.min.js"></script>

<style>

body {
margin: 0 auto;
background: #f7f7f7;
background: lightgray;
}

.panel {
xbackground-color: red;
xwidth: 20em;
xmargin-top: .5em;
xdisplay: block;
xfloat: left;
}

.panel-heading {
text-align: center;
}
.panel-title {
xfont-size: 2em;
}

.panel-body h5 {
margin-bottom: 0;
}

.progress {
xheight: 1em;
}

.col-xs-12 {
xbackground: cyan;
padding: 0.5em;
}

</style>

</head>
<body>

<div class="container-fluid">

<h3>Just a page header</h3>

<!-- Columns start at 50% wide on mobile and bump up to 33.3% wide on desktop -->
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

<div class="col-xs-12 col-sm-4 col-md-3 col-lg-2">
<div class="panel panel-warning">
<div class="panel-heading"><span class="panel-title">G</span></div>
<div class="panel-body">
<div class="progress">
  <div class="progress-bar progress-bar-success" style="width: 85%">15</div>
  <div class="progress-bar progress-bar-warning" style="width: 15%">3</div>
  <div class="progress-bar progress-bar-danger" style="width: 0%">0</div>
</div>
</div>
</div>
</div>

<div class="col-xs-12 col-sm-4 col-md-3 col-lg-2">
<div class="panel panel-success">
<div class="panel-heading"><span class="panel-title">E</span></div>
<div class="panel-body">
<div class="progress">
  <div class="progress-bar progress-bar-success" style="width: 100%">18</div>
  <div class="progress-bar progress-bar-warning" style="width: 0%">0</div>
  <div class="progress-bar progress-bar-danger" style="width: 0%">0</div>
</div>
</div>
</div>
</div>

<div class="col-xs-12 col-sm-4 col-md-3 col-lg-2">
<div class="panel panel-warning">
<div class="panel-heading"><span class="panel-title">D</span></div>
<div class="panel-body">
<div class="progress">
  <div class="progress-bar progress-bar-success" style="width: 70%">18</div>
  <div class="progress-bar progress-bar-warning" style="width: 30%">7</div>
  <div class="progress-bar progress-bar-danger" style="width: 0%">0</div>
</div>
</div>
</div>
</div>

<div class="col-xs-12 col-sm-4 col-md-3 col-lg-2">
<div class="panel panel-danger">
<div class="panel-heading"><span class="panel-title">A</span></div>
<div class="panel-body">
<div class="progress">
  <div class="progress-bar progress-bar-success" style="width: 90%">18</div>
  <div class="progress-bar progress-bar-warning" style="width: 0%">0</div>
  <div class="progress-bar progress-bar-danger" style="width: 10%">2</div>
</div>
</div>
</div>
</div>

<div class="col-xs-12 col-sm-4 col-md-3 col-lg-2">
<div class="panel panel-danger">
<div class="panel-heading"><span class="panel-title">X</span></div>
<div class="panel-body">
<div class="progress">
  <div class="progress-bar progress-bar-success" style="width: 80%">18</div>
  <div class="progress-bar progress-bar-warning" style="width: 10%">3</div>
  <div class="progress-bar progress-bar-danger" style="width: 10%">3</div>
</div>
</div>
</div>
</div>


<div class="col-xs-12 col-sm-4 col-md-3 col-lg-2">
<div class="panel panel-danger">
<div class="panel-body bg-danger">PROD</div>
</div>
</div>


</div>

</div>


<!--
<div class="panel panel-danger">
<div class="panel-heading"><span class="panel-title">E</span></div>
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

<div class="panel panel-warning">
<div class="panel-heading"><span class="panel-title">G</span></div>
<div class="panel-body">
<div class="progress">
  <div class="progress-bar progress-bar-success" style="width: 85%"></div>
  <div class="progress-bar progress-bar-warning" style="width: 15%"></div>
</div>
</div>
</div>

-->

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

