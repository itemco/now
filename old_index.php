<!doctype html>
<html>
<head>
<title>fabric1u - master</title>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

<!--
<link rel="stylesheet" type="text/css" media="screen" href="/css/ui.jqgrid.css" />
<link rel="stylesheet" type="text/css" media="screen" href="/css/ui.jqgrid-bootstrap.css" />
<link rel="stylesheet" type="text/css" media="screen" href="/css/ui.jqgrid-bootstrap-ui.css" />

<link rel="stylesheet" type="text/css" media="screen" href="http://www.trirand.com/blog/jqgrid/themes/redmond/jquery-ui-custom.css" />
<link rel="stylesheet" type="text/css" media="screen" href="http://www.trirand.com/blog/jqgrid/themes/ui.jqgrid.css" />
-->

<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js" type="text/javascript"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

<script src="/js/Chart.min.js" type="text/javascript"></script>
<script src="/js/jquery.peity.min.js" type="text/javascript"></script>
<!--
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
background: #f7f7f7;
background: repeating-linear-gradient(
  -55deg,
  #eea236,
  #eea236 2px,
  #f0ad4e 2px,
  #f0ad4e 4px
);
background: #f7f7f7;
font-family: "Arial Narrow"
}

table {
font-size: 90%;
text-align: left;
}

pre {
text-align: left;
}

.panel {
margin: 10px;
-webkit-box-shadow: 0px 0px 8px 1px rgba(0,0,0,0.2);
-moz-box-shadow: 0px 0px 8px 1px rgba(0,0,0,0.2);
box-shadow: 0px 0px 8px 1px rgba(0,0,0,0.2);
}

