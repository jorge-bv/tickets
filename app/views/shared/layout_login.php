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
  	<div class="">
  		<?php $this->load->view($main_content)?>
  		<div class="text-center" style="margin-top: 40px">
  			<!-- <img src="<?php echo base_url().'assets/images/logo_hitch_HD.png' ?>" /> -->
  		</div>
  		
  	</div>
    	
  </body>
</html>