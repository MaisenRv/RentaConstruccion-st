<?PHP
namespace Models;
class ReseñaProducto {
    private $codigoReseña;
    private $codigoCliente;
    private $codigoProveedor;
    private $codigoProducto;
    private $calificacion;
    private $comentario;
    private $fecha;

    public function __construct($codigoCliente, $codigoProveedor, $codigoProducto, $calificacion, $fecha, $comentario, $codigoReseña = null) {
        $this->codigoReseña = $codigoReseña;
        $this->codigoCliente = $codigoCliente;
        $this->codigoProveedor = $codigoProveedor;
        $this->codigoProducto = $codigoProducto;
        $this->calificacion = $calificacion;
        $this->comentario = $comentario;
        $this->fecha = $fecha;
    }

    public function getCodigoReseña() {
        return $this->codigoReseña;
    }

    public function setCodigoReseña($codigoReseña) {
        $this->codigoReseña = $codigoReseña;
    }

    public function getCodigoCliente() {
        return $this->codigoCliente;
    }

    public function setCodigoCliente($codigoCliente) {
        $this->codigoCliente = $codigoCliente;
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

    public function getFecha() {
        return $this->fecha;
    }

    public function setFecha($fecha) {
        $this->fecha = $fecha;
    }
}
