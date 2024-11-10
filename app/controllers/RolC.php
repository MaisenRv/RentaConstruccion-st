<?PHP 
namespace Controllers;

use DAOS\RolDao;
use Core\BaseController;

class RolC extends BaseController{
    public function __construct() {
        parent::__construct(new RolDao());
    }
}


?>