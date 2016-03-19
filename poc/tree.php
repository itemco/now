<!doctype html>
<html>
<head>
<title>fabric1u - tree</title>

<link rel="stylesheet" href="//static.jstree.com/3.2.1/assets/dist/themes/default/style.min.css">

<script src="/js/jquery.min.js" type="text/javascript"></script>

<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

<script src="/js/jstree.min.js" type="text/javascript"></script>

<script src="/js/codemirror.js" type="text/javascript"></script>
<script src="/js/codemirror-compressed.js" type="text/javascript"></script>
<link rel="stylesheet" href="/css/codemirror.css">
<link rel="stylesheet" href="/css/neat.css">

<link rel="stylesheet" href="poc.css">
<script src="poc.js" type="text/javascript"></script>

<style>

</style>

</head>
<body>

<div id="blocks">

<div id="win-01" class="half">
  <div class="panel panel-default">
    <div class="panel-heading"><span class="glyphicon glyphicon-refresh"></span> Title</div>
    <ul class="nav nav-pills" role="tablist">
      <li role="content" class="active"><a href="#win-01-tab1" role="tab" data-toggle="tab">Default</a></li>
      <li role="content"><a href="#win-01-tab2" role="tab" data-toggle="tab">JSON</a></li>
    </ul>
    <div class="panel-body">
      <div class="tab-content">
        <div role="tabpanel" id="win-01-tab1" class="tab-pane fade in active">
          <ul>
            <li data-jstree='{ "opened" : true }'>Root node
              <ul>
                <li data-jstree='{ "selected" : true }'>Child node 1</li>
                <li>Child node 2</li>
              </ul>
            </li>
          </ul>
        </div>
        <div role="tabpanel" id="win-01-tab2" class="tab-pane fade">json</div>
      </div>
    </div>
  </div>
</div>

<div id="win-02" class="half">
  <div class="panel panel-default">
    <div class="panel-heading">Title</div>
    <ul class="nav nav-pills" role="tablist">
      <li role="content" class="active"><a href="#win-02-tab1" role="tab" data-toggle="tab">Default</a></li>
      <li role="content"><a href="#win-02-tab2" role="tab" data-toggle="tab">JSON</a></li>
    </ul>
    <div class="panel-body">
      <div class="tab-content">
        <div role="tabpanel" id="win-02-tab1" class="tab-pane fade in active">default</div>
        <div role="tabpanel" id="win-02-tab2" class="tab-pane fade">json</div>
      </div>
    </div>
  </div>
</div>

</div>

<div class="wide">
<div class="dropdown">
  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
    Samples
    <span class="caret"></span>
  </button>
  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
    <li><a href="#">/api/tree/efocapp1u/?params=/opt/focus2/</a></li>
    <li><a href="#">/api/tree/efocapp1u/?params=/opt/focus2/batch/logs/</a></li>
    <li><a href="#">/api/tree/efocapp1u/?params=/var/log/focus2-services/</a></li>
  </ul>
</div>
</div>

<script>

//window.onload = function() {
$(document).ready(function() {

function fnWin01(url) {
$.ajax({
  type: 'GET',
  url: url,
  dataType: 'json',
  success: function (response) {
    var id = "#win-01";
    //console.log(response);
    data = response["data"]["tbl"];
    $(id+" .panel-heading").html(fnTitleFromArray(response));
    var refresh = "<span class=\"glyphicon glyphicon-refresh\" id="+id+" name=\""+this.url+"\"></span>";
    $(id+" .panel-heading").append(refresh);
    json = JSON.stringify(response, null, 2);
    $(id+"-tab2").html("<pre>"+json+"</pre>");
    $("#win-01-tab1").bind("loaded.jstree", function(event, data) {
      data.instance.open_all();
    });
    $("#win-01-tab1").jstree({"core":{"data":data}});
    console.log(json);
    //$("#win-01-tab1").jstree("refresh");
  }
});

$('#win-01-tab1').on('changed.jstree', function (e, data) {
  link = data["node"]["a_attr"]["href"];
  console.log(link);
  if (link != "#") {
    fnWin02("/api/tail/efocapp1u/?params="+link);
  }
});
};

function fnWin02(url) {
$.ajax({
  type: 'GET',
  url: url,
  dataType: 'json',
  success: function (response) {
    var id = "#win-02";
    //console.log(response);
    data = atob(response["data"]["txt"]);
    //data = atob(unescape(encodeURIComponent(response["data"])));
    //console.log(data);
    $(id+" .panel-heading").html(fnTitleFromArray(response));
    var refresh = "<span class=\"glyphicon glyphicon-refresh\" id="+id+" name=\""+this.url+"\"></span>";
    $(id+" .panel-heading").append(refresh);
    $("#win-02-tab1").html("<textarea id='win-02-code'>"+data+"</textarea>");
    var editor = CodeMirror.fromTextArea(document.getElementById("win-02-code"), {
      lineNumbers: true,
      styleActiveLine: true,
      matchBrackets: true,
      theme: "default",
      mode: "shell",
      scrollbarStyle: null,
      readOnly: true
    });
    json = JSON.stringify(response, null, 2);
    $("#win-02-tab2").html("<pre>"+json+"</pre>");
  }
});
};

fnWin01("/api/tree/efocapp1u/?params=/var/log/");
//fnWin02("/api/emedsrv1u/sh/tail/?params=/opt/digitaldistribution/mediator-batch/conf/batch.properties");


$(".dropdown-menu").on("click","li",function(event){
  sample = event.target.innerText;
  console.log(sample);
  $("#win-01-tab1").jstree("destroy");
  fnWin01(sample);
});

});

</script>

</body>
</html>

