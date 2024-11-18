<?PHP
namespace Models;
class Producto {
    private $codigoProducto;
    private $nombreProducto;
    private $estadoProducto;
    private $precioDeRenta;
    private $codigoMarca;
    private $idCategoria;
    private $urlImg;

    private Marca $marca;

    public function __construct($nombreProducto, $estadoProducto, $precioDeRenta, $codigoMarca, $idCategoria,$urlImg, $codigoProducto = null) {
        $this->codigoProducto = $codigoProducto;
        $this->nombreProducto = $nombreProducto;
        $this->estadoProducto = $estadoProducto;
        $this->precioDeRenta = $precioDeRenta;
        $this->codigoMarca = $codigoMarca;
        $this->idCategoria = $idCategoria;
        $this->urlImg = $urlImg;
    }

    public function getUrlImg(){
        return $this->urlImg;
    }
    public function setUrlImg($urlImg) {
        $this->urlImg = $urlImg;
    }

    public function getCodigoProducto() {
        return $this->codigoProducto;
    }

    public function setCodigoProducto($codigoProducto) {
        $this->codigoProducto = $codigoProducto;
    }

    public function getNombreProducto() {
        return $this->nombreProducto;
    }

    public function setNombreProducto($nombreProducto) {
        $this->nombreProducto = $nombreProducto;
    }

    public function getEstadoProducto() {
        return $this->estadoProducto;
    }

    public function setEstadoProducto($estadoProducto) {
        $this->estadoProducto = $estadoProducto;
    }

    public function getPrecioDeRenta() {
        return $this->precioDeRenta;
    }

    public function setPrecioDeRenta($precioDeRenta) {
        $this->precioDeRenta = $precioDeRenta;
    }

    public function getCodigoMarca() {
        return $this->codigoMarca;
    }

    public function setCodigoMarca($codigoMarca) {
        $this->codigoMarca = $codigoMarca;
    }

    public function getIdCategoria() {
        return $this->idCategoria;
    }

    public function setIdCategoria($idCategoria) {
        $this->idCategoria = $idCategoria;
    }
    public function setMarca(Marca $marca) {
        $this->marca = $marca;
    }
    public function getMarca(){
        if (isset($this->marca)) {
            return $this->marca;
        }
    }
}
