<table class="table" >
    <thead>
        <th colspan="4" class="texto-centro">COMENTARIOS</th>
    </thead>
    <?php if (count($comentarios) > 0): ?>
	    <tr>
	    	<th>Nombre</th>
	    	<th>Comentario</th>
	    	<th>Fecha</th>
                <th>Adjunto</th>
	    </tr>
	    <?php foreach ($comentarios as $key => $value): ?>
	        <tr>
	        	<td>
	        		<?php if (!empty($value->cliente)): ?>
						<?php echo $value->cliente ?>
					<?php else: ?>
						<?php echo $value->agente ?>
					<?php endif ?>
	        	</td>
	        	<td><?php echo $value->descripcion ?></td>
                        
	            <td><?php echo ordenar_fechaHoraHumano($value->create) ?></td>
                    
                   <?php if (!empty($value->img_1)): ?>
		
     
        	<td >
                    <img class="popee" style="width: 100px"   src="<?php echo base_url().'adjuntas_gestion/'.$value->img_1 ?>" />
        	</td>
     
	<?php endif ?>

                   
	        </tr>    
	    <?php endforeach ?>
	<?php else: ?>
        <th><h4>Aún no hay comentarios</h4></th>
    <?php endif ?>
</table>
<!--<style>
    
img.zoom {
    width: 550px;
    height: 400px;
    -webkit-transition: all .2s ease-in-out;
    -moz-transition: all .2s ease-in-out;
    -o-transition: all .2s ease-in-out;
    -ms-transition: all .2s ease-in-out;
}
 
.transition {
    -webkit-transform: scale(5.3); 
    -moz-transform: scale(5.3);
    -o-transform: scale(5.3);
    transform: scale(5.3);
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script>
$(document).ready(function(){
    $('.img-responsive').hover(function() {
        $(this).addClass('transition');
    }, function() {
        $(this).removeClass('transition');
    });
});
</script>-->
<div class="modal fade" id="imagemodal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" id="mdialTamanio">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
        <h4 class="modal-title" id="myModalLabel">Imagen</h4>
      </div>
      <div class="modal-body">
          <img width="2000px" height="2000px"  src="" class="img-responsive" id="imagepreview2" style="" >
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
<script>
    $('.popee').each(function (){
         $(this).on("click", function() {
   $('#imagepreview2').attr('src', $(this).attr('src')); // here asign the image to the modal when the user click the enlarge link
   $('#imagemodal2').modal('show');
    });
    // imagemodal is the id attribute assigned to the bootstrap modal, then i use the show function
});
</script>
<style>
    #imagepreview2 {
    width:100%;
    max-width:1000px;
}
</style>