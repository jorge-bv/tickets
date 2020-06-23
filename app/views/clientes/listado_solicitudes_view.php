<table style="background-color: #c2e1ef" class="table table-striped">
    <thead>
        <th>N°</th>
        <th>Estado</th>
        <th>Asunto</th>
        <th>Última actualización</th>
        <th>Fecha creación</th>
        <th></th>
    </thead>
  
    <?php foreach ($solicitudes as $key => $value): ?>
    <tr>
        <td><?php echo $value->solicitudes_correlativo ?></td>
        <td><?php echo $value->estados_nombre ?></td>
        <td><?php echo substr($value->solicitudes_titulo, 0,30) ?></td>
        <td><?php echo ordenar_fechaHoraHumano($value->solicitudes_update) ?></td>
        <td><?php echo ordenar_fechaHumano($value->solicitudes_create) ?></td>
          
        <td width="">
            <a href="<?php echo base_url().'clientes/solicitud/'.$value->solicitudes_correlativo ?>" class="btn btn-xs btn-primary">Ver mas</a>
        </td>
    </tr>
  
    <?php endforeach ?>
  
</table>
 
