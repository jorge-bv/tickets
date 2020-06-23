<?php

class Mantenedor_empresas extends CI_Controller
{
    function  __construct()
    {
        parent::__construct();
		$this->load->model('mantenedores/mantenedor_empresas_model');
		$this->load->model('mantenedores/mantenedor_general_model');
		$this->load->library('session');
		$this->load->library('general_model');
		define("ADMIN_ID", validar_admin($this->session->userdata('token_admin')));
		define("EMPRESA_ID", validar_empresa(ADMIN_ID));
    }

	function index()
	{
		$this->empresas_listar(); //inicio
	}

	function empresas_crear()
	{
		$flag 	  = $this->input->post('flag');
		if($flag == 1)
        {
            $data   = $this->input->post('data');
			$id	 = $this->mantenedor_general_model->crear($data, 'empresas');
			$error = $this->db->_error_number();
			if($error == 1452)
			{
				$this->session->set_flashdata("mensaje_error", "No puede dejar en blanco la información de ");
				response.redirect('/mantenedores/empresas/nuevo');	
			}
			else 
			{
				   
      if (!empty($_FILES['imagen']['name'])) {
                $ruta_carpeta = 'logos/';
                $nombre_foto = crear_nombre_imagen($_FILES['imagen']['name']);
                $ruta_contenido = $ruta_carpeta . $nombre_foto;
                if (copy($_FILES['imagen']['tmp_name'], $ruta_contenido)) {
                    $this->general_model->update_row('empresas', array('logo' => $nombre_foto), $id);
                }
            }
        
				
				$productos = $this->input->post('productos');
				$insert['empresas_id'] = $id;
				foreach ($productos as $value) 
				{
					$insert['productos_id'] = $value;
					$this->general_model->insert('productos_empresas', $insert);
				}
				response.redirect('/mantenedores/empresas/'.$id.'/ficha');	
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
                          'maxlength'   => '45',
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
		
		$data['form_open']     = array(
							                'class' => 'form_empresas',
							                'id'    => 'form_empresas'
        );
		//$data['in']   			    = 'in';
		$data['productos']			    = $this->general_model->get_table('productos');
		$data['current_empresas'] 	    = 'current';
		$data['hidden'] 			    = array('flag' => 1);
        $data['title'] 			    = 'Mantenedor Empresas - Crear';
		$data['breadcrumb'] 			= 'Crear Empresas';
		$data["mensaje_error"]    	    = $this->session->flashdata("mensaje_error");
	    $data['main_content']		    = 'mantenedores/mantenedor_empresas_crear_view';
		$this->load->view('shared/layout_administracion', $data);
	}
	
	function empresas_editar($empresas_id)
	{
		$flag 	  = $this->input->post('flag');
		if($flag == 1)
        {
            $data        = $this->input->post('data');
			$id = $this->mantenedor_general_model->actualizar($data['id'], $data, 'empresas','id');
			$error = $this->db->_error_number();
			if($error == 1452)
			{
				$this->session->set_flashdata("mensaje_error", "No puede dejar en blanco la información de ");
				response.redirect('/mantenedores/empresas/'.$data['id'].'/editar');
			}
			else
			{
                            		if (!empty($_FILES['imagen']['name'])) {
                $ruta_carpeta = 'logos/';
                $nombre_foto = crear_nombre_imagen($_FILES['imagen']['name']);
                $ruta_contenido = $ruta_carpeta . $nombre_foto;
                if (copy($_FILES['imagen']['tmp_name'], $ruta_contenido)) {
                    $this->general_model->update_row('empresas', array('logo' => $nombre_foto), $empresas_id);
                }
            }
		
				$this->general_model->delete_row_by_where('productos_empresas', array('empresas_id'=>$data['id']));
				$productos = $this->input->post('productos');
				$insert['empresas_id'] = $data['id'];
				foreach ($productos as $value) 
				{
					$insert['productos_id'] = $value;
					$this->general_model->insert('productos_empresas', $insert);
				}
				response.redirect('/mantenedores/empresas/'.$data['id'].'/ficha');
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
                          'maxlength'   => '45',
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
		
		$data['ficha']    	 = $this->mantenedor_general_model->traer_ficha($empresas_id, 'empresas','id');
		
		$data['form_open']     = array(
							                'class' => 'form_empresas',
							                'id'    => 'form_empresas'
        );
		$data['hidden'] 	   = array(
											'flag'     => 1,
										    'data[id]' => $empresas_id
		
		);
		$data['productos']			    = $this->general_model->get_table('productos');
		$data['productos_empresa']      = $this->general_model->get_result_by_where('productos_empresas', array('empresas_id'=> $empresas_id));
		$data['current_empresas'] 	= 'current';
		$data["mensaje_error"]    	 				= $this->session->flashdata("mensaje_error");
		$data['title'] 			 				= 'Mantenedor Empresas - Editar';
		$data['breadcrumb'] 			            = 'Editar Empresas';
	    $data['main_content']		 				= 'mantenedores/mantenedor_empresas_editar_view';
		$this->load->view('shared/layout_administracion', $data);
	}
	
	function empresas_ficha($empresas_id)
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
                          'maxlength'   => '45',
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
		
		$data['ficha']    	 = $this->mantenedor_general_model->traer_ficha($empresas_id, 'empresas', 'id');
		
		$data['form_open']     = array(
							                'class' => 'form_empresas',
							                'id'    => 'form_empresas'
        );
		$data['hidden'] 	   = array(
											'flag'     => 1,
										    'data[id]' => $empresas_id
		
		);

		$data['productos']			    = $this->general_model->get_table('productos');
		$data['productos_empresa']      = $this->general_model->get_result_by_where('productos_empresas', array('empresas_id'=> $empresas_id));
		$data['current_empresas'] 	= 'current';
		$data["mensaje_error"]    	 = $this->session->flashdata("mensaje_error");
		$data['title'] 			 = 'Mantenedor Empresas - Ficha';
		$data['breadcrumb'] 		 = 'Ficha Empresas';
	    $data['main_content']		 = 'mantenedores/mantenedor_empresas_ficha_view';
		$this->load->view('shared/layout_administracion', $data);
	}

	function empresas_listar()
	{
		$data['buscar'] = array(
                          'name'        => 'buscar',
                          'id'          => 'buscar',
                          'maxlength'   => '145',
                          'size'        => '50',
		);
		$data['form_open']     = array(
							                'class' => 'form_empresas',
							                'id'    => 'form_empresas'
        );
		$data['ficha']         = $this->mantenedor_general_model->traer_todo('empresas');

		foreach($data['ficha'] as $key => $value)
		{
			
		}
		$data['in']   			                = 'in';
		$data['current_empresas'] 	= 'current';
		$data['hidden'] 	         = array('flag'     => 1);
		$data["mensaje_error"]    	 = $this->session->flashdata("mensaje_error");
		$data['title'] 			 = 'Mantenedor Empresas - Listar';
		$data['breadcrumb'] 		 = 'Listar Empresas';
	    $data['main_content']		 = 'mantenedores/mantenedor_empresas_listar_view';
		$this->load->view('shared/layout_administracion', $data);
	}

	function eliminar_empresas($empresas_id)
	{
		$this->mantenedor_general_model->eliminar($empresas_id, 'empresas', 'id');
		$error = $this->db->_error_number();
		if($error == 1451)
		{
			$this->session->set_flashdata("mensaje_error", "No se puede eliminar, hay referencias a este registro");
		}
		response.redirect('/mantenedores/empresas/listar');
	}
        
	
} 
