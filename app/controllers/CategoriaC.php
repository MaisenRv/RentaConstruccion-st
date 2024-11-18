<?PHP 
namespace Controllers;

use DAOS\CategoriaDao;
use Core\BaseController;

class CategoriaC extends BaseController{
    public function __construct() {
        parent::__construct(new CategoriaDao());
    }
}
?>