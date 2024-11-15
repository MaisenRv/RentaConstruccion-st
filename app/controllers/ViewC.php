<?PHP 
namespace Controllers;

use Core\BaseController;

class ViewC extends BaseController{

    public function load_login($roles, $localidades){
        $this->loadView('login', [
            'title' => 'Login',
            'roles' => $roles,
            'localidades' => $localidades
        ]);
    }
    public function load_home(){
        $this->loadView('home',[
            'title' => 'Home'
        ]);
    }
}
?>