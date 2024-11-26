<div class="stock-container">
  <div class="stock-header">Gestión de Stock</div>
  <table>
    <thead>
      <tr>
        <th>Nombre del Producto</th>
        <th>Fecha</th>
        <th>Tipo de Movimiento</th>
        <th>CantidadMovimiento</th>
        <th>Cantidad Acumulada</th>
        <th>Estado</th>
      </tr>
    </thead>
    <tbody>
      <?PHP foreach($stockList as $s){ ?>
      <tr>
        <td><?PHP echo $s->getCodigoProducto();?></td>
        <td><?PHP echo $s->getFecha()->format('Y-m-d H:i:s');?></td>
        <td><?PHP echo $s->getTipoMovimiento();?></td>
        <td><?PHP echo $s->getCantidadMovimiento();?></td>
        <td><?PHP echo $s->getCantidadAcumulada();?></td>
        <td><?PHP echo $s->getEstado();?></td>
      </tr>
      <?PHP } ?>
      <!-- <tr>
        <td>Compactadoras</td>
        <td>2024-11-05</td>
        <td>Salida</td>
        <td>80</td>
        <td>Agotado</td>
      </tr>
      <tr>
        <td> Compresores</td>
        <td>2024-11-10</td>
        <td>Ingreso</td>
        <td>200</td>
        <td>Disponible</td>
      </tr>
      <tr>
        <td>Andamios</td>
        <td>2024-11-15</td>
        <td>Salida</td>
        <td>50</td>
        <td>Bajo Stock</td>
      </tr> -->
    </tbody>
  </table>
</div>