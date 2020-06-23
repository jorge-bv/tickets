<div class="container" style="margin-top:40px">
	<div class="row">
		<div class="col-sm-6 col-md-4 col-md-offset-4 col-xs-6 col-xs-offset-3">
			<div class="panel panel-default">
				<div class="panel-body tab-content">
					<div role="tabpanel" class="tab-pane fade active in" id="home" aria-labelledby="home-tab">
						<?php echo form_open('', 'id="form" role="form"',array('flag'=> TRUE))?>
							<fieldset>
								<div class="row">
									<div class="center-block text-center" style="font-size: 40px">
										<h3>Acceso Admin</h3>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-12 col-md-10  col-md-offset-1 ">
										<div class="form-group">
											<div class="input-group">
												<span class="input-group-addon">
													<i class="glyphicon glyphicon-user"></i>
												</span> 
												<input class="form-control input-login-admin" id="correo_admin" placeholder="Correo" name="admin[correo]" type="text" autofocus>
											</div>
										</div>
										<div class="form-group">
											<div class="input-group">
												<span class="input-group-addon">
													<i class="glyphicon glyphicon-lock"></i>
												</span>
												<input class="form-control input-login-admin" placeholder="Password" id="password_admin"  name="admin[password]" type="password" value="">
											</div>
										</div>
										<div class="form-group">
											<button class="btn btn-primary btn-block btn-lg">Ingresar</button>
										</div>
									</div>
								</div>
                                                            <div class="panel-footer ">
                                    <a href="<?php echo base_url().'login/recupera_contrasena_admin' ?>"><b>Recuperar password</b></a>
				</div>
							</fieldset>
						 <?php echo form_close()?>
					</div>
				</div>
				
            </div>
		</div>
	</div>
</div>
<script>
	
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