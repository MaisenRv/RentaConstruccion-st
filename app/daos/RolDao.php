<?PHP 

namespace DAOS;

use Core\BaseDao;
use Models\Rol;

class RolDao extends BaseDao{
    public function __construct() {
        parent::__construct();
    }

    public function getAll(){
        $this->prepareQuery("SELECT * FROM Rol WHERE CodigoRol <> 0 AND Rol <> 'Administrador'");
        $result = $this->execute();
        if(!is_null($result)){
            $roles = [];
            foreach($this->fetchAll($result) as $row) {
                $rol = new Rol($row['Rol'],$row['CodigoRol']);
                $roles[] = $rol;
            }
            return $roles;
        }
    }

}



?>