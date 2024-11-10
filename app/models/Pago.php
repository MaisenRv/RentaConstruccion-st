<?PHP
namespace Models;
class Pago {
    private $codigoPago;
    private $codigoPedido;
    private $codigoMetodoDePago;
    private $monto;
    private $fechaPago;
    private $estado;

    public function __construct($codigoPedido, $codigoMetodoDePago, $monto, $fechaPago, $estado, $codigoPago = null) {
        $this->codigoPago = $codigoPago;
        $this->codigoPedido = $codigoPedido;
        $this->codigoMetodoDePago = $codigoMetodoDePago;
        $this->monto = $monto;
        $this->fechaPago = $fechaPago;
        $this->estado = $estado;
    }

    public function getCodigoPago() {
        return $this->codigoPago;
    }

    public function setCodigoPago($codigoPago) {
        $this->codigoPago = $codigoPago;
    }

    public function getCodigoPedido() {
        return $this->codigoPedido;
    }

    public function setCodigoPedido($codigoPedido) {
        $this->codigoPedido = $codigoPedido;
    }

    public function getCodigoMetodoDePago() {
        return $this->codigoMetodoDePago;
    }

    public function setCodigoMetodoDePago($codigoMetodoDePago) {
        $this->codigoMetodoDePago = $codigoMetodoDePago;
    }

    public function getMonto() {
        return $this->monto;
    }

    public function setMonto($monto) {
        $this->monto = $monto;
    }

    public function getFechaPago() {
        return $this->fechaPago;
    }

    public function setFechaPago($fechaPago) {
        $this->fechaPago = $fechaPago;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }
}
