<?PHP

namespace Core;

use Db\ConnectDB;
use Exception;

class BaseDao
{
    protected $conn;
    private $stm;

    public function __construct()
    {
        $this->conn = null;
        $this->stm = null;
    }

    // Dependiendo del tipo de usuario utiliza una conexion u otra
    public function setUserType($userType)
    {
        if ($userType == 'Cliente') {
            $this->conn = ConnectDB::connect_cliente();
        } elseif ($userType == 'Proveedor') {
            $this->conn = ConnectDB::connect_proveedor();
        }
    }

    protected function prepareQuery(string $sql, ?array $params = null)
    {
        if ($this->conn != null) {
            $this->stm = sqlsrv_prepare($this->conn, $sql, $params);
            if ($this->stm === false) {
                throw new Exception("Error al preparar la consulta: " . print_r(sqlsrv_errors(), true));
            }
        }
    }

    protected function execute()
    {
        if (is_null($this->stm)) {
            throw new Exception("Statement no preparado. Llama a prepareQuery primero.");
        }

        if (!sqlsrv_execute($this->stm)) {
            throw new Exception("Error al ejecutar la consulta: " . print_r(sqlsrv_errors(), true));
        }
        $stm_res = $this->stm;
        $this->stm = null;
        return $stm_res;
    }

    protected function fetchAll($statement = null)
    {
        if (is_null($statement)) {
            return null;
        }

        $results = [];
        while ($row = sqlsrv_fetch_array($statement, SQLSRV_FETCH_ASSOC)) {
            $results[] = $row;
        }
        return $results;
    }
    // Me devuelve los mensajes de error
    protected function getMessages()
    {
        $messages = [];
        // $errors = sqlsrv_errors(SQLSRV_ERR_ERRORS);
        // if ($errors !== null) {
        //     foreach ($errors as $error) {
        //         $messages[] = "Error: " . $error['message'];
        //     }
        // }
        // $warnings = sqlsrv_errors(SQLSRV_ERR_WARNINGS); 
        // if ($warnings !== null) {
        //     foreach ($warnings as $warning) {
        //         $messages[] = "Print: " . $warning['message'];
        //     }
        // }

        $errors = sqlsrv_errors(); // No es necesario pasar los parámetros SQLSRV_ERR_ERRORS y SQLSRV_ERR_WARNINGS.

        // Si hay errores, los añadimos a la lista de mensajes.
        if ($errors !== null) {
            foreach ($errors as $error) {
                $messages[] = "Error: " . $error['message'];
            }
        }

        return $messages;
    }

    protected function showMessages()
    {
        $messages = $this->getMessages();
        foreach ($messages as $r) {
            echo '<script>alert("' . substr($r, 61) . '");</script>';
            // echo '<script>alert("'.$r.'");</script>';
        }
    }
}
