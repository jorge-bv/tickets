<div id="contenido-der">
	<?php if (!empty($mensaje_creacion)): ?>
		<div class="alert alert-success" role="alert" style="padding:3px 15px">
			<h5 style="color: #000"><?php echo $mensaje_creacion?></h5>
		</div>
	<?php endif ?>
    <table class="table">
    	<thead>
			<th colspan="4">DETALLE FICHA</th>
		</thead>
        <tr>
	        <th class="text-center">N°</th>
	        <th class="text-center">Estado</th>
	        <th class="text-center">Última actualización</th>
	        <th class="text-center">Fecha creación</th>
	    </tr>
	    <tr>
	        <td class="text-center"><?php echo $solicitud->correlativo ?></td>
	        <td class="text-center"><?php echo $solicitud->estado ?></td>
	        <td class="text-center"><?php echo ordenar_fechaHoraHumano($solicitud->update) ?></td>
	        <td class="text-center"><?php echo ordenar_fechaHoraHumano($solicitud->create) ?></td>
	    </tr>
	    <tr>
    	<th colspan="4">Responsable</th>
	    </tr>
	    <tr>
	    	<td colspan="4">
	    		<?php if (empty($agente)): ?>
					Sin responable asignado
				<?php else: ?>
					<span class="col-md-4"><i class="glyphicon glyphicon-user"></i> <?php echo $agente->nombre ?></span>  
	        		<span class="col-md-4"><i class="glyphicon glyphicon-envelope"></i> <?php echo $agente->correo ?></span>
				<?php endif ?>
	        </td>
	    </tr>
	    <thead>
			<th colspan="4">DETALLE DE LA SOLICITUD</th>
		</thead>
		<tr>
	    	<th colspan="5">Producto asociado</th>
	    </tr>
	    <tr>
	    	<td colspan="5"><?php echo $solicitud->producto ?></td>
	    </tr>
	    <tr>
	    	<th colspan="5">Asunto de la solicitud</th>
	    </tr>
	    <tr>
	    	<td colspan="5"><?php echo $solicitud->titulo ?></td>
	    </tr>
        <tr>
        	<th colspan="5">Descripcion de la solicitud</th>
        </tr>
        <tr>
        	<td colspan="5"><?php echo $solicitud->descripcion ?></td>
        </tr>
        
	    <?php if (!empty($solicitud->img_1)): ?>
			<tr>
	        	<th colspan="5"> adjunto</th>
	        </tr>
	          <?php $resto=  substr($solicitud->img_1, -4);
                          
                   if($resto=='.jpg' OR $resto=='.png'):
                       
                       ?>
	        <tr>
	        	<td colspan="5">
                            
                            <img  style="width: 300px" id="pop"  src="<?php echo base_url().'uploads/'.$solicitud->img_1 ?>" />
                            
                            <b> <a download href="<?php echo base_url().'uploads/'.$solicitud->img_1?>" >DESCARGAR DOCUMENTO</a></b>
                  
                        </td>
                        
	        </tr>
                              

                 <?php elseif ($resto=='.pdf' OR $resto=='docx' OR $resto=='xlsx' ): ?>
               <tr>
	        	<td colspan="5">
                       
                           
                            <img width="40px"  src="<?php echo base_url().'assets/images/download.png'?>">    <b> <a download href="<?php echo base_url().'uploads/'.$solicitud->img_1?>" >DESCARGAR DOCUMENTO</a></b>
                  
                        </td>
                        
	        </tr>
                  <?php endif ?>
                  
		<?php endif ?>
    </table>
    <table class="table">
        <thead>
            <th colspan="2" class="texto-centro">ESTADO ATENCIÓN</th>
        </thead>
        <tr>
        	<td colspan="2"><h4><?php echo $solicitud->estado ?></h4></td>
        </tr>
        <?php if ($solicitud->estados_id == 221): ?>
        	<thead>
            	<th colspan="2" class="texto-centro">MOTIVO RECHAZO</th>
        	</thead>
            <tr>
            	<td colspan="2"><?php echo $solicitud->motivo_rechazo ?></td>
            </tr>
            <tr>
            	<td colspan="2">
            		<div class="form-group col-md-12 text-right">
						<div class="btn-group">
							<a href="<?php echo base_url().'clientes_admin/rechazo_conforme/'.$solicitud->correlativo ?>" class="btn btn-primary tooltips">Rechazo conforme</a>
							<a data-toggle="tooltip" data-placement="right" title="Agregue un comentario indicando por qué no acepta conforme" href="<?php echo base_url().'clientes_admin/rechazo_no_conforme/'.$solicitud->correlativo ?>" class="btn btn-danger tooltips">Rechazo No conforme</a>
						</div>
					</div>
            	</td>
            </tr>
        <?php elseif($solicitud->estados_id == 250):  ?>
            <thead>
            	<th colspan="2" class="texto-centro">COMENTARIO TÉCNICO</th>
        	</thead>
            <tr>
                <td colspan="2"> <?php echo $solicitud->observacion_tecnica ?></td>
            </tr>
            <tr>
            	<td colspan="2">
            		<div class="form-group col-md-12 text-right">
						<div class="btn-group">
							<a href="<?php echo base_url().'clientes_admin/cerrar_solicitud/'.$solicitud->correlativo ?>" class="btn btn-primary tooltips">Aceptar y cerrar Solicitud</a>
							<a data-toggle="tooltip" data-placement="right" title="Agregue un comentario indicando por qué no acepta conforme" href="<?php echo base_url().'clientes_admin/proceso_no_conforme/'.$solicitud->correlativo ?>" class="btn btn-danger tooltips">No conforme</a>
						</div>
					</div>
            	</td>
            </tr>
        <?php endif ?>
    </table>
    <div id="div_comentarios">        
	<?php $this->load->view('shared/_comentarios_listado') ?>
	</div>
	<hr />
	<?php if ($solicitud->etapas_id != 30 && $solicitud->estados_id != 300): ?>
		<?php echo form_open_multipart('clientes_admin/guardar_comentarios','id="form_comentarios"',$hidden)?>
		    <div class="form-group">
			    <label for="descripcion"><b>AGREGAR COMENTARIOS</b></label>
			    <textarea rows="3" name="descripcion" id="descripcion" class="form-control" placeholder="Agregue un comentario"></textarea>
			    <input type="hidden" name="correlativo" value="<?php echo $solicitud->correlativo ?>" />
		                        <label for="descripcion"><b>Adjuntar imagen</b></label>
	<div id="conte"class="form-group">

                            <form method="post" enctype="multipart/form-data">
            <input accept=".pdf,.jpg,.png" type="file" name="imagen" id="imagen" rows="10" cols="80">
 </form>	
                    </div>
            
      
        	
                   
        
			<div class="form-group">
                            <button class="btn btn-primary" name="continuar" id="guardar_comentarios">Agregar comentario</button>
			</div>
		<?php echo form_close()?>
	<?php endif ?>
	
	<div id="div_bitacora">        
		<?php $this->load->view('shared/_bitacora') ?>
	</div>
                                         </div>
