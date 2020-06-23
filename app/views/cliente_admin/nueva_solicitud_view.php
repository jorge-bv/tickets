<link href="<?php echo base_url()?>assets/css/summernote.css" rel="stylesheet">
<link href="<?php echo base_url()?>assets/css/summernote-bs3.css" rel="stylesheet">
<div id="contenido-der">
    <?php echo form_open_multipart('','id="envia-form"',$hidden)?>
    <div class="form-group">
	    <label for="descripcion"><b>Seleccione Producto asociado</b></label>
	    <select name="data[productos_id]" class="form-control">
	    	<option>Seleccione</option>
	    	<?php foreach ($productos as $key => $value): ?>
	    		<option value="<?php echo $value->productos_id ?>"><?php echo $value->productos_nombre ?></option>
			<?php endforeach ?>
	    </select>
		    
	</div>
	<div class="form-group">
	    <label for="descripcion"><b>Asunto</b></label>
	    <input type="text" name="data[titulo]"   class="form-control" placeholder="Indique el asunto"/>
	</div>
    <div class="form-group">
	    <label for="descripcion"><b>Descripción del problema</b></label>
            <textarea  rows="7" name="data[descripcion]" id="descripcion" class="form-control summernote" placeholder="Descripción del problema"></textarea>
	</div>
    <label for="descripcion"><b>Adjuntar imagen</b></label>
	<div id="conte"class="form-group">
            <form method="post" enctype="multipart/form-data">
            <input accept=".pdf,.jpg,.png" type="file" name="imagen" id="imagen" rows="10" cols="80">
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