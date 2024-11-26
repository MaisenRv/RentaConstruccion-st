<?php

namespace DB;

use Exception;

class ConnectDB{
    // Usuario de proveedor
    private const SERVER_NAME = "localhost";
    private const CONNECT_OPTIONS_PROVEEDOR = [
        "Database" => "RentaConstruccionDB",
        "UID" => "AppRentaConstruccion",
        "PWD" => "1234",
        "CharacterSet" => "UTF-8" 
    ];
    // Usuario de cliente
    private const CONNECT_OPTIONS_CLIENTE = [
        "Database" => "RentaConstruccionDB",
        "UID" => "Login2",
        "PWD" => "987654321",
        "CharacterSet" => "UTF-8" 
    ];

    // Conexion para proveedor 
    public static function connect_proveedor(){
        try {
            $conn = sqlsrv_connect(ConnectDB::SERVER_NAME, ConnectDB::CONNECT_OPTIONS_PROVEEDOR);
            
            if ($conn) {
                sqlsrv_configure("WarningsReturnAsErrors", 0);
                return $conn;
            }else{
                throw new Exception("NO se pudo conectar a la base de datos\n");
            }
        } catch (Exception $e) {
            echo "Error: ".$e->getMessage();
            die(print_r(sqlsrv_errors(), true));
        }
    }

    // Conexion para cliente
    public static function connect_cliente(){
        try {
            $conn = sqlsrv_connect(ConnectDB::SERVER_NAME, ConnectDB::CONNECT_OPTIONS_CLIENTE);
            if ($conn) {
                sqlsrv_configure("WarningsReturnAsErrors", 0);
                return $conn;
            }else{
                throw new Exception("NO se pudo conectar a la base de datos\n");
            }
        } catch (Exception $e) {
            echo "Error: ".$e->getMessage();
            die(print_r(sqlsrv_errors(), true));
        }
    }
}
?>