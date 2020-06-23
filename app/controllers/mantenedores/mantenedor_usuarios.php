<?php

class Mantenedor_usuarios extends CI_Controller
{
    function  __construct()
    {
        parent::__construct();
		$this->load->model('mantenedores/mantenedor_usuarios_model');
		$this->load->model('mantenedores/mantenedor_general_model');
		
		$this->load->library('general_model');
		$this->load->helper('email');
                 $this->load->model('gestion_model');
            $this->load->model('administracion_model');
        			define("ADMIN_ID", validar_admin($this->session->userdata('token_admin')));
			define("EMPRESA_ID", validar_empresa(ADMIN_ID));
    }

	function index()
	{
            
         
		$this->usuarios_listar(); //inicio
	}

	function usuarios_crear()
	{
			$flag 	  = $this->input->post('flag');
		if($flag == 1)
        {
            $data   = $this->input->post('data');
			$password = genera_password();
			$data['password'] = sha1($password);
			$data['activo'] = TRUE;
			$id	 = $this->mantenedor_general_model->crear($data, 'hd_backoffices');
			$error = $this->db->_error_number();
			if($error == 1452)
			{
				$this->session->set_flashdata("mensaje_error", "No puede dejar en blanco la información de ");
				response.redirect('/mantenedores/usuarios/nuevo');	
			}
			else 
			{
				$info_correo['titulo']    = "Cuenta acceso Hitch Help Desk";
				$info_correo['contenido'] = "Estimado(a) ".$data['nombre']." se ha creado una cuenta de <b>administrador</b> para Hitch Help Desk<b> recuerde cambiar su contraseña al iniciar por primera vez</b> ";
				$info_correo['h3']        = 'Usuario: <b>'. $data['correo'].'</b> <br>Password: <b>'. $password.'</b>';
					
				$mail['mensaje']          = $this->load->view('shared/_correo_view',$info_correo,TRUE);
				$mail['asunto']  = 'Acceso sistema Ticket';
				$mail['para'] = $data['correo'];
                enviar_correo_sendgrid($mail);
				response.redirect('/mantenedores/usuarios/'.$id.'/ficha');	
			}
		}
		$data['button'] = array(
    					  'name'		 => 'continuar',
    					  'id' 		     => 'continuar',
    					  'value' 	     => 'Continuar',
    					  'class' 	     => 'btn btn-small btn-primary',
    					  'type' 	     => 'submit',
    					  'content' 	 => ' Continuar '
        );
		$data['nombre'] = array(
                          'name'        => 'data[nombre]',
                          'id'          => 'nombre',
                          'class'       => '',
                          'maxlength'   => '245',
                          'size'        => '',
                          'style'       => '',
		);
		$data['rut'] = array(
                          'name'        => 'data[rut]',
                          'id'          => 'rut',
                          'class'       => '',
                          'maxlength'   => '45',
                          'size'        => '',
                          'style'       => '',
		);
		$data['correo'] = array(
                          'name'        => 'data[correo]',
                          'id'          => 'correo',
                          'class'       => '',
                          'maxlength'   => '45',
                          'size'        => '',
                          'style'       => '',
		);
		$data['password'] = array(
                          'name'        => 'data[password]',
                          'id'          => 'password',
                          'class'       => '',
                          'maxlength'   => '145',
                          'size'        => '',
                          'style'       => '',
		);
		$data['telefono'] = array(
                          'name'        => 'data[telefono]',
                          'id'          => 'telefono',
                          'class'       => '',
                          'maxlength'   => '45',
                          'size'        => '',
                          'style'       => '',
		);
		$data['activo'] = array(
                          'name'        => 'data[activo]',
                          'id'          => 'activo',
                          'class'       => '',
                          'maxlength'   => '1',
                          'size'        => '',
                          'style'       => '',
		);
		$data['remember_token'] = array(
                          'name'        => 'data[remember_token]',
                          'id'          => 'remember_token',
                          'class'       => '',
                          'maxlength'   => '245',
                          'size'        => '',
                          'style'       => '',
		);
		
		$data['form_open']     = array(
							                'class' => 'form_usuarios',
							                'id'    => 'form_usuarios'
        );
		//$data['in']   			    = 'in';
		$data['current_agentes'] 	    = 'current';
		$data['hidden'] 			    = array('flag' => 1);
        $data['title'] 			    = 'Mantenedor usuarios - Crear';
		$data['breadcrumb'] 			= 'Crear usuarios';
		$data["mensaje_error"]    	    = $this->session->flashdata("mensaje_error");
	    $data['main_content']		    = 'mantenedores/mantenedor_usuarios_crear_view';
		$this->load->view('shared/layout_administracion', $data);
	}
	
