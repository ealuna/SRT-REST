<?php
    require_once 'config.php';

    class connection{

        private static $db = null; // Instancia de la clase
        private static $pdo; // Conexion

        // Metodo contructor
        final private function __construct(){
            try {
                self::get_data_base();
            } catch (PDOException $e) {
                echo "Error: ".$e;
            }
        }

        // Devuelve la instancia de la clase
        public static function get_connection(){
            if (self::$db === null) {
                self::$db = new self();
            }
            return self::$db;
        }

        // Devuelve la conexion a la base de datos
        public function get_data_base(){
            if (self::$pdo == null) {
                // Establece conexion a la base de datos
                self::$pdo = new PDO('sqlsrv:Server='.HOSTNAME.';Database='.DATABASE.";",USERNAME,PASSWORD);
                self::$pdo->exec("set names utf8");
                // Habilitar excepciones
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            return self::$pdo;
        }

        // Evita la clonación del objeto
        final protected function __clone(){
        }

        // Metodo destructor
        function _destructor(){
            self::$pdo = null;
        }

    }
?>