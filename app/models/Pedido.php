<?PHP
namespace Models;
class Pedido {
    private $codigoPedido;
    private $codigoCliente;
    private $codigoProveedor;

    public function __construct($codigoCliente, $codigoProveedor, $codigoPedido = null) {
        $this->codigoPedido = $codigoPedido;
        $this->codigoCliente = $codigoCliente;
        $this->codigoProveedor = $codigoProveedor;
    }

    public function getCodigoPedido() {
        return $this->codigoPedido;
    }

    public function setCodigoPedido($codigoPedido) {
        $this->codigoPedido = $codigoPedido;
    }

    public function getCodigoCliente() {
        return $this->codigoCliente;
    }

    public function setCodigoCliente($codigoCliente) {
        $this->codigoCliente = $codigoCliente;
    }

    public function getCodigoProveedor() {
        return $this->codigoProveedor;
    }

    public function setCodigoProveedor($codigoProveedor) {
        $this->codigoProveedor = $codigoProveedor;
    }
}
