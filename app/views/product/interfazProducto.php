<?PHP

use Models\Producto;

if(!isset($_SESSION['ListaPedido'])){
  $_SESSION['ListaPedido'] = [];
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
  $productoPedido= new Producto(
    $_POST['NombreProducto'],
    $_POST['EstadoProducto'],
    $_POST['PrecioRenta'],
    $_POST['CodigoMarca'],
    $_POST['IdCategoria'],
    $_POST['urlImg'],
    $_POST['codigoProducto']
  );

  $cantidad = $_POST['cantidad'];

  if(isset($_SESSION['ListaPedido'][$productoPedido->getCodigoProducto()])){
    $_SESSION['ListaPedido'][$productoPedido->getCodigoProducto()][0] = $_SESSION['ListaPedido'][$productoPedido->getCodigoProducto()][0] + $cantidad;
  }else{
    $_SESSION['ListaPedido'][$productoPedido->getCodigoProducto()] = [$cantidad,$productoPedido];
  }
}

?>
<div class="container">

  <div class="product-image">
    <img src="<?PHP echo is_null($producto->getUrlImg())? 'assets/img/product_empty.png':$producto->getUrlImg(); ?>" alt="Producto">
  </div>


  <div class="product-details">
    <h1><?PHP echo $producto->getNombreProducto();?></h1>
    <p><strong>Marca:</strong><?PHP echo $producto->getMarca()->getNombreMarca();?></p>
    <p><strong>Estado:</strong><?PHP echo $producto->getEstadoProducto();?></p>
    <!-- <p><strong>Descripción:</strong> Compresor portátil de 20 litros con diseño ergonómico, ideal para trabajos profesionales o domésticos.</p> -->
    <!-- <p class="price">$738.900 <span class="discount">-40%</span></p> -->
    <p class="price"><?PHP echo $producto->getPrecioDeRenta();?> COP</p>
    <!-- <p>Ahorra: $483.000</p> -->
    <form method="post">
      <div class="quantity-controls">
        <button type="button" onclick="updateQuantity('decrease')">-</button>
        <input name="cantidad" type="text" id="quantity" value="1" readonly>
        <button type="button" onclick="updateQuantity('increase')">+</button>
      </div>
      <input type="hidden" name="codigoProducto" value="<?PHP echo $producto->getCodigoProducto();?>">
      <input type="hidden" name="NombreProducto" value="<?PHP echo $producto->getNombreProducto();?>">
      <input type="hidden" name="EstadoProducto" value="<?PHP echo $producto->getEstadoProducto();?>">
      <input type="hidden" name="PrecioRenta" value="<?PHP echo $producto->getPrecioDeRenta();?>">
      <input type="hidden" name="CodigoMarca" value="<?PHP echo $producto->getCodigoMarca();?>">
      <input type="hidden" name="IdCategoria" value="<?PHP echo $producto->getIdCategoria();?>">
      <input type="hidden" name="urlImg" value="<?PHP echo $producto->getUrlImg();?>">

      <button type="submit" class="add-to-cart" onclick="addToCart()">Agregar al carrito</button>
    </form>
  </div>
</div>

<script>
  let quantity = 1;

  function updateQuantity(action) {
    if (action === 'increase') {
      quantity++;
    } else if (action === 'decrease' && quantity > 1) {
      quantity--;
    }
    document.getElementById("quantity").value = quantity;
  }

  function addToCart() {
    alert("Producto agregado al carrito con " + quantity + " unidades.");
  }
</script>