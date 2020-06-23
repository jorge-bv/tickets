<div id="contenido-der">
    <table class="table" style="background-color: #2aabd2;">
        <thead>
            <th>N° solicitud</th>
            <th>Fecha</th>
            <th>Estado</th>
            <th>Respuesta</th>
            <th>Descripcion del problema</th>
            <th></th>
        </thead>
        <?php foreach ($tareas as $key => $value): ?>
        <tr>
            <td><?php echo $value->id ?></td>
            <td><?php echo ordenar_fechaHoraHumano($value->fecha_creacion) ?></td>
            <td><?php echo $value->estado ?></td>
            <?php if($value->satisfaccion->satisfaccion_tipo_id == 2): ?>
                <td style="color: red">Rechazada disconforme</td>
            <?php elseif($value->satisfaccion->satisfaccion_tipo_id == 1): ?>
                <td>Aceptada conforme</td>
            <?php elseif($value->satisfaccion->satisfaccion_tipo_id == '0'): ?>
                <td>Cerrada automáticamente</td>
            <?php else: ?>
                <td></td>
            <?php endif ?>
            <td><?php echo $value->descripcion ?></td>
            <td width="12px">
            	<a class="btn btn-primary btn-xs" href="<?php echo base_url().'gestion/atencion/'.$value->id?>">Ver Más</a>
            </td>
            <input type="hidden" id="id"/>
        </tr>
        <?php endforeach ?>
    </table>
</div>


<script>
$(document).ready(function(){
 
})

</script> 