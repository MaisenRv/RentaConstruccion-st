<?PHP
namespace Controllers;

use Core\BaseController;

// TODO: 
// use DAOS\UserDao;

class UserC extends BaseController{
    public function __construct() {
        // parent::__construct(new UserDao);
    }
    public function login($roles,$localidades = null) {
        $this->loadView('login',['title'=> 'Login', 'roles'=> $roles]);
    }
    public static function blockSession(){
        header("Location: index.php");
        exit();
    }
}

?>