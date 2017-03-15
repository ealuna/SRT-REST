<?php
	require_once "connection.php";

	class execute{

        private static $ex = null; // Instancia de la clase
        private static $res; // Resultado

        // Metodo contructor
        final private function __construct(){
            try {
                connection::get_connection()->get_data_base();
            } catch (PDOException $e) {
                echo "Error: ".$e;
            }
        }

        // Devuelve la instancia de la clase
        public static function get_execute(){
            if (self::$ex === null) {
                self::$ex = new self();
            }
            return self::$ex;
        }

        // Devuelve el resultado de la operacion
		public function get_result($method, $table, $key, $set){
            if (self::$res === null) {
            	$sql = '';
            	  switch ($method) {
				    case 'GET':
				    	$sql = "select * from $table".($key===null?"":" WHERE idcliente=$key"); break;
				    case 'PUT':
						$sql = "update $table set $set where idcliente=$key"; break;
				    case 'POST':
				    	$sql = "insert into $table set ($set)"; break;
				    case 'DELETE':
				    	$sql = "delete $table where id=$key"; break;
				    default:
						$sql = "";
				  }

				  $sentencia = connection::get_connection()->get_data_base();
				  //$sentencia->execute();
				  //$result = $sentencia->fetchAll(PDO::FETCH_ASSOC);
				  $res = $sentencia->query($sql)->fetchAll(PDO::FETCH_ASSOC);
				  return self::$res;
				
            }
            return self::$res;
        }

        // Evita la clonación del objeto
        final protected function __clone(){
        }

        // Metodo destructor
        function _destructor(){
            self::$res = null;
        }

    }

?>