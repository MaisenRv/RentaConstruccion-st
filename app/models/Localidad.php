<?PHP
namespace Models;

class Localidad {
    private $codigoLocalidad;
    private $nombreLocalidad;

    public function __construct($nombreLocalidad,$codigoLocalidad = null) {
        $this->codigoLocalidad = $codigoLocalidad;
        $this->nombreLocalidad = $nombreLocalidad;
    }

    public function getCodigoLocalidad() {
        return $this->codigoLocalidad;
    }

    public function setCodigoLocalidad($codigoLocalidad) {
        $this->codigoLocalidad = $codigoLocalidad;
    }

    public function getNombreLocalidad() {
        return $this->nombreLocalidad;
    }

    public function setNombreLocalidad($nombreLocalidad) {
        $this->nombreLocalidad = $nombreLocalidad;
    }
}

?>