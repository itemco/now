<?php

#source: http://stackoverflow.com/questions/8830599/php-convert-xml-to-json

function xml2js($xmlnode) {
    $root = (func_num_args() > 1 ? false : true);
    $jsnode = array();

    if (!$root) {
        if (count($xmlnode->attributes()) > 0){
	    #$jsnode["$"] = array();
            foreach($xmlnode->attributes() as $key => $value) {
                $jsnode[$key] = (string)$value;
	    }
        }
        $textcontent = trim((string)$xmlnode);
        if (count($textcontent) > 0)
            #$jsnode["_"] = $textcontent;

        foreach ($xmlnode->children() as $childxmlnode) {
            $childname = $childxmlnode->getName();
            if (!array_key_exists($childname, $jsnode))
                $jsnode[$childname] = array();
            array_push($jsnode[$childname], xml2js($childxmlnode, true));
        }
        return $jsnode;
    } else {
        $nodename = $xmlnode->getName();
        $jsnode[$nodename] = array();
        array_push($jsnode[$nodename], xml2js($xmlnode, true));
        return json_encode($jsnode);
    }
}

$xml = simplexml_load_file("myfile.xml");
$json = xml2js($xml);

#echo $json;

echo "<pre>";
$arr = json_decode($json, true);
print_r($arr);
echo "</pre>";

#now test to pick out all directories...

function test_print($item, $key)
{
  #$x = array_key($key);
  echo "$x - $key : $item<br/>";
}

array_walk_recursive($arr, 'test_print');



?>

