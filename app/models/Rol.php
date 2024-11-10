<?php
namespace Models;

class Rol
{
    private $codigoRol;
    private $rol;
    
    public function __construct($rol, $codigoRol = null){
        $this->codigoRol = $codigoRol;
        $this->rol = $rol;
    }

    public function getCodigoRol() {
        return $this->codigoRol;
    }

    public function setCodigoRol($codigoRol) {
        $this->codigoRol = $codigoRol;
    }

    public function getRol() {
        return $this->rol;
    }

    public function setRol($rol) {
        $this->rol = $rol;
    }
}
?>
