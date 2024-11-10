<?PHP
namespace Models;
class EvaluacionProveedor {
    private $codigoProveedor;
    private $codigoCliente;
    private $calificacion;
    private $comentario;
    private $fechaEvaluacion;

    public function __construct($codigoProveedor, $codigoCliente, $calificacion, $fechaEvaluacion, $comentario) {
        $this->codigoProveedor = $codigoProveedor;
        $this->codigoCliente = $codigoCliente;
        $this->calificacion = $calificacion;
        $this->comentario = $comentario;
        $this->fechaEvaluacion = $fechaEvaluacion;
    }

    public function getCodigoProveedor() {
        return $this->codigoProveedor;
    }

    public function setCodigoProveedor($codigoProveedor) {
        $this->codigoProveedor = $codigoProveedor;
    }

    public function getCodigoCliente() {
        return $this->codigoCliente;
    }

    public function setCodigoCliente($codigoCliente) {
        $this->codigoCliente = $codigoCliente;
    }

    public function getCalificacion() {
        return $this->calificacion;
    }

    public function setCalificacion($calificacion) {
        $this->calificacion = $calificacion;
    }

    public function getComentario() {
        return $this->comentario;
    }

    public function setComentario($comentario) {
        $this->comentario = $comentario;
    }

    public function getFechaEvaluacion() {
        return $this->fechaEvaluacion;
    }

    public function setFechaEvaluacion($fechaEvaluacion) {
        $this->fechaEvaluacion = $fechaEvaluacion;
    }
}