.panel-heading {
xfont-weight: bold;
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

.tab-content {
text-align: center;
}

.alert {
padding: 0.5em;
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
width: 33%;
margin: .1%;
display: block;
float: left;
}

.forth {
width: 24.8%;
margin: .1%;
display: block;
float: left;
}

.block {
xbackground: #eed;
height: 16em;
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

.half .panel-body {
height: 20em;
overflow-y: auto;
}

.half,.forth {
overflow-x: auto;
}

.forth .panel-body {
height: 20em;
overflow-y: auto;
}

</style>

</head>
<body>

<!-- accordion inside accordian, hm not quite so good -->
<div>

        <div class="panel-group" id="accordion1">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion1" href="#collapseOne">
              Collapsible Group #1
              </a></h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse in">
              <div class="panel-body">
                This is a simple accordion inner content...
              </div>
            </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion1" href="#collapseTwo">
                Collapsible Group #2 (With nested accordion inside)
              </a></h4>
            </div>
            <div id="collapseTwo" class="panel-collapse collapse">
              <div class="panel-body">

                <!-- Here we insert another nested accordion -->

                <div class="panel-group" id="accordion2">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion2" href="#collapseInnerOne">
                        Collapsible Inner Group Item #1
                      </a></h4>
                    </div>
                    <div id="collapseInnerOne" class="panel-collapse collapse in">
                      <div class="panel-body">
                        Anim pariatur cliche...
                      </div>
                    </div>
                  </div>
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion2" href="#collapseInnerTwo">
                        Collapsible Inner Group Item #2
                      </a></h4>
                    </div>
                    <div id="collapseInnerTwo" class="panel-collapse collapse">
                      <div class="panel-body">
                        Anim pariatur cliche...
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Inner accordion ends here -->

              </div>
            </div>
          </div>
        </div>

</div>

<div id="blocks">

<div id="win-07" class="half">
  <div class="panel panel-default">
    <div class="panel-heading">Title</div>
    <ul class="nav nav-pills" role="tablist">
      <li role="content" class="active"><a href="#win-07-tab1" role="tab" data-toggle="tab">Default</a></li>
      <li role="content"><a href="#win-07-tab2" role="tab" data-toggle="tab">JSON</a></li>
    </ul>
    <div class="panel-body">
      <div class="tab-content">
        <div role="tabpanel" id="win-07-tab1" class="tab-pane fade in active">default</div>
        <div role="tabpanel" id="win-07-tab2" class="tab-pane fade">json</div>
      </div>
    </div>
  </div>
</div>
<div id="win-08" class="half">
  <div class="panel panel-default">
    <div class="panel-heading">Title</div>
    <ul class="nav nav-pills" role="tablist">
      <li role="content" class="active"><a href="#win-08-tab1" role="tab" data-toggle="tab">Default</a></li>
      <li role="content"><a href="#win-08-tab2" role="tab" data-toggle="tab">JSON</a></li>
    </ul>
    <div class="panel-body">
      <div class="tab-content">
        <div role="tabpanel" id="win-08-tab1" class="tab-pane fade in active">default</div>
        <div role="tabpanel" id="win-08-tab2" class="tab-pane fade">json</div>
      </div>
    </div>
  </div>
</div>

<div id="win-01" class="half">
  <div class="panel panel-default">
    <div class="panel-heading">Title</div>
    <ul class="nav nav-pills" role="tablist">
      <li role="content" class="active"><a href="#win-01-tab1" role="tab" data-toggle="tab">Default</a></li>
      <li role="content"><a href="#win-01-tab2" role="tab" data-toggle="tab">JSON</a></li>
    </ul>
    <div class="panel-body">
      <div class="tab-content">
        <div role="tabpanel" id="win-01-tab1" class="tab-pane fade in active">default</div>
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

<div id="win-03" class="half">
  <div class="panel panel-default">
    <div class="panel-heading">Title</div>
    <ul class="nav nav-pills" role="tablist">
      <li role="content" class="active"><a href="#win-03-tab1" role="tab" data-toggle="tab">Default</a></li>
      <li role="content"><a href="#win-03-tab2" role="tab" data-toggle="tab">JSON</a></li>
    </ul>
    <div class="panel-body">
      <div class="tab-content">
        <div role="tabpanel" id="win-03-tab1" class="tab-pane fade in active">default</div>
        <div role="tabpanel" id="win-03-tab2" class="tab-pane fade">json</div>
      </div>
    </div>
  </div>
</div>

<div id="win-04" class="half">
  <div class="panel panel-default">
    <div class="panel-heading">Title</div>
    <ul class="nav nav-pills" role="tablist">
      <li role="content" class="active"><a href="#win-04-tab1" role="tab" data-toggle="tab">Default</a></li>
      <li role="content"><a href="#win-04-tab2" role="tab" data-toggle="tab">JSON</a></li>
    </ul>
    <div class="panel-body">
      <div class="tab-content">
        <div role="tabpanel" id="win-04-tab1" class="tab-pane fade in active">default</div>
        <div role="tabpanel" id="win-04-tab2" class="tab-pane fade">json</div>
      </div>
    </div>
  </div>
</div>

<div id="win-05" class="half">
  <div class="panel panel-default">
    <div class="panel-heading">Title</div>
    <ul class="nav nav-pills" role="tablist">
      <li role="content" class="active"><a href="#win-05-tab1" role="tab" data-toggle="tab">Default</a></li>
      <li role="content"><a href="#win-05-tab2" role="tab" data-toggle="tab">JSON</a></li>
    </ul>
    <div class="panel-body">
      <div class="tab-content">
        <div role="tabpanel" id="win-05-tab1" class="tab-pane fade in active">default</div>
        <div role="tabpanel" id="win-05-tab2" class="tab-pane fade">json</div>
      </div>
    </div>
  </div>
</div>

<div id="win-06" class="half">
  <div class="panel panel-default">
    <div class="panel-heading">Title</div>
    <ul class="nav nav-pills" role="tablist">
      <li role="content" class="active"><a href="#win-06-tab1" role="tab" data-toggle="tab">Default</a></li>
      <li role="content"><a href="#win-06-tab2" role="tab" data-toggle="tab">JSON</a></li>
    </ul>
    <div class="panel-body">
      <div class="tab-content">
        <div role="tabpanel" id="win-06-tab1" class="tab-pane fade in active">default</div>
        <div role="tabpanel" id="win-06-tab2" class="tab-pane fade">json</div>
      </div>
    </div>
  </div>
</div>



<div class="half" style="overflow-x:auto;">
<div class="panel panel-default">
<div id="title0" class="panel-heading">File content in a code-editor</div>
<ul class="nav nav-pills" role="tablist">
  <li role="content" class="active"><a href="#default0" aria-controls="default" role="tab" data-toggle="tab">Default</a></li>
  <li role="content"><a href="#json0" aria-controls="json" role="tab" data-toggle="tab">JSON</a></li>
</ul>
<div class="panel-body" style="height: 30em; overflow-y: scroll;">
<div class="tab-content">
    <div role="tabpanel" class="tab-pane fade in active" id="default0"><textarea id="code0" style="display:none;">code/content</textarea></div>
    <div role="tabpanel" class="tab-pane fade" id="json0"><pre id="jsonp0">result</pre></div>
</div>
</div>
<div class="panel-footer">footer</div>
</div>
</div>

<div class="half" style="overflow-x:auto;">
<div class="panel panel-default">
<div id="title4" class="panel-heading">Form testing</div>
<ul class="nav nav-pills" role="tablist">
  <li role="content" class="active"><a href="#default4" aria-controls="default" role="tab" data-toggle="tab">Default</a></li>
  <li role="content"><a href="#json4" aria-controls="json" role="tab" data-toggle="tab">JSON</a></li>
</ul>
<div class="panel-body" style="height: 30em; overflow-y: scroll;">
<form>
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
  </div>
  <div class="form-group">
    <label for="exampleInputFile">File input</label>
    <input type="file" id="exampleInputFile">
    <p class="help-block">Example block-level help text here.</p>
  </div>
  <div class="checkbox">
    <label>
      <input type="checkbox"> Check me out
    </label>
  </div>
  <button type="submit" class="btn btn-default">Submit</button>
</form>
</div>
<div class="panel-footer">footer</div>
</div>
</div>

<div class="half" style="overflow-x:auto;">
<div class="panel panel-default">
<div id="title1" class="panel-heading">Panel Heading</div>
<ul class="nav nav-pills" role="tablist">
  <li role="content" class="active"><a href="#default1" aria-controls="default" role="tab" data-toggle="tab">Default</a></li>
  <li role="content"><a href="#json1" aria-controls="json" role="tab" data-toggle="tab">JSON</a></li>
</ul>
<div class="panel-body" style="height: 30em; overflow-y: scroll;">
<div class="tab-content">
    <div role="tabpanel" class="tab-pane fade in active" id="default1"><div id="table1">result</div></div>
    <div role="tabpanel" class="tab-pane fade" id="json1"><pre id="jsonp1">result</pre></div>
</div>
</div>
<div class="panel-footer">footer</div>
</div>
</div>

<div class="half" style="overflow-x:auto;">
<div class="panel panel-default">
<div id="title2" class="panel-heading">Panel Heading</div>
<ul class="nav nav-pills" role="tablist">
  <li role="content" class="active"><a href="#default2" aria-controls="default" role="tab" data-toggle="tab">Default</a></li>
  <li role="content"><a href="#json2" aria-controls="json" role="tab" data-toggle="tab">JSON</a></li>
</ul>
<div class="panel-body" style="height: 30em; overflow-y: scroll;">
<div class="tab-content">
    <div role="tabpanel" class="tab-pane fade in active" id="default2"><div id="table2">result</div></div>
    <div role="tabpanel" class="tab-pane fade" id="json2"><pre id="jsonp2">result</pre></div>
</div>
</div>
</div>
</div>

<div class="half" style="overflow-x:auto;">
<div class="panel panel-default">
<div id="title3" class="panel-heading">Panel Heading</div>
<ul class="nav nav-pills" role="tablist">
  <li role="content" class="active"><a href="#default3" aria-controls="default" role="tab" data-toggle="tab">Default</a></li>
  <li role="content"><a href="#json3" aria-controls="json" role="tab" data-toggle="tab">JSON</a></li>
</ul>
<div class="panel-body" style="height: 30em; overflow-y: scroll;">
<div class="tab-content">
    <div role="tabpanel" class="tab-pane fade in active" id="default3"><div id="table3">result</div></div>
    <div role="tabpanel" class="tab-pane fade" id="json3"><pre id="jsonp3">result</pre></div>
</div>
</div>
</div>
</div>
</div>

<div class="wide" style="overflow-x:auto;">
<div class="panel panel-success">
<div class="panel-heading">Panel Heading</div>
<div class="panel-body">
<textarea class="form-control" rows="8">yo</textarea>
<pre style="height: 10em; overflow-y: scroll;">
1
2
3
4
5
6
7
8
</pre>
</div>
</div>
</div>
</div>

<div class="wide" style="overflow-x:auto;">
<div class="panel panel-success">
<div class="panel-heading">File list [ls.sh] with params: /var/log/httpd/</div>
<div class="panel-body">
<div id="table1">result</div>
</div>
</div>
</div>

<div class="wide" style="overflow-x:auto;">
<div class="panel panel-success">
<div class="panel-heading">Processes [ps.sh] with params: apache</div>
<div class="panel-body">
<div id="table2">result</div>
</div>
</div>
</div>

<div id="view" class="wide">
<div class="panel panel-success">
<div class="panel-heading">File view [cat.sh] with params: /usr/share/doc/words-3.0/readme.txt</div>
<div class="panel-body">
<pre>content</pre>
</div>
</div>
</div>

<div id="table" class="wide">
<table class="ui-jqgrid-table" id="list1"></table>
<div id="pager1"></div>
</div>

<div id="table" class="wide">
<table class="ui-jqgrid-table" id="list2"></table>
<div id="pager2"></div>
</div>

<div id="disc" class="block">
<h3 class="disc title">title</h3>
<canvas id="disc chart-area" width="190" height="190"/>
</div>
<div id="memory" class="block">
<h3 class="memory title">title</h3>
<canvas id="memory chart-area" width="190" height="190"/>
</div>
<div id="other1" class="block">
<h3 class="memory title">title</h3>
<canvas id="memory chart-area" width="190" height="190"/>
</div>
<div id="other2" class="block">
<h3 class="memory title">title</h3>
<canvas id="memory chart-area" width="190" height="190"/>
</div>
<div id="other3" class="block">
<h3 class="memory title">title</h3>
<canvas id="memory chart-area" width="190" height="190"/>
</div>

<div id="disc" class="text">
<h3 class="disc title">title</h3>
<pre>value</pre>
</div>

<div id="memory" class="text">
<h3 class="memory title">title</h3>
<pre>value</pre>
</div>

</div>

<!-- Button trigger modal -->
<div>
<p><a data-toggle="modal" data-target="#myModal" href="#">modal</a></p>
<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
  Launch demo modal
</button>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">File view</h4>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

</div>

<script>

window.onload = function() {


/*
$('#myModal').modal()                      // initialized with defaults
$('#myModal').modal({ keyboard: false })   // initialized with no keyboard
$('#myModal').modal('hide')                // initializes and invokes show immediately
*/

/*
$('#myModal').on('shown.bs.modal', function () {
  $('#myInput').focus()
})
*/
/* peity chart stuff*/

$.fn.peity.defaults.pie = {
  delimiter: null,
  fill: ["red", "lightblue", "orange"],
  height: null,
  radius: 8,
  width: null
}

/* functions */

function fnCheckAlert(response) {
  var output = "";
  if (response["alert"] != "success") {
    output = "<div class='alert alert-"+response["alert"]+"' role='alert'>"+response["message"]+"</div>";
  }
  return output;
}

function fnTableFromArray(result) {
  console.log('fnTableFromArray');
  //console.log(result);
  var output = fnCheckAlert(result["response"]);
  var table = '<table class="table table-condensed table-striped">';
  $.each(result["data"]["tbl"], function(row) {
    table += "<tr>";
    $.each(result["data"]["tbl"][row], function(key, value) {
      if (row == 0) {
        table += "<th>"+value+"</th>";
      } else {
        //add function instead of this, for all kinda replaces coming up later on, but good for now
        if (value == "RUNNING") {
          value = "<span class='label label-success'>"+value+"</span>";
        }
        if (value == "STOPPED") {
          value = "<span class='label label-danger'>"+value+"</span>";
        }
        //test to replace any % found with peity-charts
        if (value.indexOf('%') != -1 ) {
          var red = value.replace("%","");
          var grn = 100-parseInt(value);
          value = "<span title=\""+value+"\"><span class=\"pie\">"+red+"/"+grn+"</span></span>";
        }
        table += "<td>"+value+"</td>";
      }
    })
    table += "</tr>";
  })
  table += "</table>";
  output += table;
  return output;
};

function fnPieFromArray(result) {
  console.log('fnPieFromArray');
  //console.log(result);
  //var output = fnCheckAlert(result["response"]);
  //$output = "<canvas id=\"myPie\" width=\"260px\" height=\"260px\"></canvas>";
  return $output;
}

function fnTitleFromArray(result) {
  console.log('fnTitleFromArray');
  //console.log(result);
  var message = result["response"]["message"];
  var rows = result["response"]["rows"];
  var time = result["response"]["time"];
  var host = result["request"]["host"];
  var title = result["request"]["title"];
  var params = result["request"]["params"];
  var output = title+" on "+host+" ("+rows+" rows in "+time+"s)"
  return output;
};

/* AJAX CALLS HERE */

$.ajax({
  type: 'GET',
  url: '/api/eodassv2u/sh/free/',
  dataType: 'json',
  success: function (response) {
    //console.log(response);
    $("#win-07 .panel-heading").html(fnTitleFromArray(response));
    $("#win-07-tab1").html("<canvas id=\"myPie\" width=\"260px\" height=\"260px\"></canvas>");
    var ctx = document.getElementById("myPie").getContext("2d");
    var myNewPie = new Chart(ctx).Pie(response["data"]["pie"]); //skipping ,options for now
    json = JSON.stringify(response, null, 2);
    $("#win-07-tab2").html("<pre>"+json+"</pre>");
  }
});

$.ajax({
  type: 'GET',
  url: '/api/eodassv2u/sh/df/',
  dataType: 'json',
  success: function (response) {
    //console.log(response);
    $("#win-08 .panel-heading").html(fnTitleFromArray(response));
    $("#win-08-tab1").html("<canvas id=\"myChart\" width=\"260px\" height=\"260px\"></canvas>");
    var ctx = document.getElementById("myChart").getContext("2d");
    var myNewChart = new Chart(ctx).Bar(response["data"]["bar"]); //skipping ,options for now
    json = JSON.stringify(response, null, 2);
    $("#win-08-tab2").html("<pre>"+json+"</pre>");
  }
});

$.ajax({
  type: 'GET',
  url: '/api/emedsrv1u/sh/df/',
  dataType: 'json',
  success: function (response) {
    //console.log(response);
    $("#win-01 .panel-heading").html(fnTitleFromArray(response));
    $("#win-01-tab1").html(fnTableFromArray(response));
    $("table span.pie").peity("pie");
    json = JSON.stringify(response, null, 2);
    $("#win-01-tab2").html("<pre>"+json+"</pre>");
  }
});

$.ajax({
  type: 'GET',
  url: '/api/emedsrv1u/cs/digdis/',
  dataType: 'json',
  success: function (response) {
    //console.log(response);
    $("#win-02 .panel-heading").html(fnTitleFromArray(response));
    $("#win-02-tab1").html(fnTableFromArray(response));
    $("table span.pie").peity("pie");
    json = JSON.stringify(response, null, 2);
    $("#win-02-tab2").html("<pre>"+json+"</pre>");
  }
});

$.ajax({
  type: 'GET',
  url: '/api/emedsrv1u/sh/ls/?params=/var/log/',
  dataType: 'json',
  success: function (response) {
    //console.log(response);
    $("#win-03 .panel-heading").html(fnTitleFromArray(response));
    $("#win-03-tab1").html(fnTableFromArray(response));
    $("table span.pie").peity("pie");
    json = JSON.stringify(response, null, 2);
    $("#win-03-tab2").html("<pre>"+json+"</pre>");
  }
});

$.ajax({
  type: 'GET',
  url: '/api/emedsrv1u/sh/cat/?params=sample.js',
  dataType: 'json',
  success: function (response) {
    //console.log(response);
    $("#win-04 .panel-heading").html(fnTitleFromArray(response));
    $("#win-04-tab1").html("<textarea id='win-04-code'>"+atob(response["data"]["txt"])+"</textarea>");
    var editor = CodeMirror.fromTextArea(document.getElementById("win-04-code"), {
      lineNumbers: true,
      styleActiveLine: true,
      matchBrackets: true,
      theme: "default",
      mode: "javascript",
      scrollbarStyle: null,
      readOnly: true
    });
    json = JSON.stringify(response, null, 2);
    $("#win-04-tab2").html("<pre>"+json+"</pre>");
  }
});

$.ajax({
  type: 'GET',
  url: '/api/emedsrv1u/sh/ps/',
  dataType: 'json',
  success: function (response) {
    //console.log(response);
    $("#win-05 .panel-heading").html(fnTitleFromArray(response));
    $("#win-05-tab1").html(fnTableFromArray(response));
    $("table span.pie").peity("pie");
    json = JSON.stringify(response, null, 2);
    $("#win-05-tab2").html("<pre>"+json+"</pre>");
  }
});

$.ajax({
  type: 'GET',
  url: '/api/exodassv2u/sh/rpm/',
  dataType: 'json',
  success: function (response) {
    //console.log(response);
    $("#win-06 .panel-heading").html(fnTitleFromArray(response));
    $("#win-06-tab1").html(fnTableFromArray(response));
    $("table span.pie").peity("pie");
    json = JSON.stringify(response, null, 2);
    $("#win-06-tab2").html("<pre>"+json+"</pre>");
  }
});

}

</script>
</body>
</html>