	function usuarios_editar($usuarios_id)
	{	$flag 	  = $this->input->post('flag');
		if($flag == 1)
        {
            $data        = $this->input->post('data');
			$id = $this->mantenedor_general_model->actualizar($data['id'], $data, 'hd_backoffices','id');
			$error = $this->db->_error_number();
			if($error == 1452)
			{
				$this->session->set_flashdata("mensaje_error", "No puede dejar en blanco la información de ");
				response.redirect('/mantenedores/usuarios/'.$data['id'].'/editar');
			}
			else
			{
				response.redirect('/mantenedores/usuarios/'.$data['id'].'/ficha');
			}
			
		}
		$data['button'] = array(
    					  'name'		 => 'continuar',
    					  'id' 		     => 'continuar',
    					  'value' 	     => 'Continuar',
    					  'class' 	     => 'btn btn-small btn-primary',
    					  'type' 	     => 'submit',
    					  'content' 	 => ' Continuar '
        );
		$data['nombre'] = array(
                          'name'        => 'data[nombre]',
                          'id'          => 'nombre',
                          'class'       => '',
                          'maxlength'   => '245',
                          'size'        => '',
                          'style'       => '',
		);
		$data['rut'] = array(
                          'name'        => 'data[rut]',
                          'id'          => 'rut',
                          'class'       => '',
                          'maxlength'   => '45',
                          'size'        => '',
                          'style'       => '',
		);
		$data['correo'] = array(
                          'name'        => 'data[correo]',
                          'id'          => 'correo',
                          'class'       => '',
                          'maxlength'   => '45',
                          'size'        => '',
                          'style'       => '',
		);
		$data['password'] = array(
                          'name'        => 'data[password]',
                          'id'          => 'password',
                          'class'       => '',
                          'maxlength'   => '145',
                          'size'        => '',
                          'style'       => '',
		);
		$data['telefono'] = array(
                          'name'        => 'data[telefono]',
                          'id'          => 'telefono',
                          'class'       => '',
                          'maxlength'   => '45',
                          'size'        => '',
                          'style'       => '',
		);
		$data['activo'] = array(
                          'name'        => 'data[activo]',
                          'id'          => 'activo',
                          'class'       => '',
                          'maxlength'   => '1',
                          'size'        => '',
                          'style'       => '',
		);
		$data['remember_token'] = array(
                          'name'        => 'data[remember_token]',
                          'id'          => 'remember_token',
                          'class'       => '',
                          'maxlength'   => '245',
                          'size'        => '',
                          'style'       => '',
		);
		
		$data['ficha']    	 = $this->mantenedor_general_model->traer_ficha($usuarios_id, 'hd_backoffices','id');
		
		$data['form_open']     = array(
							                'class' => 'form_usuarios',
							                'id'    => 'form_usuarios'
        );
		$data['hidden'] 	   = array(
											'flag'     => 1,
										    'data[id]' => $usuarios_id
		
		);
		//$data['in']   			                = 'in';
		$data['current_agentes'] 	= 'current';
		$data["mensaje_error"]    	 				= $this->session->flashdata("mensaje_error");
		$data['title'] 			 				= 'Mantenedor usuarios - Editar';
		$data['breadcrumb'] 			            = 'Editar usuarios';
	    $data['main_content']		 				= 'mantenedores/mantenedor_usuarios_editar_view';
		$this->load->view('shared/layout_administracion', $data);
	}
	
