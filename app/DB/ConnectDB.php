<?php

namespace DB;

use Exception;

class ConnectDB{
    // Connection data
    private const SERVER_NAME = "localhost";
    private const CONNECT_OPTIONS = [
        "Database" => "RentaConstruccionDB",
        "UID" => "AppRentaConstruccion",
        "PWD" => "1234",
        "CharacterSet" => "UTF-8" 
    ];

    public static function connect(){
        try {
            $conn = sqlsrv_connect(ConnectDB::SERVER_NAME, ConnectDB::CONNECT_OPTIONS);
            
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


//  ejemplo de consulta

// Definir la consulta SQL
// $sql = "SELECT * FROM usuario";

// $conn = ConnectDB::connect();
// // Ejecutar la consulta
// $stmt = sqlsrv_query($conn, $sql);

// // Verificar si la consulta fue exitosa
// if ($stmt === false) {
//     die(print_r(sqlsrv_errors(), true));
// }

// // Procesar los resultados
// while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
//     echo "ID: " . $row['Correo'] . "<br />";
// }

// // Liberar los recursos y cerrar la conexión
// sqlsrv_free_stmt($stmt);
// sqlsrv_close($conn);

?>