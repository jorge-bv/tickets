<div id="contenido-der">
  
    
    
    <div class="input-group"> <h5><b>Buscar</b></h5>
        <input type="" style="background-color:#e6eeee " id="entradafilter" type="text" class="form-control " placeholder="Ingrese texto">
        
</div>
    <br>
    <table style="background-color: #c2e1ef" class="table table-striped">
        <thead style="background-color:#2aabd2">
            <th>N°</th>
            <th>Corr. <i class="glyphicon glyphicon-question-sign" title="Correlativo de la empresa"></i></th>
	        <th>Estado</th>
	        <th>Asunto</th>
                <th>Fecha creación</th>
	        <th>Última actualización</th>
             
                <th>opciones</th>
	        
            <th></th>
        </thead>
        <tbody class="contenidobusqueda"
        <?php foreach ($solicitudes as $key => $value): ?>
        
        <tr>
            <td><?php echo $value->solicitudes_id ?></td>
            <td class="text-center"><?php echo $value->solicitudes_correlativo ?></td>
            <td><?php echo $value->estados_nombre?></td>
            <td><?php echo substr($value->solicitudes_titulo, 0,30) ?></td>
            <td><?php echo ordenar_fechaHoraHumano($value->solicitudes_create) ?></td>
            <td><?php echo ordenar_fechaHoraHumano($value->solicitudes_update) ?></td>
          
            <td width="">
                <a class="btn btn-primary btn-xs" href="<?php echo $url.$value->solicitudes_id?>">Ver Más</a>
            </td>
        </tr>
     
        <?php endforeach ?>
        </tbody>
    </table>
    
</div>
   <?php echo $pagination;?>
<script>
    $(document).ready(function () {
        $('#entradafilter').keyup(function () {
            var rex = new RegExp($(this).val(), 'i');
            $('.contenidobusqueda tr').hide();
            $('.contenidobusqueda tr').filter(function () {
                return rex.test($(this).text());
            }).show();

        })

    });
</script>
