<?PHP
namespace Models;
class HistorialPedido {
    private $codigoHistorialPedido;
    private $codigoPedido;
    private $fechaInicio;
    private $fechaFin;
    private $estado;
    private $observaciones;

    public function __construct($codigoPedido, $fechaInicio, $fechaFin, $estado, $observaciones, $codigoHistorialPedido = null) {
        $this->codigoHistorialPedido = $codigoHistorialPedido;
        $this->codigoPedido = $codigoPedido;
        $this->fechaInicio = $fechaInicio;
        $this->fechaFin = $fechaFin;
        $this->estado = $estado;
        $this->observaciones = $observaciones;
    }

    public function getCodigoHistorialPedido() {
        return $this->codigoHistorialPedido;
    }

    public function setCodigoHistorialPedido($codigoHistorialPedido) {
        $this->codigoHistorialPedido = $codigoHistorialPedido;
    }

    public function getCodigoPedido() {
        return $this->codigoPedido;
    }

    public function setCodigoPedido($codigoPedido) {
        $this->codigoPedido = $codigoPedido;
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

    public function getEstado() {
        return $this->estado;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }

    public function getObservaciones() {
        return $this->observaciones;
    }

    public function setObservaciones($observaciones) {
        $this->observaciones = $observaciones;
    }

}