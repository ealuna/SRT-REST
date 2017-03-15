<?php
  require_once 'connection.php';
  require_once 'execute.php';

    $method = $_SERVER['REQUEST_METHOD']; // Tipo de peticion
    $as = trim($_SERVER['PATH_INFO'], '/');
    $request = explode('/', $as); // Tabla y codigo
    //$input = json_decode(file_get_contents('php://input'), true); // Datos capturados

    // retrieve the table and key from the path
    $table = preg_replace('/[^a-z0-9_]+/i','',array_shift($request));
    $key = array_shift($request);

    // escape the columns and values from the input object
    //$columns = preg_replace('/[^a-z0-9_]+/i','',array_keys($input));
   // $link = connection::get_connection()->get_data_base();
 /*   $values = array_map(function ($value) use ($link) {
      if ($value===null) {
        return null;
      }else{
        return $link->quote((string)$value);
      }  
    },array_values($input));  */
 
    // build the SET part of the SQL command
    $set = '';

    /*for ($i=0; $i<count($columns); $i++) {

      $set.=($i>0?',':'');
      $set.=($method==='GET'?'':$columns[$i].'=');
      $set.=($values[$i]===null?'NULL':$values[$i]);

    }*/

  // excecute SQL statement
  $result = execute::get_execute()->get_result($method, $table, $key, $set);
   print_r($result);
  // die if SQL statement failed
/*  if (!$result) {
    http_response_code(404);
    die(mysqli_error());
  }*/
   


  // print results, insert id or affected row count
  /*if ($method == 'GET') {
     echo '[';
    for ($i=0;$i<90;$i++) {
      echo ($i>0?',':'').json_encode($result->fetchAll(PDO::FETCH_ASSOC));
    }
    echo ']';
  } elseif ($method == 'POST') {
  } else {
  }*/
   
  // close mysql connection
  //mysqli_close($link);
  
  ?>