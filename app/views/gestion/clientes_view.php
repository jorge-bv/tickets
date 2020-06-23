<div id="contenido-der">
  
    
    
    <div class="input-group"> <h5><b>Buscar</b></h5>
        <input type="" style="background-color:#e6eeee " id="entradafilter" type="text" class="form-control " placeholder="Ingrese texto">
        
</div>
    <br>
    <table class="table">
        <thead style="background-color:#2aabd2">
            <th>Nombre</th>
            <th>Correo </th>
             
                <th>opciones</th>
	      
	        
            <th></th>
        </thead>
        <tbody class="contenidobusqueda"
        <?php foreach ($cliente as $key ): ?>
            
        <tr>
            <td><?php echo $key['nombre']; ?></td>
            <td><?php echo $key['rut']; ?></td>
             <td><?php echo $key['correo']; ?></td>
          
            <td width="">
                <a class="btn btn-primary btn-xs" href="<?php echo base_url().'gestion/solicitudesClientes/'.$key['id']?>">Ver Más</a>
            </td>
        </tr>
        <?php endforeach ?>
        
        </tbody>
    </table>
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
</div>