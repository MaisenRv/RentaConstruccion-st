<?PHP
namespace Models;
class Stock {
    private $codigoStock;
    private $codigoProveedor;
    private $codigoProducto;
    private $fecha;
    private $tipoMovimiento;
    private $cantidadMovimiento;
    private $cantidadAcumulada;
    private $estado;

    public function __construct($codigoProveedor, $codigoProducto, $fecha, $tipoMovimiento, $cantidadMovimiento, $cantidadAcumulada, $estado, $codigoStock = null) {
        $this->codigoStock = $codigoStock;
        $this->codigoProveedor = $codigoProveedor;
        $this->codigoProducto = $codigoProducto;
        $this->fecha = $fecha;
        $this->tipoMovimiento = $tipoMovimiento;
        $this->cantidadMovimiento = $cantidadMovimiento;
        $this->cantidadAcumulada = $cantidadAcumulada;
        $this->estado = $estado;
    }

    public function getCodigoStock() {
        return $this->codigoStock;
    }

    public function setCodigoStock($codigoStock) {
        $this->codigoStock = $codigoStock;
    }

    public function getCodigoProveedor() {
        return $this->codigoProveedor;
    }

    public function setCodigoProveedor($codigoProveedor) {
        $this->codigoProveedor = $codigoProveedor;
    }

    public function getCodigoProducto() {
        return $this->codigoProducto;
    }

    public function setCodigoProducto($codigoProducto) {
        $this->codigoProducto = $codigoProducto;
    }

    public function getFecha() {
        return $this->fecha;
    }

    public function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    public function getTipoMovimiento() {
        return $this->tipoMovimiento;
    }

    public function setTipoMovimiento($tipoMovimiento) {
        $this->tipoMovimiento = $tipoMovimiento;
    }

    public function getCantidadMovimiento() {
        return $this->cantidadMovimiento;
    }

    public function setCantidadMovimiento($cantidadMovimiento) {
        $this->cantidadMovimiento = $cantidadMovimiento;
    }

    public function getCantidadAcumulada() {
        return $this->cantidadAcumulada;
    }

    public function setCantidadAcumulada($cantidadAcumulada) {
        $this->cantidadAcumulada = $cantidadAcumulada;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }
}
