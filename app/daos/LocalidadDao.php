<?PHP 
namespace DAOS;

use Core\BaseDao;
use Models\Localidad;

class LocalidadDao extends BaseDao {
    public function __construct() {
        parent::__construct();
    }

    public function getAll() {
        $this->prepareQuery('SELECT * FROM Localidad');
        $result = $this->execute();
        if (!is_null($result)) {
            $localidades = [];
            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                $localidad = new Localidad($row['NombreLocalidad'], $row['CodigoLocalidad']);
                $localidades[] = $localidad;
            }
            return $localidades;
        }
    }
}

