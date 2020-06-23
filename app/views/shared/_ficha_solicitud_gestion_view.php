<table class="table ">

<style type="text/css">
    .table thead {
        background-color: #2aabd2; 
    }
</style>


	<thead>
		<th colspan="5">DETALLE FICHA</th>
	</thead>
    <tr>
        <th width="100" class="text-center">N° Interno</th>
        <th width="100"  class="text-center">N° Correlativo</th>
        <th class="text-center">Estado</th>
        <th class="text-center">Última actualización</th>
        <th width="150"  class="text-center">Fecha creación</th>
    </tr>
    <tr>
        <td class="text-center"><?php echo $solicitud->id ?></td>
        <td class="text-center"><?php echo $solicitud->correlativo ?></td>
        <td class="text-center"><?php echo $solicitud->estado ?></td>
        <td class="text-center"><?php echo ordenar_fechaHoraHumano($solicitud->update) ?></td>
        <td class="text-center"><?php echo ordenar_fechaHoraHumano($solicitud->create) ?></td>
    </tr>
    <tr>
    	<th colspan="5">Solicitante</th>
    </tr>
    <tr>
    	<td colspan="5">
        	<span class="col-md-4"><i class="glyphicon glyphicon-user"></i> <?php echo $cliente->nombre ?></span>  
        	<span class="col-md-4"><i class="glyphicon glyphicon-envelope"></i> <?php echo $cliente->correo ?></span>
        	<span class="col-md-4"><i class="glyphicon glyphicon-earphone"></i> <?php echo $cliente->telefono ?></span>
        	<span class="col-md-12"><i class="glyphicon glyphicon-briefcase"></i> <?php echo $empresa->nombre?></span>
        </td>
    </tr> 
   
    <thead>
		<th colspan="5">DETALLE DE LA SOLICITUD</th>
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
        	<th colspan="4">Documento adjunto</th>
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
                            
                           
                            <img width="40px"  src="<?php echo base_url().'assets/images/download.png'?>">        <b> <a download href="<?php echo base_url().'uploads/'.$solicitud->img_1?>" >DESCARGAR DOCUMENTO</a></b>
                  
                        </td>
                        
	        </tr>
                  <?php endif ?>
                  
		<?php endif ?>

   
</table>
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
        <img  src="" class="img-responsive" id="imagepreview" style="" >
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
<style>
    #imagepreview {
    width:100%;
    max-width:1000px;
}
</style>