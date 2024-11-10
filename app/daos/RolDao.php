<?PHP 

namespace DAOS;

use Core\BaseDao;
use Models\Rol;

class RolDao extends BaseDao{
    public function __construct() {
        parent::__construct();
    }

    public function getAll(){
        $this->prepareQuery('select * from Rol');
        $result = $this->execute();
        if(!is_null($result)){
            $roles = [];
            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                $rol = new Rol($row['Rol'],$row['CodigoRol']);
                $roles[] = $rol;
            }
            return $roles;
        }
    }

}



?>