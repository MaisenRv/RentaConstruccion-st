<?PHP 
namespace DAOS;
use Core\BaseDao;
use Exception;
use Models\Categoria;

class CategoriaDao extends BaseDao {
    public function __construct() {
        parent::__construct();
    }

    public function getAll() {
        $this->prepareQuery('SELECT * FROM Categoria');
        $result = $this->execute();
        if (!is_null($result)) {
            $categorias = [];
            foreach ($this->fetchAll($result) as $row) {
                $categoria = new Categoria($row['Categoria'], $row['IdCategoria']);
                $categorias[] = $categoria;
            }
            return $categorias;
        }
    }

    public function getCategorysByUser($codigoUsuario){
        try {
            $params = [$codigoUsuario];
            $this->prepareQuery('EXEC S_Categoria ?',$params);
            $result = $this->execute();
            if (!is_null($result)) {
                $categorias = [];
                foreach ($this->fetchAll($result) as $row) {
                    $categoria = new Categoria($row['Categoria'], $row['IdCategoria']);
                    $categorias[] = $categoria;
                }
                return $categorias;
            }
        } catch (Exception $e) {
            $this->showMessages();
        }
    }

    // public function getById($id) {
    //     $this->prepareQuery('SELECT * FROM Categoria WHERE IdCategoria = ?');
    //     $this->bindParam(1, $id);
    //     $result = $this->execute();
    //     if (!is_null($result)) {
    //         $row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);
    //         return new Categoria($row['Categoria'], $row['IdCategoria']);
    //     }
    // }
}
