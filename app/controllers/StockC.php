<?PHP 
namespace Controllers;

use DAOS\StockDao;
use Core\BaseController;

class StockC extends BaseController{
    public function __construct() {
        parent::__construct(new StockDao());
    }
    public function getByUser($id,$userType){
        return $this->dao->getByUser($id,$userType);
    }
}


?>