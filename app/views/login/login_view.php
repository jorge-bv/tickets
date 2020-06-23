<div class="container" style="margin-top:40px">
	<div class="row">
		<div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4 col-xs-12">
			<div class="panel panel-default">
				<div class="panel-heading text-center" style="">
					<ul id="myTab" class="nav nav-tabs" role="tablist">
				      <li role="presentation" class="<?php echo $cliente ?>"><a href="#home" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="false">Cliente</a></li>
				      <li role="presentation" class="<?php echo $agente ?>"><a href="#profile" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile" aria-expanded="true">Agente</a></li>
				    </ul>
				</div>
				<div class="panel-body tab-content">
					<div role="tabpanel" class="tab-pane fade <?php echo $cliente ?>" id="home" aria-labelledby="home-tab">
						<?php echo form_open(base_url().'login/cliente', 'id="form" role="form"','')?>
							<fieldset>
								<div class="row">
									<img src="<?php echo base_url().'assets/images/hitch_HD_cliente.png' ?>" class="img-responsive center-block" alt="Hitch Help Desk / Cliente">
								</div>
								<br>
								<div class="row">
                                                                      <center> 
                                                
                                            </center>
									<div class="col-sm-12 col-md-10  col-md-offset-1 ">
										<div class="form-group">
											<div class="input-group">
												<span class="input-group-addon">
													<i class="glyphicon glyphicon-user"></i>
												</span> 
												<input class="form-control input-login-cliente" id="correo_cliente" placeholder="Correo" name="cliente[correo]" type="text" autofocus>
											</div>
										</div>
										<div class="form-group">
											<div class="input-group">
												<span class="input-group-addon">
													<i class="glyphicon glyphicon-lock"></i>
												</span>
												<input class="form-control input-login-cliente" placeholder="Password" id="password_cliente"  name="cliente[password]" type="password" value="">
											</div>
										</div>
										<div class="form-group">
											<button disabled id="boton_login_cliente"  type="submit" class="btn btn-lg btn-danger btn-block">Ingreso cliente <i id="icono-remove_cliente" class="glyphicon glyphicon-remove"></i></button>
										</div>
									</div>
								</div>
							</fieldset>
                                             <?php echo $this->session->flashdata('error_login');?>
						 <?php echo form_close()?>
					</div>
					 <div role="tabpanel" class="tab-pane fade <?php echo $agente ?>" id="profile" aria-labelledby="profile-tab">
					 	<?php echo form_open(base_url().'login/agente', 'id="form" role="form"','')?>
							<fieldset>
								<div class="row">
									<img src="<?php echo base_url().'assets/images/hitch_HD_agente.png' ?>" class="img-responsive center-block" alt="Hitch Help Desk / Cliente">
								</div><br>
								<div class="row">
									<div class="col-sm-12 col-md-10  col-md-offset-1 ">
										<div class="form-group">
											<div class="input-group">
												<span class="input-group-addon">
													<i class="glyphicon glyphicon-user"></i>
												</span> 
												<input class="form-control input-login-agente" id="correo_agente" placeholder="correo" name="agente[correo]" type="text" autofocus>
											</div>
										</div>
										<div class="form-group">
											<div class="input-group">
												<span class="input-group-addon">
													<i class="glyphicon glyphicon-lock"></i>
												</span>
												<input class="form-control input-login-agente" placeholder="Password" id="password_agente"  name="agente[password]" type="password" value="">
											</div>
										</div>
										<div class="form-group">
											<button disabled type="submit" id="boton_login_agente" class="btn btn-lg btn-danger btn-block">Ingreso Agente <i id="icono-remove_agente" class="glyphicon glyphicon-remove"></i></button>
										</div>
									</div>
								</div>
                                                     
                                                              
							</fieldset>
                                                <?php echo $this->session->flashdata('error_login');?>
						 <?php echo form_close()?>
        
      				</div>
				</div>
                         
                           
  

				<div class="panel-footer ">
                                    <a href="<?php echo base_url().'login/recupera_contrasena' ?>"><b>Recuperar password</b></a>
				</div>
                            
            </div>
		</div>
	</div>
</div>
<script>
	$( ".input-login-cliente" ).keyup(function() {
	  if ($("#correo_cliente").val().length != 0 && $("#password_cliente").val().length != 0) {
        	$("#icono-remove-cliente").remove();
        	$("#boton_login_cliente").html('Ingresar <i id="icono-ok-cliente" class="glyphicon glyphicon-ok"></i>');
        	$("#boton_login_cliente").removeClass("btn-danger");
        	$("#boton_login_cliente").addClass("btn-primary");
        	$("#boton_login_cliente").prop('type', 'submit');
        	$("#boton_login_cliente").removeAttr('disabled');
        }
        else{
        	$("#icono-ok-cliente").remove();
        	$("#boton_login_cliente").html('Ingrese sus datos <i id="icono-remove-cliente" class="glyphicon glyphicon-remove"></i>');
        	$("#boton_login_cliente").removeClass("btn-primary");
        	$("#boton_login_cliente").addClass("btn-danger");
        	$("#boton_login_cliente").attr('disabled', 'disabled');
        }
	});
	
	$( ".input-login-agente" ).keyup(function() {
	  if ($("#correo_agente").val().length != 0 && $("#password_agente").val().length != 0) {
        	$("#icono-remove-agente").remove();
        	$("#boton_login_agente").html('Ingresar <i id="icono-ok-agente" class="glyphicon glyphicon-ok"></i>');
        	$("#boton_login_agente").removeClass("btn-danger");
        	$("#boton_login_agente").addClass("btn-primary");
            $("#boton_login_agente").removeAttr('disabled');
        }
        else{
        	$("#icono-ok-agente").remove();
        	$("#boton_login_agente").html('Ingrese sus datos <i id="icono-remove-agente" class="glyphicon glyphicon-remove"></i>');
        	$("#boton_login_agente").removeClass("btn-primary");
        	$("#boton_login_agente").addClass("btn-danger");
        	$("#boton_login_agente").attr('disabled', 'disabled');
        }
	});
</script>
<style>
.nav-tabs{
	border: none;
}
.nav-tabs>li {
  width: 50%;
  text-align: center;
}
.nav>li>a {
  padding: 10px 15px;
}

.panel-heading {
    padding: 0px 0px 0px 0px;
}

.panel-body{
	padding-top: 30px;
}
.panel-footer {
	padding: 1px 15px;
	color: #A0A0A0;
}

.profile-img {
	width: 96px;
	height: 96px;
	margin: 0 auto 10px;
	display: block;
	-moz-border-radius: 50%;
	-webkit-border-radius: 50%;
	border-radius: 50%;
}
</style>