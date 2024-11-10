<?PHP
namespace Models;
class Usuario {
    private $codigoUsuario;
    private $contraseña;
    private $razonSocial;
    private $codigoLocalidad;
    private $direccion;
    private $correo;
    private $telefono;
    private $codigoRol;

    public function __construct($contraseña, $razonSocial, $codigoLocalidad, $correo, $codigoRol, $direccion, $telefono, $codigoUsuario = null) {
        $this->codigoUsuario = $codigoUsuario;
        $this->contraseña = $contraseña;
        $this->razonSocial = $razonSocial;
        $this->codigoLocalidad = $codigoLocalidad;
        $this->direccion = $direccion;
        $this->correo = $correo;
        $this->telefono = $telefono;
        $this->codigoRol = $codigoRol;
    }

    public function getCodigoUsuario() {
        return $this->codigoUsuario;
    }

    public function setCodigoUsuario($codigoUsuario) {
        $this->codigoUsuario = $codigoUsuario;
    }

    public function getContraseña() {
        return $this->contraseña;
    }

    public function setContraseña($contraseña) {
        $this->contraseña = $contraseña;
    }

    public function getRazonSocial() {
        return $this->razonSocial;
    }

    public function setRazonSocial($razonSocial) {
        $this->razonSocial = $razonSocial;
    }

    public function getCodigoLocalidad() {
        return $this->codigoLocalidad;
    }

    public function setCodigoLocalidad($codigoLocalidad) {
        $this->codigoLocalidad = $codigoLocalidad;
    }

    public function getDireccion() {
        return $this->direccion;
    }

    public function setDireccion($direccion) {
        $this->direccion = $direccion;
    }

    public function getCorreo() {
        return $this->correo;
    }

    public function setCorreo($correo) {
        $this->correo = $correo;
    }

    public function getTelefono() {
        return $this->telefono;
    }

    public function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    public function getCodigoRol() {
        return $this->codigoRol;
    }

    public function setCodigoRol($codigoRol) {
        $this->codigoRol = $codigoRol;
    }
}
