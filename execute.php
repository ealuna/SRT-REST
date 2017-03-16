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
            try{
                if (self::$res === null) {
                    switch ($method) {
                        case 'GET':
                            $sql = "SELECT * FROM ".$table.($key===null?"":" WHERE idcliente=$key"); break;
                        case 'PUT':
                            $sql = "UPDATE $table SET $set WHERE idcliente=$key"; break;
                        case 'POST':
                            $sql = "INSERT INTO $table SET($set)"; break;
                        case 'DELETE':
                            $sql = "DELETE $table WHERE id=$key"; break;
                        default:
                            $sql = "";
                    }
                    $sentencia = connection::get_connection()->get_data_base()->prepare($sql);
                    $sentencia->execute();
                    $res = $sentencia->fetchAll();
                    return json_encode($res);				
                }
                return self::$res;
            }catch(PDOException $e) {
                throw new ExcepcionApi(self::ESTADO_ERROR_BD, $e->getMessage());
            }
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