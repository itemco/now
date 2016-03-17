function fnTableFromArray(data) {
  //console.log('fnTableFromArray');
  //console.log(data);
  var table = '<table class="table table-condensed table-striped">';
  $.each(data, function(row) {
    table += "<tr>";
    $.each(data[row], function(key, value) {
      if (row == 0) {
        table += "<th>"+value+"</th>";
      } else {

        if (value == "Running") {
          value = "<span class='label label-success'>Running</span>";
        }
        if (value == "Stopped") {
          value = "<span class='label label-danger'>Stopped</span>";
        }

        table += "<td>"+value+"</td>";
      }
    })
    table += "</tr>";
  })
  table += "</table>";
  return table;
};

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

function fnBigNumber(data) {
  console.log(data);
  var result = "<pre><small>"+data[0]+"</small></pre><h1>"+data[1]+"</h1>";
  return result;
};

function fnRefresh(url) {
  console.log(url);
};

//weird click because element is created dynamically
$(document).on('click', '.panel-heading span', function() {
  $(this).css("color", "gray");
  id = $(this).attr("id");
  url = $(this).attr("name");
  console.log(id+" : "+url);
  //clear content to see something is happening :)
  $(id+"-tab1").html("Fetching data, please wait...");
  //now do ajax from here?
  $.ajax({
    type: 'GET',
    url: url,
    dataType: 'json',
    success: function (response) {
      //console.log(response);
      data = response["data"]["tbl"];
      $(id+" .panel-heading").html(fnTitleFromArray(response));
      var refresh = "<span class=\"glyphicon glyphicon-refresh\" id="+id+" name=\""+this.url+"\"></span>";
      $(id+" .panel-heading").append(refresh);
      $(id+"-tab1").html(fnTableFromArray(data));
      json = JSON.stringify(response, null, 2);
      $(id+"-tab2").html("<pre>"+json+"</pre>");
    }
  });
});


