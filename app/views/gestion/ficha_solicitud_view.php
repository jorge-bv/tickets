<div id="contenido-der">
    <?php $this->load->view('shared/_ficha_solicitud_gestion_view') ?>

    <div id="div_comentarios">        
    <?php $this->load->view('shared/_comentarios_listado') ?>
    </div>
    <div class="col-md-14">
    	<hr />
    	<a href="<?php echo base_url().'gestion/asignar_solicitud/'.$solicitud->id ?>" class="btn btn-primary btn-block">Recepcionar solicitud</a>
    	<hr />
    </div>
    <div id="div_bitacora">        
		<?php $this->load->view('shared/_bitacora') ?>
	</div>
</div>


<script>
$(document).ready(function() {
    $('#herramientas').click(function(){
    $('#div_imagen').html('<img src="/assets/images/twizzle.gif" />');
    var toLoad= '<?php echo base_url()?>gestion/carga_trabajo/<?php echo $solicitud->id ?>';
    $.get(toLoad,function (responseText){
        $('#div_imagen').html(responseText);
    });
    });
});

</script> 