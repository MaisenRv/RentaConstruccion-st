<div class="controls">
        <?PHP
        use Controllers\UsuarioC;
        if ($rolUsuario == UsuarioC::CODIGO_ROL_PROVEEDOR) { ?>
                <a class="btn-addProduct" href="index.php?action=crear_producto_view">Agregar producto</a>
        <?PHP } ?>
</div>

<div class="continer-products">
        <?PHP if ($productos != null) {?>
              
        
        <?PHP foreach ($productos as $p) { ?>
                <div class="product-detail">
                        <?PHP if ($rolUsuario != UsuarioC::CODIGO_ROL_PROVEEDOR) {
                                echo '<a href="index.php?action=product&id='.$p->getCodigoProducto().'" class="product-detail-a">';
                        }?>

                        <img src="<?PHP echo is_null($p->getUrlImg()) ? 'assets/img/product_empty.png' : $p->getUrlImg(); ?>" alt="<?PHP echo $p->getNombreProducto(); ?>">
                        <h2><?PHP echo $p->getNombreProducto(); ?></h2>
                        <p><strong>Precio de Renta:</strong> $<?PHP echo $p->getPrecioDeRenta(); ?> COP</p>
                        <p><strong>Estado:</strong> <?PHP echo $p->getEstadoProducto(); ?> </p>
                        <p><strong>Marca:</strong> <?PHP echo $p->getMarca()->getNombreMarca(); ?></p>
                        
                        <?PHP if ($rolUsuario != UsuarioC::CODIGO_ROL_PROVEEDOR) { 
                                echo '</a>';
                        }?>
                </div>
        <?PHP } ?>
        <?PHP } else {?>
                <h2>No existen productos para esta categoria</h2>
        <?PHP } ?>
</div>