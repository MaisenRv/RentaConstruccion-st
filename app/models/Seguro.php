<?PHP
namespace Models;
class Seguro {
    private $codigoSeguro;
    private $cobertura;
    private $fechaCaducidad;
    private $costo;
    private $codigoPedido;

    public function __construct($cobertura, $fechaCaducidad, $costo, $codigoPedido, $codigoSeguro = null) {
        $this->codigoSeguro = $codigoSeguro;
        $this->cobertura = $cobertura;
        $this->fechaCaducidad = $fechaCaducidad;
        $this->costo = $costo;
        $this->codigoPedido = $codigoPedido;
    }

    public function getCodigoSeguro() {
        return $this->codigoSeguro;
    }

    public function setCodigoSeguro($codigoSeguro) {
        $this->codigoSeguro = $codigoSeguro;
    }

    public function getCobertura() {
        return $this->cobertura;
    }

    public function setCobertura($cobertura) {
        $this->cobertura = $cobertura;
    }

    public function getFechaCaducidad() {
        return $this->fechaCaducidad;
    }

    public function setFechaCaducidad($fechaCaducidad) {
        $this->fechaCaducidad = $fechaCaducidad;
    }

    public function getCosto() {
        return $this->costo;
    }

    public function setCosto($costo) {
        $this->costo = $costo;
    }

    public function getCodigoPedido() {
        return $this->codigoPedido;
    }

    public function setCodigoPedido($codigoPedido) {
        $this->codigoPedido = $codigoPedido;
    }
}
