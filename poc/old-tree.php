<!doctype html>
<html>
<head>
<title>fabric1u - tree</title>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="/css/bootstrap.min.css">
<link rel="stylesheet" href="/css/bootstrap-glyphicons.css">

<!--
<link rel="stylesheet" type="text/css" media="screen" href="/css/ui.jqgrid-bootstrap.css" />
<link rel="stylesheet" type="text/css" media="screen" href="/css/ui.jqgrid-bootstrap-ui.css" />

<link rel="stylesheet" type="text/css" media="screen" href="http://www.trirand.com/blog/jqgrid/themes/redmond/jquery-ui-custom.css" />
<link rel="stylesheet" type="text/css" media="screen" href="http://www.trirand.com/blog/jqgrid/themes/ui.jqgrid.css" />
-->

<link rel="stylesheet" href="//static.jstree.com/3.2.1/assets/dist/themes/default/style.min.css">

<script src="/js/jquery.min.js" type="text/javascript"></script>
<script src="/js/bootstrap.min.js" type="text/javascript"></script>
<script src="/js/jstree.min.js" type="text/javascript"></script>

<!--
<script src="/js/Chart.min.js" type="text/javascript"></script>
<script src="/js/grid.locale-sv.js" type="text/javascript"></script>
<script src="/js/jquery.jqGrid.min.js" type="text/javascript"></script>
-->
<script src="/js/codemirror.js" type="text/javascript"></script>
<script src="/js/mode/javascript.js" type="text/javascript"></script>
<link rel="stylesheet" href="/css/codemirror.css">
<link rel="stylesheet" href="/css/neat.css">

<style>

body {
margin: 0 auto;
background: white;
font-family: "Arial Narrow"
font-family: monospace;

}

table {
font-size: 80%;
}

.panel {
margin: 10px;
-webkit-box-shadow: 0px 0px 8px 1px rgba(0,0,0,0.2);
-moz-box-shadow: 0px 0px 8px 1px rgba(0,0,0,0.2);
box-shadow: 0px 0px 8px 1px rgba(0,0,0,0.2);
}

.panel-heading {
xfont-weight: bold;
font-size: 90%;
}

.panel-success>.panel-heading {
background-color: #3c763d;
color: white;
border-color: none;
border: none;
}

.panel-default>.panel-heading {
background-color: #337ab7;
color: white;
border-color: none;
border: none;
}

.panel-body {
padding-top: 0;
padding-bottom: 0;
xborder-top: 1px solid #eee;
margin-right: 1px;
}

.panel-footer {
font-size: 80%;
background: white;
xpadding: 1em;
display: none;
}

ul.nav {
margin: 1em;
font-size: 80%;
}

.nav li a {
padding: 0 1em 0 1em;
}

#blocks {
width: 100%;
}

.wide {
xbackground: #eee;
xheight: 16em auto;
width: 99%;
text-align: left;
display: block;
xoverflow: scroll;
float: left;
margin: .5%;
}

.half {
width: 49.8%;
margin: .1%;
display: block;
float: left;
}

.block {
xbackground: #eed;
height: 32em;
width: 19.8%;
text-align: center;
display: block;
float: left;
margin: .1%;
xpadding:0.1em;
}

.text {
xbackground: #eed;
xheight: 8em;
width: 19.8%;
text-align: left;
display: block;
float: left;
margin: .1%;
}

.panel-body {
height: 35em;
overflow-y: auto;
}

.half {
overflow-x: auto;
}

.panel-heading span {
display: block;
float: right;
}

#win-01-tab1 {
font-size: 80%;
}

.jstree-anchor.jstree-disabled {
color: #ccc;
}

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
    <li><a href="#">/api/efocapp1u/sh/tree/?params=/opt/focus2/</a></li>
    <li><a href="#">/api/efocapp1u/sh/tree/?params=/opt/focus2/batch/logs/</a></li>
    <li><a href="#">/api/efocapp1u/sh/tree/?params=/var/log/focus2-services/</a></li>
  </ul>
</div>
</div>

<script>

//window.onload = function() {
$(document).ready(function() {

function fnTitleFromArray(data) {
  //console.log('fnTitleFromArray');
  //console.log(data);
  var message = data["response"]["message"];
  var rows = data["response"]["rows"];
  var time = data["response"]["time"];
  var host = data["request"]["host"];
  var title = data["request"]["title"];
  var params = data["request"]["params"];
  var executed = data["request"]["executed"];
  var result = title+" on "+host+" ("+rows+" rows in "+time+"s)";
  return result;
};

//weird click beacue element is created dynamically
$(document).on('click', '.panel-heading span', function() {
  $(this).css("color", "gray");
  id = $(this).attr("id");
  url = $(this).attr("name");
  console.log(id+" : "+url);
  //clear content to see something is happening :)
  $(id+"-tab1").html("Fetching data, please wait...");
  //now do ajax from here?
  //we should refresh corresponding ajax depending on window clicked
});

function fnWin01(url) {
$.ajax({
  type: 'GET',
  url: url,
  dataType: 'json',
  success: function (response) {
    var id = "#win-01";
    //console.log(response);
    data = response["data"];
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
    fnWin02("/api/efocapp1u/sh/tail/?params="+link);
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
    data = atob(response["data"]);
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
      mode: "javascript",
      scrollbarStyle: null,
      readOnly: true
    });
    json = JSON.stringify(response, null, 2);
    $("#win-02-tab2").html("<pre>"+json+"</pre>");
  }
});
};

fnWin01("/api/efocapp1u/sh/tree/?params=/opt/focus2/");
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

