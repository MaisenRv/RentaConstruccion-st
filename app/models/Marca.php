<?PHP
namespace Models;
class Marca {
    private $codigoMarca;
    private $nombreMarca;

    public function __construct($nombreMarca, $codigoMarca = null) {
        $this->codigoMarca = $codigoMarca;
        $this->nombreMarca = $nombreMarca;
    }

    public function getCodigoMarca() {
        return $this->codigoMarca;
    }

    public function setCodigoMarca($codigoMarca) {
        $this->codigoMarca = $codigoMarca;
    }

    public function getNombreMarca() {
        return $this->nombreMarca;
    }

    public function setNombreMarca($nombreMarca) {
        $this->nombreMarca = $nombreMarca;
    }
}
