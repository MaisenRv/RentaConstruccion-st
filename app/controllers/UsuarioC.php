<?PHP

namespace Controllers;

use Core\BaseController;
use DAOS\UsuarioDao;
use Models\Usuario;

class UsuarioC extends BaseController
{
    public const CODIGO_ROL_PROVEEDOR = 10; 
    public function __construct(){
        parent::__construct(new UsuarioDao);
    }
    public static function blockSession(){    
        echo "<script>
                window.location.href = 'index.php';
            </script>";
        exit();
    }

    public static function logout(){
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        session_unset();
        session_destroy();
        UsuarioC::blockSession();
    }

    public static function checkSession(){
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if(!isset($_SESSION['contraseña']) || !isset($_SESSION['correo'])){
            UsuarioC::blockSession();
            return false;
        }
        return true;
    
    }
    
    public function login(){
        $usuario = new Usuario($_POST['password'],null,null,$_POST['email'],null,null,null);
        $result = $this->dao->loginCheck($usuario);
        if(!is_null($result)){
            session_start();
            $_SESSION['correo'] = $result->getCorreo();
            $_SESSION['codigoUsuario'] = $result->getCodigoUsuario();
            $_SESSION['contraseña'] = $result->getContraseña();
            $_SESSION['razonSocial'] = $result->getRazonSocial();
            $_SESSION['codigoLocalidad'] = $result->getCodigoLocalidad();
            $_SESSION['direccion'] = $result->getDireccion();
            $_SESSION['telefono'] = $result->getTelefono();
            $_SESSION['codigoRol'] = $result->getCodigoRol();
            
            header('Location: index.php?action=home');
            exit();
        }else{
            echo "<script type='text/javascript'>
            alert('El usuario o la contraseña no son correctos');
            </script>";
            UsuarioC::blockSession();
        }
    }
    public function register(){
        $newUsuario = new Usuario(
            $_POST['contrasena'],
            $_POST['razonSocial'],
            $_POST['localidad'],
            $_POST['email'],
            $_POST['rol'],
            $_POST['direccion'],
            $_POST['telefono']
        );
        $this->create($newUsuario);
    }

}
