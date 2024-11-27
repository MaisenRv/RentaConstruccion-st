<?PHP
$total = 0;
if (isset($_GET['eliminar'])) {
  $codigoProducto = $_GET['eliminar'];
  foreach ($_SESSION['ListaPedido'] as $key => $value) {
    if ($value[1]->getCodigoProducto() == $codigoProducto) {
      unset($_SESSION['ListaPedido'][$key]); 
      break;
    }
  }
  $_SESSION['ListaPedido'] = array_values($_SESSION['ListaPedido']);
  header("Location: index.php?action=pedido");
  exit;
}
?>


<div class="historial-container">
  <?PHP if (!isset($_SESSION['ListaPedido']) || empty($_SESSION['ListaPedido'])) { ?>
    El pedido esta vacio
  <?PHP } else { ?>
    <div class="historial-header">Pedido</div>
    <table>
      <thead>
        <tr>
          <th>Codigo Producto</th>
          <th>Producto</th>
          <th>Cantidad</th>
          <th>Precio de renta</th>
          <th>Total</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?PHP foreach ($_SESSION['ListaPedido'] as $key => $value) {  $total+= $value[1]->getPrecioDeRenta() * $value[0]?>
          <tr>
            <td><?PHP echo $value[1]->getCodigoProducto(); ?></td>
            <td><?PHP echo $value[1]->getNombreProducto(); ?></td>
            <td><?PHP echo $value[0]; ?></td>
            <td><?PHP echo $value[1]->getPrecioDeRenta(); ?></td>
            <td><?PHP echo $value[1]->getPrecioDeRenta() * $value[0]; ?></td>
            <td><a href="index.php?action=pedido&eliminar=<?php echo $value[1]->getCodigoProducto(); ?>" class="add-to-cart deleteProduct">Eliminar</a></td>
          </tr>
        <?PHP } ?>
      </tbody>
      <tfoot>
        <tr>
          <td colspan="4">TOTAL</td>
          <td><?PHP echo $total; ?> COP</td>
          <td></td>
        </tr>
      </tfoot>
    </table>
    <form action="index.php?action=hacer_pedido" method="post">
      <button type="submit" class="btn-addProduct order-btn">Realizar pedido</button>
    </form>
  <?PHP } ?>
</div>