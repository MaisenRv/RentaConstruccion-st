<?PHP 
namespace Controllers;

use DAOS\MarcaDao;
use Core\BaseController;

class MarcaC extends BaseController{
    public function __construct() {
        parent::__construct(new MarcaDao());
    }
}


?>