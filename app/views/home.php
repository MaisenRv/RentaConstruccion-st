<div class="card-container">
    <?PHP foreach($categorias as $c){ ?>
        <a href="index.php?action=productos&categoria=<?PHP echo $c->getIdCategoria(); ?>" class="card">
            <h3><?PHP echo $c->getCategoria(); ?></h3>
        </a>
    <?PHP }?>
    <!-- <a href="obra-gruesa.html" class="card">
        <h3>Obra Gruesa</h3>
    </a>
    <a href="compartacion.html" class="card">
        <h3>Compartición</h3>
    </a>
    <a href="pinturas.html" class="card">
        <h3>Pinturas</h3>
    </a>
    <a href="terminaciones.html" class="card">
        <h3>Terminaciones</h3>
    </a>
    <a href="gasfiteria.html" class="card">
        <h3>Gasfitería</h3>
    </a>
    <a href="extraccion-agua.html" class="card">
        <h3>Extracción de Agua</h3>
    </a>
    <a href="generacion-electricidad.html" class="card">
        <h3>Generación de Electricidad</h3>
    </a>
    <a href="trabajo-alturas.html" class="card">
        <h3>Trabajo en Alturas</h3>
    </a> -->
</div>