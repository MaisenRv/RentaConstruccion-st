<?PHP
namespace Models;
class Promocion {
    private $codigoPromocion;
    private $descripcion;
    private $porcentajeDescuento;

    public function __construct($descripcion, $porcentajeDescuento, $codigoPromocion = null) {
        $this->codigoPromocion = $codigoPromocion;
        $this->descripcion = $descripcion;
        $this->porcentajeDescuento = $porcentajeDescuento;
    }

    public function getCodigoPromocion() {
        return $this->codigoPromocion;
    }

    public function setCodigoPromocion($codigoPromocion) {
        $this->codigoPromocion = $codigoPromocion;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    public function getPorcentajeDescuento() {
        return $this->porcentajeDescuento;
    }

    public function setPorcentajeDescuento($porcentajeDescuento) {
        $this->porcentajeDescuento = $porcentajeDescuento;
    }
}
