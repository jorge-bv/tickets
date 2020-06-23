<?php 
$array_estados  = array(1,2,3);
//$solicitudes_activas = $this->clientes_model->traer_solicitudes($array_estados);
$array_estados  = array(4,5,6,7 );
//$solicitudes_cerradas = $this->clientes_model->traer_solicitudes($array_estados);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Hitch - Help desk</title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url() ?>assets/css/bootstrap.paper.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/css/sticky-footer-navbar.css" rel="stylesheet">
    
    <!-- Add custom CSS here -->
    <link href="<?php echo base_url() ?>assets/css/font-awesome/css/font-awesome.css" rel="stylesheet">
    <script src="<?php echo base_url() ?>assets/js/jquery-1.10.2.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/bootstrap.min.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
<body>
    <!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#" style="padding-top: 8px">
          	<img src="<?php echo base_url().'assets/images/logo_hitch_HD.png' ?>" />
          </a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav navbar-right">
              <li class="active"><a href="<?php echo base_url().'administracion'?>">Home</a></li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><b>Administrador: <?php echo $this->session->userdata('nombre')?></b><span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
               
               	<li><a href="<?php echo base_url().'administracion/cambiar_pass' ?>">Cambiar password</a></li>
                <li class="divider"></li>
           
                <li><a href="<?php echo base_url().'login/cerrar_sesion' ?>">Cerrar sesión</a></li>
              </ul>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
    <div id="contenedor" class="container" style="">
		<div class="row clearfix">
			<div class="col-md-3 column">
				<div class="text-center" style="padding-top: 30px; margin-bottom: 10px ">
					<p>&nbsp;</p>
					<img src="<?php echo base_url().'assets/images/logo_hitch.png' ?>" />
				</div>
				<div class="list-group">
					<a href="<?php echo base_url() ?>mantenedores/empresas/listar" id="empresas" class="list-group-item <?php echo MENU ?>">Empresas</a>
					<a href="<?php echo base_url() ?>mantenedores/productos/listar" id="productos" class="list-group-item">Productos</a>
					<a href="<?php echo base_url() ?>mantenedores/agentes/listar" id="fallas" class="list-group-item">Agentes</a>
					<a href="<?php echo base_url() ?>mantenedores/clientes/listar" id="usuarios" class="list-group-item">Clientes</a> 
                                        <a href="<?php echo base_url() ?>mantenedores/usuarios/listar" id="usuarios" class="list-group-item">Usuarios</a> 
				</div>
				<script>$("#<?php echo $menu?>").addClass('active');</script>
			</div>
			<div class="col-md-9 column">
				<div class="page-header">
			        <h3><?php echo $titulo ?></h3>
			      </div>
				<?php $this->load->view($main_content)?>
			</div>
		</div>
	</div>
    <footer class="footer">
      <div class="container">
        <p class="text-muted small">Diseñado y contruido por <a href="http://hitch.cl" target="_blank">Hitch integradores</a></p>
      </div>
    </footer>
    <script>
    	alto = $(window).height();
    	$("#contenedor").css('min-height',alto-65);
    	$("input").addClass('form-control');
    	$("select").addClass('form-control');
    	$("textarea").addClass('form-control');
    </script>
  </body>
</html>