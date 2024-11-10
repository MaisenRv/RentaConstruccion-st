<?PHP 
namespace Controllers;

use DAOS\LocalidadDao;
use Core\BaseController;

class LocalidadC extends BaseController{
    public function __construct() {
        parent::__construct(new LocalidadDao());
    }
}


?>