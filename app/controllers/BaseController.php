<?PHP

class BaseController{
    protected function loadView($viewPath, $data = []){
        extract($data);
        $view = __DIR__."/../views/{$viewPath}.php";
        require __DIR__.'/../views/layouts/main.php';
    }
    protected function index(){
        $this->loadView('login',['title'=> 'Login']);
    }
    // public function admin(){
    //     $this->loadView('admin/admin',['title'=> 'admin','showAdmin'=>false]);
    // }
}

?>