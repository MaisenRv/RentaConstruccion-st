<?PHP
namespace Models;
class DetallePedido {
    private $codigoPedido;
    private $codigoProducto;
    private $cantidad;

    public function __construct($codigoPedido, $codigoProducto, $cantidad) {
        $this->codigoPedido = $codigoPedido;
        $this->codigoProducto = $codigoProducto;
        $this->cantidad = $cantidad;
    }

    public function getCodigoPedido() {
        return $this->codigoPedido;
    }

    public function setCodigoPedido($codigoPedido) {
        $this->codigoPedido = $codigoPedido;
    }

    public function getCodigoProducto() {
        return $this->codigoProducto;
    }

    public function setCodigoProducto($codigoProducto) {
        $this->codigoProducto = $codigoProducto;
    }

    public function getCantidad() {
        return $this->cantidad;
    }

    public function setCantidad($cantidad) {
        $this->cantidad = $cantidad;
    }
}
