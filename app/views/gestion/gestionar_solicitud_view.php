<link href="<?php echo base_url()?>assets/css/summernote.css" rel="stylesheet">
<link href="<?php echo base_url()?>assets/css/summernote-bs3.css" rel="stylesheet">
<link href="bootstrap.css" rel="stylesheet">
<div id="contenido-der">
    <?php $this->load->view('shared/_ficha_solicitud_gestion_view') ?>
    <hr />
    
    <?php echo form_open('','',$hidden)?>
    	<?php if ($solicitud->etapas_id == 20 && ($solicitud->estados_id == 200 || $solicitud->estados_id == 230)): //Solicitud asignada o rechazo no conforme?>
			<div class="form-group col-md-12 text-right">
				<div class="btn-group">
					<a href="<?php echo base_url().'gestion/procesar_solicitud/'.$solicitud->id ?>" class="btn btn-primary">Procesar</a>
					<a href="<?php echo base_url().'gestion/rechazar_solicitud/'.$solicitud->id ?>" class="btn btn-danger">Rechazar</a>
				</div>
			</div>
		<!-------------------------------------------------------------------------------------------------------------------->
		
		<?php elseif ($solicitud->etapas_id == 20 && ($solicitud->estados_id == 250 )): //Proceso terminado?>
		    <div class="form-group col-md-12">
			    <label for="observacion" class="col-md-12 alert alert-warning"><b>En espera de que cliente valide resolución</b></label>
			</div>
		<!-------------------------------------------------------------------------------------------------------------------->
		
		<?php elseif ($solicitud->etapas_id == 20 && ($solicitud->estados_id == 221 )): //Rechazada y comentada?>
		    <div class="form-group col-md-12">
			    <label for="observacion" class="col-md-12 alert alert-warning"><b>En espera de que cliente valide el motivo del rechazo</b></label>
			</div>
		<!-------------------------------------------------------------------------------------------------------------------->
		
		<?php elseif ($solicitud->etapas_id == 20 && ($solicitud->estados_id == 210 || $solicitud->estados_id == 260)): //Solicitud en proceso?>
		    <div class="form-group col-md-12">
			    <label for="observacion"><b>OBSERVACIÓN TÉCNICA</b></label>
			    <textarea rows="3" name="data[observacion_tecnica]" id="observacion" class="form-control summernote" placeholder="Agregue observación"><?php echo $solicitud->observacion_tecnica ?></textarea>
			</div>
			<?php if ($solicitud->clientes_id != null): ?>
				<div class="form-group col-md-12">
				<input type="hidden" name="data[estados_id]" value="250" />
			    <input type="hidden" name="tipo_respuesta" value="proceso_terminado" id="tipo_respuesta"/>
				    <div class="col-md-12 text-right"><button type="submit" class="btn btn-danger" name="continuar" id="guardar_observacion">Agregar observación técnica y Cerrar</button></div>
				</div>
			<?php else: ?>	
				<div class="form-group col-md-12">
				
					<input type="hidden" name="data[estados_id]" value="300" />
					<input type="hidden" name="data[etapas_id]" value="30" />
					<input type="hidden" name="tipo_respuesta" value="proceso_terminado" id="tipo_respuesta"/>
				    <div class="col-md-12 text-right"><button type="submit" class="btn btn-danger" name="continuar" id="guardar_observacion">Agregar observación técnica y Cerrar</button></div>
				</div>
			<?php endif ?>
		<!-------------------------------------------------------------------------------------------------------------------->
		
		<?php elseif ($solicitud->etapas_id == 20 && $solicitud->estados_id == 220): //solicitud Rechazada ?>
		    <div class="form-group col-md-12">
			    <label for="descripcion"><b>MOTIVO RECHAZO</b></label>
			    <textarea rows="4" name="data[motivo_rechazo]" id="motivo_rechazo" class="form-control summernote" placeholder="Agregue el motivo del rechazo"><?php echo $solicitud->motivo_rechazo ?></textarea>
			    <input type="hidden" name="tipo_respuesta" value="rechazo" id="tipo_respuesta"/>
			</div>
			<div class="form-group col-md-12">
			    <div class="col-md-12 text-right"><button type="submit" class="btn btn-danger" name="continuar" id="guardar_observacion">Agregar motivo rechazo</button></div>
			</div>
		<!-------------------------------------------------------------------------------------------------------------------->
		
		<?php elseif ($solicitud->etapas_id == 20 && $solicitud->estados_id == 240): //Rechazo conforme ?>
			<div class="form-group col-md-12 text-right">
				<div class="btn-group">
					<a href="<?php echo base_url().'gestion/cerrar_solicitud/'.$solicitud->id ?>" class="btn btn-primary">Terminar y cerrar solicitud</a>
				</div>
			</div>
		<?php endif ?>
		
		<input type="hidden" name="solicitud_id" value="<?php echo $solicitud->id ?>" />  
    <?php echo form_close()?>
    
    <div class="col-md-12 row" id="div_comentarios">        
	<?php $this->load->view('shared/_comentarios_listado') ?>
	</div>
	<hr />
	
	<?php if ($solicitud->etapas_id != 30 && $solicitud->estados_id != 300): ?>
		<?php echo form_open_multipart('gestion/guardar_comentarios','id="form_comentarios"',$hidden)?>
		    <div class="form-group">
			    <label for="descripcion"><b>AGREGAR COMENTARIOS</b></label>
			    <textarea rows="3" name="descripcion" id="descripcion" class="form-control" placeholder="Agregue un comentario"></textarea>
			    <input type="hidden" name="solicitud_id" value="<?php echo $solicitud->id ?>" />
                          
                              <label for="descripcion"><b>Adjuntar imagen</b></label>
	<div id="conte"class="form-group">

             <form method="post" enctype="multipart/form-data">
            <input accept=".pdf,.jpg,.png" type="file" name="imagen" id="imagen" rows="10" cols="80">
 </form>
        	
                    </div>
        
        
			<div class="form-group">
			    <button  class="btn btn-primary" name="continuar" id="guardar_comentarios">Agregar comentario</button>
			</div>
		<?php echo form_close()?>
	<?php endif ?>
	
	<div id="div_bitacora">        
		<?php $this->load->view('shared/_bitacora') ?>
	</div>
</div>
</div>

<script src="<?php echo base_url()?>assets/js/summernote.min.js"></script>
<script>
	$('.summernote').summernote({
	  height: 200,	
	});
	$('#guardar_comentarios').click(function(){
        var descripcion  = $('#descripcion').val().length;
        if(descripcion == 0)
        {
            alert("El campo comentario no puede quedar vacío");
        }
        else
        {
            if(descripcion >250)
            {
                alert("Max carecteres 250");
            }
            else
            {
               $('#form_comentarios').submit();
            }
            
        }
    });
    
</script> 
<script src="jquery.js"></script>
<script src="bootstrap-modal.js"></script>