<?php

#This function creates a data-array in jstree-format
function fnCreateTree($tree) {

  #disallowed file-extensions (to open in editor)
  $bad = ["ico","jks","java","jar","class","zip","gz","gif","jpg","pdf","tif","png"];

  #build an array we can work with
  $core = [];
  foreach($tree as $row) {
    $row = $row[0];
    $split = explode("/", $row);
    unset($split[0]);
    $prev = "#";
    $node = "";
    $count = count($split);
    $c = 0;
    foreach($split as $key=>$val) {
      $node.="/$val";
      $c++;
      if ($val != "") {
        $core[$node]["id"] = "";
        $core[$node]["parent"] = $prev;
        $core[$node]["text"] = $val;
        $core[$node]["icon"] = "jstree-folder";
        if ($c == $count) {
          $core[$node]["icon"] = "jstree-file";
          $core[$node]["a_attr"] = ["href"=>"$row"];
          $ext = strtolower(pathinfo($val, PATHINFO_EXTENSION));
          if (in_array($ext, $bad)) {
            $core[$node]["state"]["disabled"] = 1;
            $core[$node]["a_attr"] = ["href"=>""];
          }
        }
      }
      $prev = $node;
    }
  }

  #change parents to id:s
  $i = 0;
  foreach ($core as $k=>$v) {
    $core[$k]["id"] = $i;
    $parent = $core[$k]["parent"];
    $core[$k]["parent"] = $core[$parent]["id"];
    $i++;
  }

  #now create arr without keys for json
  $new = [];
  foreach($core as $row) {
    if(is_null($row["parent"])) {
      $row["parent"] = "#";
    }
    $new[] = $row;
  }

  return $new;

}

?>

