<div class="historial-container">
  <?PHP if ($historial != null) {?>
  <div class="historial-header">Historial del Cliente</div>
  <table>
    <thead>
      <tr>
        <!-- <th>Código Historial</th> -->
        <th>Código Pedido</th>
        <th>Fecha Inicio</th>
        <th>Fecha Fin</th>
        <th>Estado</th>
        <th>Observaciones</th>
      </tr>
    </thead>
    <tbody>

    <?PHP foreach ($historial as $h) { ?>
      <tr>
        <!-- <td>1</td> -->
        <td><?PHP echo $h->getCodigoPedido(); ?></td>
        <td><?PHP echo $h->getFechaInicio()->format('Y-m-d H:i:s'); ?></td>
        <td><?PHP echo $h->getFechaFin()->format('Y-m-d H:i:s'); ?></td>
        <td><?PHP echo $h->getEstado(); ?></td>
        <td><?PHP echo $h->getObservaciones(); ?></td>
      </tr>
      <?PHP } ?>
    </tbody>
  </table>
  <?PHP } else{ ?>
    No has realizado un pedido aun
  <?PHP } ?>
</div>