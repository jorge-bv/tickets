<link href="<?php echo base_url()?>assets/css/summernote.css" rel="stylesheet">
<link href="<?php echo base_url()?>assets/css/summernote-bs3.css" rel="stylesheet">
<div id="contenido-der">
    <?php echo form_open_multipart('','id="envia-form"',$hidden)?>
    <div class="form-group">
         <label for="descripcion"><b>Seleccione correlativo de solicitud </b></label>
        <select id="correlativo" name="data[correlativo]" class="form-control">
            <option value="">Seleccione</option>
	    	<?php foreach ($solicitud as $key =>$value ): ?>
	    		<option value="<?php echo $value->correlativo ?>"><?php echo $value->correlativo?></option>
			<?php endforeach ?>
	    </select>   
        <br>
        <label for="descripcion"><b>Seleccione Empresa</b></label>
        <select id="empresa" name="data[empresas_id]" class="form-control">
	    	<option>Seleccione</option>
	    	<?php foreach ($empresas as $key =>$value ): ?>
	    		<option value="<?php echo $value->id ?>"><?php echo $value->nombre?></option>
			<?php endforeach ?>
	    </select>   
        <br>
         <label for="descripcion"><b>Seleccione Cliente </b></label>
        <select id="cliente" name="data[clientes_id]" class="form-control">
	    	<option>Seleccione</option>
	    	<?php foreach ($cliente as $key ): ?>
	    		<option value="<?php echo $key['id'] ?>"><?php echo $key['nombre'] ?></option>
			<?php endforeach ?>
	    </select>
          <br>
	    <label for="descripcion"><b>Seleccione Producto asociado</b></label>
            
	    <select id="product" name="data[productos_id]" class="form-control">
	    	<option>Seleccione</option>
	    	<?php foreach ($productos as $key => $value): ?>
	    		<option value="<?php echo $value->id ?>"><?php echo $value->nombre?></option>
			<?php endforeach ?>
	    </select>
		 
	</div>
	<div class="form-group">
	    <label for="descripcion"><b>Asunto</b></label>
	    <input type="text" name="data[titulo]"   class="form-control" placeholder="Indique el asunto"/>
	</div>
    <div class="form-group">
	    <label for="descripcion"><b>Descripción del problema</b></label>
            <textarea  rows="7" name="data[descripcion]" id="descripcion" class="form-control summernote " placeholder="Descripción del problema"></textarea>
	</div>
    <label for="descripcion"><b>Adjuntar Documento o imagen</b></label>
	<div id="conte"class="form-group">
            <form method="post" enctype="multipart/form-data">
            <input accept=".pdf,.jpg,.png,.docx,.xlsx" type="file" name="imagen" id="imagen" rows="10" cols="80">
 </form>
            </div>
         

<!--                        <script src="//cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>-->
                        <script>


                        
 
</script>

                    
                        
	
	<div class="form-group">
	    <label for="boton"></label>
	    <button class="btn btn-primary" style="padding: 5px;" name="continuar" id="continuar">Crear Solicitud</button>
	</div>
    <?php echo form_close()?>
</div>


<script>
   
  
$(document).ready(function() {
    window.empresas=JSON.parse('<?php echo json_encode($empresas); ?>');
     window.clientes=JSON.parse('<?php echo json_encode($cliente); ?>');
      window.product=JSON.parse('<?php echo json_encode($productos); ?>');
      $('#empresa').on('change',function (event){
          const empresa_id= event.target.value;
          const _clientes=window.clientes.filter(function (cliente){
             return cliente.empresas_id===empresa_id; 
          })
           const _productos=window.product.filter(function (producto){
             return producto.productos_empresas_empresas_id===empresa_id; 
             
          })
           $('#cliente').empty().append(_clientes.map(function (cliente){
               return '<option value="'+cliente.id+'">'+cliente.nombre+'</option>'
           }).join(''))
             $('#product').empty().append(_productos.map(function (producto){       
               return '<option value="'+producto.productos_id+'">'+producto.productos_nombre+'</option>'
           }).join(''))
      })
    $('#continuar').click(function(){
        
            $('#envia-form').submit();
        
    });
});

</script> 
<script src="<?php echo base_url()?>assets/js/summernote.min.js"></script>
<script>
     	$('.summernote').summernote({
  toolbar: [
    // [groupName, [list of button]]
    ['style', ['bold', 'italic', 'underline', 'clear']],
    ['font', ['strikethrough', 'superscript', 'subscript']],
    ['fontsize', ['fontsize']],
    ['color', ['color']],
    ['para', ['ul', 'ol', 'paragraph']],
    ['height', ['height']]
  ]
});
</script>


