<div id="contenido-der">
    <?php $this->load->view('shared/_ficha_solicitud_gestion_view') ?>
    <table class="table"  >
    	<thead>
    		<th colspan="4">RESOLUCIÓN DE LA SOLICITUD</th>
                	</thead>
                <tr>
	        	<td colspan="5"><?php echo $solicitud->estado ?></td>
	        </tr>
            
       
    	<?php if (!empty($solicitud->observacion_tecnica)): ?>
            <tr>
	        	<th colspan="5" style="background-color: #2aabd2">Observación técnica</th>
	        </tr>
	        <tr>
	        	<td colspan="5"><?php echo $solicitud->observacion_tecnica ?></td>
	        </tr>
        <?php endif ?>
        
        <?php if (!empty($solicitud->motivo_rechazo)): ?>
            <tr>
	        	<th colspan="5">Motivo rechazo</th>
	        </tr>
	        <tr>
	        	<td colspan="5"><?php echo $solicitud->motivo_rechazo ?></td>
	        </tr>
        <?php endif ?>
    </table>

    <div id="div_comentarios">        
    <?php $this->load->view('shared/_comentarios_listado') ?>
    </div>
    <div id="div_bitacora">        
		<?php $this->load->view('shared/_bitacora') ?>
	</div>
</div>