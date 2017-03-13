<?php

require_once 'connect.php';

class getdatos
{

    private static $dato;


    final private function __construct()
    {
        try {
            self::obtener_datos();
        } catch (PDOException $e) {

        }
    }


    public static function obtener_datos($codigo)
    {

        $comando = "SELECT contra FROM contrasenha WHERE idcliente = ?";

        try {

        $sentencia = conexion::obtenerInstancia()->obtener_bd()->prepare($comando);

        $sentencia->bindParam(1, $codigo);

        $sentencia->execute();

            if ($sentencia) {
                $dato = $sentencia->fetch();
                return json_encode($dato);

            } else {
                return null;
            }

        } catch (PDOException $e) {
        throw new ExcepcionApi(self::ESTADO_ERROR_BD, $e->getMessage());

        }
    }

    public static function obtener_datos2($codigo)
    {

        $comando = "SELECT nomcli FROM fleteros WHERE idcliente = ?";

        try {

        $sentencia = conexion::obtenerInstancia()->obtener_bd()->prepare($comando);

        $sentencia->bindParam(1, $codigo);

        $sentencia->execute();

            if ($sentencia) {
                $dato = $sentencia->fetch();
                return json_encode($dato);

            } else {
                return null;
            }

        } catch (PDOException $e) {
        throw new ExcepcionApi(self::ESTADO_ERROR_BD, $e->getMessage());

        }
    }

    final protected function __clone()
    {
    }

    function _destructor()
    {
        self::$pdo = null;
    }
}

?>