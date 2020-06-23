<?php
 //<strong><u>Controlador</u></strong><br />

 
class Mantenedor_clientes extends CI_Controller
{
    function  __construct()
    {
        parent::__construct();
		$this->load->model('mantenedores/mantenedor_clientes_model');
		$this->load->model('mantenedores/mantenedor_general_model');
		
		$this->load->library('general_model');
		$this->load->helper('email');
                 $this->load->model('gestion_model');
            $this->load->model('administracion_model');
            $this->load->library('session');
			$this->load->library('general_model');
			define("ADMIN_ID", validar_admin($this->session->userdata('token_admin')));
			define("EMPRESA_ID", validar_empresa(ADMIN_ID));
    }

	function index()
	{
		$this->clientes_listar(); //inicio
	}

	function clientes_crear()
	{
		$flag 	  = $this->input->post('flag');
		if($flag == 1)
        {
        	//error_reporting(E_ALL);
            $data   = $this->input->post('data');
			$password = genera_password();
			$data['password'] = sha1($password);
			$data['activo'] = TRUE;
			$id	 = $this->mantenedor_general_model->crear($data, 'hd_clientes');
			$error = $this->db->_error_number();
			if($error == 1452)
			{
				$this->session->set_flashdata("mensaje_error", "No puede dejar en blanco la información de empresas");
				response.redirect('/mantenedores/clientes/nuevo');	
			}
			else 
			{
				$info_correo['titulo']    = "Cuenta acceso Hitch Help Desk";
				$info_correo['contenido'] = "Estimado(a) ".$data['nombre']." se ha creado una cuenta de <b>Cliente</b> para Hitch Help Desk <br/><b> recuerde cambiar su contraseña al iniciar por primera vez</b><br/>Sus datos de accesos son lo siguientes:";
				$info_correo['h3']        = 'Usuario: <b>'. $data['correo'].'</b> <br>Password: <b>'. $password.'</b>';

				$mail['mensaje']          = $this->load->view('shared/_correo_view',$info_correo,TRUE);
				$mail['asunto']  = 'Acceso sistema Ticket';
				$mail['para'] = $data['correo'];
                enviar_correo_sendgrid($mail);
                $data['mensaje'] = 'Mensaje correcto';
				
				response.redirect('/mantenedores/clientes/'.$id.'/ficha');	
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
		$data['hd_empresas_nombre'] = prepara_dropdown($this->mantenedor_general_model->traer_tabla('hd_empresas', 'id' ), 'id');
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
               
                $data['tipo'] = array(
                          'name'        => 'data[tipo]',
                          'id'          => 'tipo',
                          'class'       => '',
                          'maxlength'   => '245',
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
							                'class' => 'form_clientes',
							                'id'    => 'form_clientes'
        );
		//$data['in']   			    = 'in';
		$data['current_clientes'] 	    = 'current';
		$data['hidden'] 			    = array('flag' => 1);
        $data['title'] 			    = 'Mantenedor Clientes - Crear';
		$data['breadcrumb'] 			= 'Crear Clientes';
		$data["mensaje_error"]    	    = $this->session->flashdata("mensaje_error");
	    $data['main_content']		    = 'mantenedores/mantenedor_clientes_crear_view';
		$this->load->view('shared/layout_administracion', $data);
	}
	
	function clientes_editar($clientes_id)
	{
		$flag 	  = $this->input->post('flag');
		if($flag == 1)
        {
            $data        = $this->input->post('data');
			$id = $this->mantenedor_general_model->actualizar($data['id'], $data, 'hd_clientes','id');
			$error = $this->db->_error_number();
			if($error == 1452)
			{
				$this->session->set_flashdata("mensaje_error", "No puede dejar en blanco la información de empresas");
				response.redirect('/mantenedores/clientes/'.$data['id'].'/editar');
			}
			else
			{
				response.redirect('/mantenedores/clientes/'.$data['id'].'/ficha');
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
		$data['hd_empresas_nombre'] = prepara_dropdown($this->mantenedor_general_model->traer_tabla('hd_empresas', 'id' ), 'id');
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
		
		$data['ficha']    	 = $this->mantenedor_general_model->traer_ficha($clientes_id, 'hd_clientes','id');
		
		$data['form_open']     = array(
							                'class' => 'form_clientes',
							                'id'    => 'form_clientes'
        );
		$data['hidden'] 	   = array(
											'flag'     => 1,
										    'data[id]' => $clientes_id
		
		);
		//$data['in']   			                = 'in';
		$data['current_clientes'] 	= 'current';
		$data["mensaje_error"]    	 				= $this->session->flashdata("mensaje_error");
		$data['title'] 			 				= 'Mantenedor Clientes - Editar';
		$data['breadcrumb'] 			            = 'Editar Clientes';
	    $data['main_content']		 				= 'mantenedores/mantenedor_clientes_editar_view';
		$this->load->view('shared/layout_administracion', $data);
	}
	
	function clientes_ficha($clientes_id)
	{
		$data['button'] = array(
    					  'name'		 => 'continuar',
    					  'id' 		     => 'continuar',
    					  'value' 	     => 'Continuar',
    					  'class' 	     => 'btn btn-small btn-primary',
    					  'type' 	     => 'submit',
    					  'content' 	 => ' Continuar '
        );
		$data['hd_empresas_nombre'] = prepara_dropdown($this->mantenedor_general_model->traer_tabla('hd_empresas', 'id' ), 'id');
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
		
		$data['ficha']    	 = $this->mantenedor_general_model->traer_ficha($clientes_id, 'hd_clientes', 'id');
		
			$data['ficha']->hd_empresas_nombre = $this->mantenedor_general_model->traer_nombre($data['ficha']->empresas_id, 'hd_empresas', 'id');
		
		$data['form_open']     = array(
							                'class' => 'form_clientes',
							                'id'    => 'form_clientes'
        );
		$data['hidden'] 	   = array(
											'flag'     => 1,
										    'data[id]' => $clientes_id
		
		);
		//$data['in']   			                = 'in';
		$data['current_clientes'] 	= 'current';
		$data["mensaje_error"]    	 = $this->session->flashdata("mensaje_error");
		$data['title'] 			 = 'Mantenedor Clientes - Ficha';
		$data['breadcrumb'] 		 = 'Ficha Clientes';
	    $data['main_content']		 = 'mantenedores/mantenedor_clientes_ficha_view';
		$this->load->view('shared/layout_administracion', $data);
	}

	function clientes_listar()
	{
		$data['buscar'] = array(
                          'name'        => 'buscar',
                          'id'          => 'buscar',
                          'maxlength'   => '145',
                          'size'        => '50',
		);
		$data['form_open']     = array(
							                'class' => 'form_clientes',
							                'id'    => 'form_clientes'
        );
		$data['ficha']         = $this->mantenedor_general_model->traer_todo('hd_clientes');

		foreach($data['ficha'] as $key => $value)
		{
			
			$data['ficha'][$key]->hd_empresas_nombre = $this->mantenedor_general_model->traer_nombre($value->empresas_id, 'hd_empresas', 'id');
		
		}
		$data['in']   			                = 'in';
		$data['current_clientes'] 	= 'current';
		$data['hidden'] 	         = array('flag'     => 1);
		$data["mensaje_error"]    	 = $this->session->flashdata("mensaje_error");
		$data['title'] 			 = 'Mantenedor Clientes - Listar';
		$data['breadcrumb'] 		 = 'Listar Clientes';
	    $data['main_content']		 = 'mantenedores/mantenedor_clientes_listar_view';
		$this->load->view('shared/layout_administracion', $data);
	}

	function eliminar_clientes($clientes_id)
	{
		$this->mantenedor_general_model->eliminar($clientes_id, 'hd_clientes', 'id');
		$error = $this->db->_error_number();
		if($error == 1451)
		{
			$this->session->set_flashdata("mensaje_error", "No se puede eliminar, hay referencias a este registro");
		}
		response.redirect('/mantenedores/clientes/listar');
	}
} 
