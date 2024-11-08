<?PHP
require_once __DIR__."/../BaseController.php";
class UserC extends BaseController{
    public function login() {
        $this->index();
    }
    public static function blockSession(){
        header("Location: index.php");
        exit();
    }
}

?>