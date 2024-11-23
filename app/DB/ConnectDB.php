<?php

namespace DB;

use Exception;

class ConnectDB{
    // Connection data
    private const SERVER_NAME = "localhost";
    private const CONNECT_OPTIONS_PROVEEDOR = [
        "Database" => "RentaConstruccionDB",
        "UID" => "AppRentaConstruccion",
        "PWD" => "1234",
        "CharacterSet" => "UTF-8" 
    ];
    private const CONNECT_OPTIONS_CLIENTE = [
        "Database" => "RentaConstruccionDB",
        "UID" => "Login2",
        "PWD" => "987654321",
        "CharacterSet" => "UTF-8" 
    ];

    public static function connect_proveedor(){
        try {
            $conn = sqlsrv_connect(ConnectDB::SERVER_NAME, ConnectDB::CONNECT_OPTIONS_PROVEEDOR);
            
            if ($conn) {
                return $conn;
            }else{
                throw new Exception("NO se pudo conectar a la base de datos\n");
            }
        } catch (Exception $e) {
            echo "Error: ".$e->getMessage();
            die(print_r(sqlsrv_errors(), true));
        }
    }
    public static function connect_cliente(){
        try {
            $conn = sqlsrv_connect(ConnectDB::SERVER_NAME, ConnectDB::CONNECT_OPTIONS_CLIENTE);
            if ($conn) {
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