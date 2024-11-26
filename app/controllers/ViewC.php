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
    public function load_home($razonSocial){
        $this->loadView('home',[
            'title' => 'Home',
            'razonSocial' => $razonSocial
        ]);
    }
    public function load_category($categorias,$codigoUsuario){
        $this->loadView('category',[
            'title' => 'Categorias',
            'categorias' => $categorias,
            'codigoUsuario' => $codigoUsuario
        ]);
    }
    public function load_products($productos,$rolUsuario){
        $this->loadView('product/products',[
            'title' => 'Productos',
            'productos' => $productos,
            'rolUsuario'=> $rolUsuario
        ]);
    }

    public function load_add_products($categorias,$marcas){
        $this->loadView('product/addProduct',[
            'title' => 'Crear Producto',
            'categorias' => $categorias,
            'marcas' => $marcas
        ]);
    }

    public function load_stock($stockList){
        $this->loadView('interfazStock',[
            'title' => 'Stock',
            'stockList' => $stockList
        ]);
    }

    public function load_product($product){
        $this->loadView('product/interfazProducto',[
            'title' => ($product->getNombreProducto()),
            'producto'=>$product
        ]);
    }

    public function load_order_history(){
        $this->loadView('historialcliente',[
            'title' => 'Historial pedidos'
        ]);
    }

    public function load_order(){
        $this->loadView('pedido',[
            'title' => 'Pedido'
        ]);
    }
}
?>