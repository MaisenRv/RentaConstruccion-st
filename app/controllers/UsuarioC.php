<?PHP

namespace Controllers;

use Core\BaseController;
use DAOS\UsuarioDao;

class UsuarioC extends BaseController
{
    public function __construct()
    {
        parent::__construct(new UsuarioDao);
    }
    public function login($roles, $localidades = null)
    {
        $this->loadView('login', [
            'title' => 'Login',
            'roles' => $roles,
            'localidades' => $localidades
        ]);
    }
    public static function blockSession()
    {
        header("Location: index.php");
        exit();
    }
}