	function usuarios_ficha($usuarios_id)
	{
		$data['button'] = array(
    					  'name'		 => 'continuar',
    					  'id' 		     => 'continuar',
    					  'value' 	     => 'Continuar',
    					  'class' 	     => 'btn btn-small btn-primary',
    					  'type' 	     => 'submit',
    					  'content' 	 => ' Continuar '
        );
		$data['nombre'] = array(
                          'name'        => 'data[nombre]',
                          'id'          => 'nombre',
                          'class'       => '',
                          'maxlength'   => '145',
                          'size'        => '',
                          'style'       => '',
		);
		$data['correo'] = array(
                          'name'        => 'data[correo]',
                          'id'          => 'correo',
                          'class'       => '',
                          'maxlength'   => '145',
                          'size'        => '',
                          'style'       => '',
		);
		$data['telefono'] = array(
                          'name'        => 'data[telefono]',
                          'id'          => 'telefono',
                          'class'       => '',
                          'maxlength'   => '145',
                          'size'        => '',
                          'style'       => '',
		);
		$data['rut'] = array(
                          'name'        => 'data[rut]',
                          'id'          => 'rut',
                          'class'       => '',
                          'maxlength'   => '255',
                          'size'        => '',
                          'style'       => '',
		);
		
		
		
		$data['ficha']    	 = $this->mantenedor_general_model->traer_ficha($usuarios_id, 'hd_backoffices', 'id');
	
		$data['form_open']     = array(
							                'class' => 'form_usuarios',
							                'id'    => 'form_usuarios'
        );
		$data['hidden'] 	   = array(
											'flag'     => 1,
										    'data[id]' => $usuarios_id
		);
		$data['current_usuarios'] 	= 'current';
		$data["mensaje_error"]    	 = $this->session->flashdata("mensaje_error");
		$data['title'] 			 = 'Mantenedor Usuarios - Ficha';
		$data['breadcrumb'] 		 = 'Ficha Usuarios';
	    $data['main_content']		 = 'mantenedores/mantenedor_usuarios_ficha_view';
		$this->load->view('shared/layout_administracion', $data);
	}

	function usuarios_listar()
	{
		$data['buscar'] = array(
                          'name'        => 'buscar',
                          'id'          => 'buscar',
                          'maxlength'   => '145',
                          'size'        => '50',
		);
		$data['form_open']     = array(
							                'class' => 'form_agentes',
							                'id'    => 'form_agentes'
        );
		$data['ficha']         = $this->mantenedor_general_model->traer_todo('hd_backoffices');

		foreach($data['ficha'] as $key => $value)
		{
			
		}
		$data['in']   			                = 'in';
		$data['current_agentes'] 	= 'current';
		$data['hidden'] 	         = array('flag'     => 1);
		$data["mensaje_error"]    	 = $this->session->flashdata("mensaje_error");
		$data['title'] 			 = 'Mantenedor Usuarios - Listar';
		$data['breadcrumb'] 		 = 'Listar Usuarios';
	    $data['main_content']		 = 'mantenedores/mantenedor_usuarios_listar_view';
        $this->load->view('shared/layout_administracion', $data);}

	function eliminar_usuarios($usuarios_id)
	{
	
		$this->mantenedor_general_model->eliminar($usuarios_id, 'hd_backoffices', 'id');
		$error = $this->db->_error_number();
		if($error == 1451)
		{
			$this->session->set_flashdata("mensaje_error", "No se puede eliminar, hay referencias a este registro");
		}
		response.redirect('/mantenedores/usuarios/listar');
	}
} 
