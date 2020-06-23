<?php
    class Administracion extends CI_Controller
    {
        function  __construct()
        {
            parent::__construct();
            $this->load->model('gestion_model');
            $this->load->model('administracion_model');
            $this->load->library('session');
			$this->load->library('general_model');
			define("ADMIN_ID", validar_admin($this->session->userdata('token_admin')));
			define("EMPRESA_ID", validar_empresa(ADMIN_ID));
        }
        
        function index()
        {
        	//error_reporting(E_ALL);
$data['titulo']  ="<center><b> Bienvenido " .  $this->session->userdata('nombre');"</b></center>";
            $data['hidden']       = array('flag' => 1);
            $data['main_content'] = 'administracion/dashboard_view';
            $this->load->view('shared/layout_administracion', $data);
        }
        
        function solicitudes()
        {
			$data['titulo']       = "Dashboard";
            $data['hidden']       = array('flag' => 1);
            $data['main_content'] = 'administracion/dashboard';
            $this->load->view('shared/layout_administracion', $data);
        }
        
        	function cambiar_pass()
		{
			$post = $this->input->post();
			if($post['flag'])
			{
				
				$where['id']       = ADMIN_ID;
				$where['password'] =do_hash($post['actual']); 
				$agente = $this->general_model->get_row_by_where('hd_backoffices', $where);
				
				if(!empty($agente))
				{
					
					if($post['nueva'] == $post['nueva2'] && strlen($post['nueva']) > 0)
					{
						$update['password'] = do_hash(trim($post['nueva']));
						$this->general_model->update_row('hd_backoffices', $update, $agente->id);
//						pre_die($this->db->last_query());
						$this->session->set_flashdata('mensaje', 'La password fue cambiada correctamente');
					}
					else
					{
						$this->session->set_flashdata('mensaje', 'Las password no coinciden');
					}	
				}
				else
				{
					$this->session->set_flashdata('mensaje', 'Las password actual no es correcta');
				}
				response.redirect(base_url().'administracion/cambiar_pass/');
			}
			$data['mensaje']      = $this->session->flashdata("mensaje");
			$data['titulo']       = "Cambiar password";
            $data['hidden']       = array('flag' => 1);
            $data['main_content'] = 'shared/_cambiar_pass_view';
            $this->load->view('shared/layout_administracion', $data);
		}
               
    }
   