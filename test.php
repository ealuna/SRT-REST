<?php
require_once 'connection.php';
$as = trim($_SERVER['PATH_INFO'], "/");
$request = explode('/', $as);

//echo $as;
print_r($request);
$req1 = preg_replace('/[^a-z0-9_]+/i','',$request);
print_r($req1);
//echo $_SERVER['PATH_INFO']."\n";
$link = connection::get_connection()->get_data_base();

  $values = array_map(function ($value) use ($link) {
    if ($value===null) {
      return null;
    }else{
      return $link->quote((string)$value);
    }  
  },array_values($request));

  print_r($values);

?>