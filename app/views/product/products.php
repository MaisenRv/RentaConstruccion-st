<div class="controls">
        <?PHP if ($rolUsuario == 10) { ?>
                <a class="btn-addProduct" href="index.php?action=crear-producto">Agregar producto</a>
        <?PHP } ?>
</div>

<div class="continer-products">

        <?PHP foreach ($productos as $p) { ?>
                <div class="product-detail">
                        <img src="<?PHP echo is_null($p->getUrlImg()) ? 'assets/img/product_empty.png' : $p->getUrlImg(); ?>" alt="<?PHP echo $p->getNombreProducto(); ?>">
                        <h2><?PHP echo $p->getNombreProducto(); ?></h2>
                        <p><strong>Precio de Renta:</strong> $<?PHP echo $p->getPrecioDeRenta(); ?> COP</p>
                        <p><strong>Estado:</strong> <?PHP echo $p->getEstadoProducto(); ?> </p>
                        <p><strong>Marca:</strong> <?PHP echo $p->getMarca()->getNombreMarca(); ?></p>
                </div>
        <?PHP } ?>
</div>