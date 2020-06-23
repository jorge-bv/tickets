
<?php if($accion == 0):?>
       <?php echo form_open('')?>
        <div class="caja-envuelve2">
      
       
      <div class="container-fluid" style="margin-top:70px">
                 <div class="panel-body tab-content">
                     <div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4 col-xs-12">
                         <div class="panel panel-body" style="background:#cae6fc">
                                  <center><legend style="background: #cae6fc"><b> RECUPERAR CONTRASEÑA</b></legend></center>
                <img src="<?php echo base_url().'assets/images/hitch_HD_cliente.png' ?>" class="img-responsive center-block" alt="Hitch Help Desk / Cliente">
				<table width="138%">
                                    <tr>
					
                                            <td align="right"><b>Ingrese correo</b></td>
                                        
                                          
                                            
                                                    
						<td>
							<?php echo form_input('data[correo]', set_value('data[correo]'))?>
                                                  
						</td>
					</tr>
                                        <td>&nbsp;</td>
					<tr align="right">
						<td>&nbsp;</td>
						<td align="left"><?php echo form_submit('submit', 'Recuperar','class="btn btn-primary "style="width:180px; height:40px" ')?></td>
					</tr>
				</table>
			
			<span style="color:red; font-size: 0.8em"><?php echo validation_errors();?><?php echo $error;?></span>
		</div>		
        <?php echo form_close()?>
<?php else:?>
    <meta http-equiv="refresh" content="4; URL=<?php echo base_url()?>" />
	<div class="caja-envuelve">
            <center>  <fieldset style=" background: #cae6fc">
			<legend style=" background: #cae6fc">RECUPERAR CONTRASEÑA</legend>
                          <img src="<?php echo base_url().'assets/images/hitch_HD_cliente.png' ?>" class="img-responsive center-block" alt="Hitch Help Desk / Cliente">
			<p style="font-size: 1.2em">Correo enviado exitosamente a <i><?php echo $correo?></i></p>
			<p style="font-size: 1.2em">Para recuperar el acceso a tu cuenta, sigue las instrucciones que hemos enviado a tu dirección de correo electrónico.</p>
                </fieldset></center>
	</div>
<?php endif?>
            </div>
        </div>
      </div>
        </div>
    