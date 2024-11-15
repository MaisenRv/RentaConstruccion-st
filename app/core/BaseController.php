<?PHP
namespace Core;

class BaseController{
    protected $dao;

    public function __construct($dao = null) {
        $this->dao = $dao;
    }

    protected function loadView($viewPath, $data = []){
        extract($data);
        $view = __DIR__."/../views/{$viewPath}.php";
        require __DIR__.'/../views/layouts/main.php';
    }

    // Dao methods
    public function getAll(){
        if (!is_null($this->dao)) {
            return $this->dao->getAll();
        }
    }
}

?>