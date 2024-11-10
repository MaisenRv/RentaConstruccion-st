<?PHP
namespace Models;
class PromocionProducto {
    private $codigoProducto;
    private $codigoPromocion;
    private $fechaInicio;
    private $fechaFin;

    public function __construct($codigoProducto, $codigoPromocion, $fechaInicio, $fechaFin) {
        $this->codigoProducto = $codigoProducto;
        $this->codigoPromocion = $codigoPromocion;
        $this->fechaInicio = $fechaInicio;
        $this->fechaFin = $fechaFin;
    }

    public function getCodigoProducto() {
        return $this->codigoProducto;
    }

    public function setCodigoProducto($codigoProducto) {
        $this->codigoProducto = $codigoProducto;
    }

    public function getCodigoPromocion() {
        return $this->codigoPromocion;
    }

    public function setCodigoPromocion($codigoPromocion) {
        $this->codigoPromocion = $codigoPromocion;
    }

    public function getFechaInicio() {
        return $this->fechaInicio;
    }

    public function setFechaInicio($fechaInicio) {
        $this->fechaInicio = $fechaInicio;
    }

    public function getFechaFin() {
        return $this->fechaFin;
    }

    public function setFechaFin($fechaFin) {
        $this->fechaFin = $fechaFin;
    }
}

