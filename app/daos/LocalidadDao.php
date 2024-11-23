<?PHP 
namespace DAOS;

use Core\BaseDao;
use Models\Localidad;

class LocalidadDao extends BaseDao {
    public function __construct() {
        parent::__construct();
    }

    public function getAll($userType) {
        $this->setUserType($userType);
        $this->prepareQuery('SELECT * FROM Localidad');
        $result = $this->execute();
        if (!is_null($result)) {
            $localidades = [];
            foreach($this->fetchAll($result) as $row) {
                $localidad = new Localidad($row['NombreLocalidad'], $row['CodigoLocalidad']);
                $localidades[] = $localidad;
            }
            return $localidades;
        }
    }
}

