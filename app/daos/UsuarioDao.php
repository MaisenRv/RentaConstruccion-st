<?PHP 
namespace DAOS;
use Core\BaseDao;
use Models\Usuario;

class UsuarioDao extends BaseDao {
    public function __construct() {
        parent::__construct();
    }

    public function getAll() {
        $this->prepareQuery('SELECT * FROM Usuario');
        $result = $this->execute();
        if (!is_null($result)) {
            $usuarios = [];
            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                $usuario = new Usuario(
                    $row['Contraseña'], 
                    $row['RazonSocial'], 
                    $row['CodigoLocalidad'], 
                    $row['Correo'], 
                    $row['CodigoRol'], 
                    $row['Direccion'], 
                    $row['Telefono'], 
                    $row['CodigoUsuario']
                );
                $usuarios[] = $usuario;
            }
            return $usuarios;
        }
    }

    public function loginCheck(Usuario $usuario) {
        $params = [$usuario->getCorreo(),$usuario->getContraseña()];
        $this->prepareQuery('SELECT * FROM Usuario WHERE Correo = ? AND Contraseña = ?',$params);
        $result = $this->execute();

        if (is_null($result)){ return null; }
        
        if ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { 
            return new Usuario(
                $row['Contraseña'], 
                $row['RazonSocial'], 
                $row['CodigoLocalidad'], 
                $row['Direccion'], 
                $row['Correo'], 
                $row['Telefono'], 
                $row['CodigoRol'], 
                $row['CodigoUsuario']
            );
        }else{
            return null;
        }
        
    }
}
