<?php
$as = trim($_SERVER['PATH_INFO'],'/');
$request = explode('/', $as);
//array_shift($request);
//echo $as;
var_dump($request);
echo $_SERVER['PATH_INFO']."\n";
echo $_SERVER['REQUEST_URI'];

?>