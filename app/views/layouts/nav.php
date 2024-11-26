<?PHP
use Controllers\UsuarioC;

$usuario = new UsuarioC();
$userType = $usuario->getUserType();
?>

<nav>
    <a href="index.php?action=productos">Productos</a>
    <a href="index.php?action=categorias">Categorias</a>
    <?PHP if($userType == 'Proveedor'){?>
        <a href="index.php?action=stock">Stock</a>
    <?PHP } ?>
    <?PHP if($userType == 'Cliente'){?>
        <a href="index.php?action=historialcliente">Historial pedidos</a> 
        <a href="index.php?action=pedido">Pedido</a>
    <?PHP } ?>
    <a href="index.php?action=logout">Cerrar Sesión</a>

</nav>