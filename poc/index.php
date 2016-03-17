<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

<title>fabric1u - poc</title>

<link rel="stylesheet" href="/css/bootstrap.min.css">
<link rel="stylesheet" href="/css/bootstrap-glyphicons.css">

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<script src="/js/jquery.min.js" type="text/javascript"></script>
<script src="/js/bootstrap.min.js"></script>

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
xbackground: #f7f7f7;
font-family: "Arial Narrow"
font-family: monospace;

}

#block {
margin: 0 auto;
margin-top: 3em;
width: 60%;
background: white;
padding: 2em;
}

iframe {
  border: none;
  width: 100%;
  overflow:hidden;
  height: 700px;
}

.modal-lg {
width: 1200px;
}

</style>

</head>
<body>

<div id="block">

<h3>POC:s</h3>

<button type="button" href="ls.php" data-remote="false" data-toggle="modal" data-target="#myModal" class="btn btn-info btn-lg btn-block">
LS - A simple file/dir-listing (ex: ls -la)
</button>
<button type="button" href="df.php" data-remote="false" data-toggle="modal" data-target="#myModal" class="btn btn-info btn-lg btn-block">
DF - Show disc info (ex: df -m)
</button>
<button type="button" href="cs.php" data-remote="false" data-toggle="modal" data-target="#myModal" class="btn btn-info btn-lg btn-block">
CS - Check services (ex Utdata)
</button>
<button type="button" href="rpm.php" data-remote="false" data-toggle="modal" data-target="#myModal" class="btn btn-info btn-lg btn-block">
RPM - Show installed rpm-packages (ex rpm -qa)
</button>
<button type="button" href="dbc.php" data-remote="false" data-toggle="modal" data-target="#myModal" class="btn btn-info btn-lg btn-block">
DBC - Select count in db (ex select count(*) from table where status=3)
</button>
<button type="button" href="pb.php" data-remote="false" data-toggle="modal" data-target="#myModal" class="btn btn-info btn-lg btn-block">
PB - Show Puppet Branches (eg curl to internal web-page)
</button>
<button type="button" href="tree.php" data-remote="false" data-toggle="modal" data-target="#myModal" class="btn btn-info btn-lg btn-block">
TREE - Show file tree and view file in editor
</button>

</div>

<!-- Default bootstrap modal example -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
        <iframe class="page" src="#"></iframe>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>



<script>
$(document).ready(function() {

// Fill modal with content from link href
$("#myModal").on("show.bs.modal", function(e) {
    var link = $(e.relatedTarget);
    $(this).find(".page").prop("src", link.attr("href"));
    $(this).find(".modal-title").text(link.attr("href"));

});

});
</script>

</body>
</html>