</div>


<script>
$(document).ready(function() {
	jQuery('.tooltips').tooltip();
	
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
                alert("El comentario debe tener máximo carecteres 250");
            }
            else
            {
               $('#form_comentarios').submit();
            }
            
        }
    });
    
    $('#guardar').click(function(){
    	alert( $("#satisfaccion-form input[name='radio']:radio").is(':checked'));
        if(!$('#radio').attr("check") || !$('#radio2').attr("checked"))
        {
            alert('Debe seleccionar una opción');
        }
        else
        {
            $('#satisfaccion-form').submit();
        }
    });
});

</script> 
 <style>
    #mdialTamanio{
      width: 80% !important;
      
    }
    #imagepreview{
        max-width: 100%;
            max-height: 100%
    }
/*    img.zoom {
    width: 350px;
    height: 200px;
    -webkit-transition: all .2s ease-in-out;
    -moz-transition: all .2s ease-in-out;
    -o-transition: all .2s ease-in-out;
    -ms-transition: all .2s ease-in-out;
}
 
.transition {
    -webkit-transform: scale(1.3); 
    -moz-transform: scale(1.3);
    -o-transform: scale(1.3);
    transform: scale(1.3);*/
/*}*/
  </style>
<!--  <script>
$(document).ready(function(){
    $('#imagepreview').hover(function() {
        $(this).addClass('transition');
    }, function() {
        $(this).removeClass('transition');
    });
});
</script>-->
<!-- Creates the bootstrap modal where the image will appear -->
<div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" id="mdialTamanio">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
        <h4 class="modal-title" id="myModalLabel">Imagen</h4>
      </div>
      <div class="modal-body">
          <img width="2000px" height="2000px"  src="" class="img-responsive" id="imagepreview" style="" >
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
<script>
    $("#pop").on("click", function() {
   $('#imagepreview').attr('src', $('#pop').attr('src')); // here asign the image to the modal when the user click the enlarge link
   $('#imagemodal').modal('show'); // imagemodal is the id attribute assigned to the bootstrap modal, then i use the show function
});
</script>