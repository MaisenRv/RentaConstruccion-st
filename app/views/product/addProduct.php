<div class="container-product-general">
    <form method="post" action="index.php?action=crear_producto" id="AddProductForm">
        <div class="input-group">
            <label for="nombreProducto">Nombre del producto</label>
            <input type="text" name="nombreProducto" id="nombreProducto" placeholder="Nombre del producto" class="general-inputs">
        </div>
        <div class="input-group">
            <label for="estado">Estado del producto</label>
            <input type="text" name="estado" id="estado" placeholder="Estado" class="general-inputs">
        </div>
        <div class="input-group">
            <label for="precioRenta">Precio de renta</label>
            <input type="number" name="precioRenta" id="precioRenta" placeholder="Precio de renta" class="general-inputs">
        </div>
        <div class="input-group">
            <label for="urlImg">Link de la imagen del producto</label>
            <input type="text" name="urlImg" id="urlImg" placeholder="Https://imagen.png" class="general-inputs">
        </div>
        <div class="input-group">
            <label for="marca">Marca</label>
            <select name="marca" id="marca" required>
                <option value="0">Seleccionar marca</option>
                <?PHP foreach ($marcas as $m) { ?>
                    <option value="<?PHP echo $m->getCodigoMarca() ?>"><?PHP echo $m->getNombreMarca(); ?></option>
                <?PHP }; ?>
            </select>
        </div>
        <div class="input-group">
            <label for="categoria">Categoria</label>
            <select name="categoria" id="categoria" required>
                <option value="0">Seleccionar categoria</option>
                <?PHP foreach ($categorias as $c) { ?>
                    <option value="<?PHP echo $c->getIdCategoria() ?>"><?PHP echo $c->getCategoria(); ?></option>
                <?PHP }; ?>
            </select>
        </div>
        <div class="input-group">
            <label for="CantidadProducto">Cantidad de unidades</label>
            <input type="number" name="CantidadProducto" id="CantidadProducto" placeholder="Cantidad de unidades" class="general-inputs">
        </div>
        <button type="submit" class="login-btn">Crear</button>
    </form>
</div>