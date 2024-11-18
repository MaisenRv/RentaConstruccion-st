<?PHP
namespace Core;

use Db\ConnectDB;
use Exception;

class BaseDao{
    protected $conn;
    private $stm;

    public function __construct() {
        $this->conn = ConnectDB::connect();
        $this->stm = null;
    }
    protected function prepareQuery(string $sql, ?Array $params = null){
        $this->stm = sqlsrv_prepare($this->conn,$sql,$params);
        if ($this->stm === false) {
            throw new Exception("Error al preparar la consulta: " . print_r(sqlsrv_errors(), true));
        }
    }

    protected function execute(){
        if(is_null($this->stm)){
            throw new Exception("Statement no preparado. Llama a prepareQuery primero.");
        }

        if (!sqlsrv_execute($this->stm)) {
            throw new Exception("Error al ejecutar la consulta: " . print_r(sqlsrv_errors(), true));
        }
        $stm_res = $this->stm;
        $this->stm = null;
        return $stm_res;
    }

    protected function fetchAll($statement = null){
        if(is_null($statement)) { return null;}

        $results = [];
        while($row = sqlsrv_fetch_array($statement, SQLSRV_FETCH_ASSOC)){
            $results[] = $row;
        }
        return $results;
    }
    protected function getTriggerMessages($statement){
        $messages = [];
        while (sqlsrv_next_result($statement)) {
            if (($errors = sqlsrv_errors(SQLSRV_ERR_ERRORS)) !== null) {
                foreach ($errors as $error) {
                    $messages[] = $error['message'];
                }
            }
        }
        return $messages;
    }
}


?>