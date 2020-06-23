<?php
 //<strong><u>Controlador</u></strong><br />

 
class Mantenedor_agentes extends CI_Controller
{
    function  __construct()
    {
        parent::__construct();
		$this->load->model('mantenedores/mantenedor_agentes_model');
		$this->load->model('mantenedores/mantenedor_general_model');
		$this->load->library('general_model');
		$this->load->helper('email'); 
            $this->load->model('administracion_model');
            $this->load->library('session');
			$this->load->library('general_model');
                        define("ADMIN_ID", validar_admin($this->session->userdata('token_admin')));
			define("EMPRESA_ID", validar_empresa(ADMIN_ID));
			
    }

	function index()
	{
		$this->agentes_listar(); //inicio
	}

	function agentes_crear()
	{
		$flag 	  = $this->input->post('flag');
		if($flag == 1)
        {
            $data   = $this->input->post('data');
			$password = genera_password();
			$data['password'] = sha1($password);
			$data['activo'] = TRUE;
			$id	 = $this->mantenedor_general_model->crear($data, 'hd_agentes');
			$error = $this->db->_error_number();
			if($error == 1452)
			{
				$this->session->set_flashdata("mensaje_error", "No puede dejar en blanco la información de ");
				response.redirect('/mantenedores/agentes/nuevo');	
			}
			else 
			{
				$info_correo['titulo']    = "Cuenta acceso Hitch Help Desk";
				$info_correo['contenido'] = "Estimado(a) ".$data['nombre']." se ha creado una cuenta de <b>Agente de Gestión</b> para Hitch Help Desk<b> recuerde cambiar su contraseña al iniciar por primera vez</b> ";
				$info_correo['h3']        = 'Usuario: <b>'. $data['correo'].'</b> <br>Password: <b>'. $password.'</b>';
					
				$mail['mensaje']          = $this->load->view('shared/_correo_view',$info_correo,TRUE);
				$mail['asunto']  = 'Acceso sistema Ticket';
				$mail['para'] = $data['correo'];
                enviar_correo_sendgrid($mail);
				response.redirect('/mantenedores/agentes/'.$id.'/ficha');	
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
							                'class' => 'form_agentes',
							                'id'    => 'form_agentes'
        );
		//$data['in']   			    = 'in';
		$data['current_agentes'] 	    = 'current';
		$data['hidden'] 			    = array('flag' => 1);
        $data['title'] 			    = 'Mantenedor Agentes - Crear';
		$data['breadcrumb'] 			= 'Crear Agentes';
		$data["mensaje_error"]    	    = $this->session->flashdata("mensaje_error");
	    $data['main_content']		    = 'mantenedores/mantenedor_agentes_crear_view';
		$this->load->view('shared/layout_administracion', $data);
	}
	
	function agentes_editar($agentes_id)
	{
		$flag 	  = $this->input->post('flag');
		if($flag == 1)
        {
            $data        = $this->input->post('data');
			$id = $this->mantenedor_general_model->actualizar($data['id'], $data, 'hd_agentes','id');
			$error = $this->db->_error_number();
			if($error == 1452)
			{
				$this->session->set_flashdata("mensaje_error", "No puede dejar en blanco la información de ");
				response.redirect('/mantenedores/agentes/'.$data['id'].'/editar');
			}
			else
			{
				response.redirect('/mantenedores/agentes/'.$data['id'].'/ficha');
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
		
		$data['ficha']    	 = $this->mantenedor_general_model->traer_ficha($agentes_id, 'hd_agentes','id');
		
		$data['form_open']     = array(
							                'class' => 'form_agentes',
							                'id'    => 'form_agentes'
        );
		$data['hidden'] 	   = array(
											'flag'     => 1,
										    'data[id]' => $agentes_id
		
		);
		//$data['in']   			                = 'in';
		$data['current_agentes'] 	= 'current';
		$data["mensaje_error"]    	 				= $this->session->flashdata("mensaje_error");
		$data['title'] 			 				= 'Mantenedor Agentes - Editar';
		$data['breadcrumb'] 			            = 'Editar Agentes';
	    $data['main_content']		 				= 'mantenedores/mantenedor_agentes_editar_view';
		$this->load->view('shared/layout_administracion', $data);
	}
	
	function agentes_ficha($agentes_id)
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
		
		$data['ficha']    	 = $this->mantenedor_general_model->traer_ficha($agentes_id, 'hd_agentes', 'id');
		
		$data['form_open']     = array(
							                'class' => 'form_agentes',
							                'id'    => 'form_agentes'
        );
		$data['hidden'] 	   = array(
											'flag'     => 1,
										    'data[id]' => $agentes_id
		
		);
		//$data['in']   			                = 'in';
		$data['current_agentes'] 	= 'current';
		$data["mensaje_error"]    	 = $this->session->flashdata("mensaje_error");
		$data['title'] 			 = 'Mantenedor Agentes - Ficha';
		$data['breadcrumb'] 		 = 'Ficha Agentes';
	    $data['main_content']		 = 'mantenedores/mantenedor_agentes_ficha_view';
		$this->load->view('shared/layout_administracion', $data);
	}

	function agentes_listar()
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
		$data['ficha']         = $this->mantenedor_general_model->traer_todo('hd_agentes');

		foreach($data['ficha'] as $key => $value)
		{
			
		}
		$data['in']   			                = 'in';
		$data['current_agentes'] 	= 'current';
		$data['hidden'] 	         = array('flag'     => 1);
		$data["mensaje_error"]    	 = $this->session->flashdata("mensaje_error");
		$data['title'] 			 = 'Mantenedor Agentes - Listar';
		$data['breadcrumb'] 		 = 'Listar Agentes';
	    $data['main_content']		 = 'mantenedores/mantenedor_agentes_listar_view';
		$this->load->view('shared/layout_administracion', $data);
	}

	function eliminar_agentes($agentes_id)
	{
		$this->mantenedor_general_model->eliminar($agentes_id, 'hd_agentes', 'id');
		$error = $this->db->_error_number();
		if($error == 1451)
		{
			$this->session->set_flashdata("mensaje_error", "No se puede eliminar, hay referencias a este registro");
		}
		response.redirect('/mantenedores/agentes/listar');
	}
} 
