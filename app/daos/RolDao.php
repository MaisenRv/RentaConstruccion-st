<?PHP 

namespace DAOS;

use Core\BaseDao;
use Models\Rol;

class RolDao extends BaseDao{
    public function __construct() {
        parent::__construct();
    }

    public function getAll($userType){
        $this->setUserType($userType);
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
    public function getById($id,$userType):?Rol{
        if ($userType !=null) {
            $this->setUserType($userType);
        }else{
            $this->setUserType('Cliente');
        }
        
        $params = [$id];
        $this->prepareQuery("SELECT * FROM Rol WHERE CodigoRol = ?",$params);
        $result = $this->execute();
        if(is_null($result)){ return null; }
        $rol = null;
        foreach($this->fetchAll($result) as $row) {
            $rol = new Rol($row['Rol'],$row['CodigoRol']);
        }
        return $rol;
    }

}



?>