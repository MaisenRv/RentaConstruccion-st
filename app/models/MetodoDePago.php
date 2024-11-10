<?PHP
namespace Models;
class MetodoDePago {
    private $codigoMetodoDePago;
    private $metodoDePago;

    public function __construct($metodoDePago, $codigoMetodoDePago = null) {
        $this->codigoMetodoDePago = $codigoMetodoDePago;
        $this->metodoDePago = $metodoDePago;
    }

    public function getCodigoMetodoDePago() {
        return $this->codigoMetodoDePago;
    }

    public function setCodigoMetodoDePago($codigoMetodoDePago) {
        $this->codigoMetodoDePago = $codigoMetodoDePago;
    }

    public function getMetodoDePago() {
        return $this->metodoDePago;
    }

    public function setMetodoDePago($metodoDePago) {
        $this->metodoDePago = $metodoDePago;
    }
}
