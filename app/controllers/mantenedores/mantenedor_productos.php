<?php
 //<strong><u>Controlador</u></strong><br />

 
class Mantenedor_productos extends CI_Controller
{
    function  __construct()
    {
        parent::__construct();
		$this->load->model('mantenedores/mantenedor_productos_model');
		$this->load->model('mantenedores/mantenedor_general_model');
		
                 $this->load->model('gestion_model');
            $this->load->model('administracion_model');
            $this->load->library('session');
			$this->load->library('general_model');
			define("ADMIN_ID", validar_admin($this->session->userdata('token_admin')));
			define("EMPRESA_ID", validar_empresa(ADMIN_ID));
    }

	function index()
	{
		$this->productos_listar(); //inicio
	}

	function productos_crear()
	{
		$flag 	  = $this->input->post('flag');
		if($flag == 1)
        {
            $data   = $this->input->post('data');
			$id	 = $this->mantenedor_general_model->crear($data, 'hd_productos');
			$error = $this->db->_error_number();
			if($error == 1452)
			{
				$this->session->set_flashdata("mensaje_error", "No puede dejar en blanco la información de ");
				response.redirect('/mantenedores/productos/nuevo');	
			}
			else 
			{
				response.redirect('/mantenedores/productos/'.$id.'/ficha');	
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
                          'maxlength'   => '145',
                          'size'        => '',
                          'style'       => '',
		);
		
		$data['form_open']     = array(
							                'class' => 'form_productos',
							                'id'    => 'form_productos'
        );
		//$data['in']   			    = 'in';
		$data['current_productos'] 	    = 'current';
		$data['hidden'] 			    = array('flag' => 1);
        $data['title'] 			    = 'Mantenedor Productos - Crear';
		$data['breadcrumb'] 			= 'Crear Productos';
		$data["mensaje_error"]    	    = $this->session->flashdata("mensaje_error");
	    $data['main_content']		    = 'mantenedores/mantenedor_productos_crear_view';
		$this->load->view('shared/layout_administracion', $data);
	}
	
	function productos_editar($productos_id)
	{
		$flag 	  = $this->input->post('flag');
		if($flag == 1)
        {
            $data        = $this->input->post('data');
			$id = $this->mantenedor_general_model->actualizar($data['id'], $data, 'hd_productos','id');
			$error = $this->db->_error_number();
			if($error == 1452)
			{
				$this->session->set_flashdata("mensaje_error", "No puede dejar en blanco la información de ");
				response.redirect('/mantenedores/productos/'.$data['id'].'/editar');
			}
			else
			{
				response.redirect('/mantenedores/productos/'.$data['id'].'/ficha');
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
                          'maxlength'   => '145',
                          'size'        => '',
                          'style'       => '',
		);
		
		$data['ficha']    	 = $this->mantenedor_general_model->traer_ficha($productos_id, 'hd_productos','id');
		
		$data['form_open']     = array(
							                'class' => 'form_productos',
							                'id'    => 'form_productos'
        );
		$data['hidden'] 	   = array(
											'flag'     => 1,
										    'data[id]' => $productos_id
		
		);
		//$data['in']   			                = 'in';
		$data['current_productos'] 	= 'current';
		$data["mensaje_error"]    	 				= $this->session->flashdata("mensaje_error");
		$data['title'] 			 				= 'Mantenedor Productos - Editar';
		$data['breadcrumb'] 			            = 'Editar Productos';
	    $data['main_content']		 				= 'mantenedores/mantenedor_productos_editar_view';
		$this->load->view('shared/layout_administracion', $data);
	}
	
	function productos_ficha($productos_id)
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
		
		$data['ficha']    	 = $this->mantenedor_general_model->traer_ficha($productos_id, 'hd_productos', 'id');
		
		$data['form_open']     = array(
							                'class' => 'form_productos',
							                'id'    => 'form_productos'
        );
		$data['hidden'] 	   = array(
											'flag'     => 1,
										    'data[id]' => $productos_id
		
		);
		//$data['in']   			                = 'in';
		$data['current_productos'] 	= 'current';
		$data["mensaje_error"]    	 = $this->session->flashdata("mensaje_error");
		$data['title'] 			 = 'Mantenedor Productos - Ficha';
		$data['breadcrumb'] 		 = 'Ficha Productos';
	    $data['main_content']		 = 'mantenedores/mantenedor_productos_ficha_view';
		$this->load->view('shared/layout_administracion', $data);
	}

	function productos_listar()
	{
		$data['buscar'] = array(
                          'name'        => 'buscar',
                          'id'          => 'buscar',
                          'maxlength'   => '145',
                          'size'        => '50',
		);
		$data['form_open']     = array(
							                'class' => 'form_productos',
							                'id'    => 'form_productos'
        );
		$data['ficha']         = $this->mantenedor_general_model->traer_todo('hd_productos');

		foreach($data['ficha'] as $key => $value)
		{
			
		}
		$data['in']   			                = 'in';
		$data['current_productos'] 	= 'current';
		$data['hidden'] 	         = array('flag'     => 1);
		$data["mensaje_error"]    	 = $this->session->flashdata("mensaje_error");
		$data['title'] 			 = 'Mantenedor Productos - Listar';
		$data['breadcrumb'] 		 = 'Listar Productos';
	    $data['main_content']		 = 'mantenedores/mantenedor_productos_listar_view';
		$this->load->view('shared/layout_administracion', $data);
	}

	function eliminar_productos($productos_id)
	{
		$this->mantenedor_general_model->eliminar($productos_id, 'hd_productos', 'id');
		$error = $this->db->_error_number();
		if($error == 1451)
		{
			$this->session->set_flashdata("mensaje_error", "No se puede eliminar, hay referencias a este registro");
		}
		response.redirect('/mantenedores/productos/listar');
	}
} 
