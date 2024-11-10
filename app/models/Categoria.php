<?PHP
namespace Models;
class Categoria {
    private $idCategoria;
    private $categoria;

    public function __construct($categoria, $idCategoria = null) {
        $this->idCategoria = $idCategoria;
        $this->categoria = $categoria;
    }

    public function getIdCategoria() {
        return $this->idCategoria;
    }

    public function setIdCategoria($idCategoria) {
        $this->idCategoria = $idCategoria;
    }

    public function getCategoria() {
        return $this->categoria;
    }

    public function setCategoria($categoria) {
        $this->categoria = $categoria;
    }
}
