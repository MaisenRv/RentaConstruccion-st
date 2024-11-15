<?PHP
namespace Core;

use Db\ConnectDB;


class BaseDao{
    protected $conn;

    private $stm;

    public function __construct() {
        $this->conn = ConnectDB::connect();
        $this->stm = null;
    }
    protected function prepareQuery(string $sql, ?Array $params = null){
        if(!is_null($params)){
            $this->stm = sqlsrv_prepare($this->conn,$sql,$params);
            return;
        }
        $this->stm = sqlsrv_prepare($this->conn,$sql);
    }

    protected function execute(){
        if(is_null($this->stm)){
            return null;
        }
        if (sqlsrv_execute($this->stm)) {
            $stm_res = $this->stm;
            $this->stm = null;
            return $stm_res;
        }else{
            die(print_r(sqlsrv_errors(), true));
            return null;
        }
    }


}


?>