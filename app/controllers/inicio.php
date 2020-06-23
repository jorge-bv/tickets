<?php
    class Inicio extends CI_Controller
    {
        function  __construct()
        {
            parent::__construct();
            $this->load->model('login_model');
            $this->load->library('session');
        }
		
        function index()
        {
		    
	        $rol                      = $this->session->userdata('rol');
			if($rol == 1)
			{
				response.redirect(base_url().'clientes');
			}
			elseif($rol == 2)
			{
				response.redirect(base_url().'gestion');
			}
            else
            {
                response.redirect(base_url());
            }
        }
		
		function cliente_nueva_solicitud()
		{
			$data['h1'] = "Nueva solicitud";
            $data['title']='Nueva solicitud';
			
			$data['problema'] =array(
	          'name'        => 'data[problema]',
	          'id'          => 'problema',
	          'value'       => '',
	          'maxlength'   => '100',
	          'size'        => '50',
	          'style'       => 'width: 500px; height: 80px',
        	);

			$data['direcciones']          = $this->preparar_dropdown($this->login_model->trae_todo('direcciones'));
			$data['tipos']                = $this->preparar_dropdown($this->login_model->trae_todo('siniestros_tipos'));

			$data['hidden'] = array(
								'data[contactos_id]' => $this->session->userdata('id'),
								'data[estados_id]' => 1);
			
			$data['main_content'] = '		';
            $this->load->view('includes/template', $data);
		}

		function gestion_nueva_solicitud()
		{
			$data['h1'] = "Nueva solicitud";
            $data['title']='Nueva solicitud';
			
			$data['problema'] =array(
	          'name'        => 'data[problema]',
	          'id'          => 'problema',
	          'value'       => '',
	          'maxlength'   => '100',
	          'size'        => '50',
	          'style'       => 'width: 500px; height: 80px',
        	);

			$data['direcciones']          = $this->preparar_dropdown($this->login_model->trae_todo('direcciones'));
			$data['tipos']                = $this->preparar_dropdown($this->login_model->trae_todo('siniestros_tipos'));

			$data['hidden'] = array(
								'data[contactos_id]' => $this->session->userdata('id'),
								'data[estados_id]' => 1);
			
			$data['main_content'] = 'cliente_nuevaSolicitud_view';
            $this->load->view('includes/template', $data);
		}
		
		function cliente_solicitudes()
		{
			$data['estados']      = $this->preparar_dropdown($this->login_model->trae_todo('estados'));
			$data['estados_id']   = $this->input->post('filtros');
			$data['solicitudes'] = $this->login_model->listar_solicitudes($data['estados_id']);
			$data['h1'] = "Mis solicitudes";
            $data['title']='Mis solicitudes';
			$data['main_content'] = 'cliente_solicitudes_view';
            $this->load->view('includes/template', $data);
		}
		
		function preparar_dropdown($data)
		{
			$result[0] = 'Seleccione';
			foreach ($data as $key => $value) {
				$result[$value->id] = $value->nombre;
			}
			return $result; 
		}

		function save()
		{
			$id = $this->login_model->crear_nuevo();
			response.redirect('/solicitud/ficha/'.$id); 
		}

		function mostrar_ficha_solicitud($id)
		{
			$data['solicitud'] = $this->login_model->mostrar_solicitud($id);
			$data['contacto']  = $this->login_model->mostrar_contacto($data['solicitud']->contactos_id);
			$data['cliente']   = $this->login_model->mostrar_cliente($data['contacto']->clientes_id);
			$data['h1'] = "Ficha Solicitud";
            $data['title']='Ficha Solicitud';
			$data['main_content'] = 'solicitud_ficha_view';
            $this->load->view('includes/template', $data);
		}
		
		function evaluar_atencion($id)
		{
			$data  = $this->input->post('data');
			$where = $this->input->post('where');
			if(!empty($data))
			{
				$data['estados_id'] = 6;
				if($data['evaluacion_resultado'] == 3)
				{
					$data['estados_id'] = 7;
				}
				$this->login_model->evaluar_atencion($data, $where);
				response.redirect('/solicitud/ficha/'.$where['id']);
			}
			$data['solicitud'] = $this->login_model->mostrar_solicitud($id);
			$data['contacto']  = $this->login_model->mostrar_contacto($data['solicitud']->contactos_id);
			$data['cliente']   = $this->login_model->mostrar_cliente($data['contacto']->clientes_id);
			
			$data['finaliza_comentario'] =array(
	          'name'        => 'data[finaliza_comentario]',
	          'id'          => 'finaliza_comentario',
	          'value'       => '',
	          'maxlength'   => '100',
	          'size'        => '50',
	          'style'       => 'width: 500px; height: 80px',
        	);
			
			$data['evaluacion_comentario'] =array(
	          'name'        => 'data[evaluacion_comentario]',
	          'id'          => 'evaluacion_comentario',
	          'value'       => '',
	          'maxlength'   => '100',
	          'size'        => '50',
	          'style'       => 'width: 500px; height: 80px',
        	);
			
			$data['hidden'] = array(
								'where[id]'=>$id
			);
			$data['h1'] = "Evaluar atención";
            $data['title']='Evaluar atención';
			$data['main_content'] = 'solicitud_evaluar_view';
            $this->load->view('includes/template', $data);
		}

		function listar_solicitudes_pendientes()
		{
			$data['solicitudes'] = $this->login_model->listar_solicitudes_pendientes();
			$data['h1'] = "Solicitudes pendientes";
            $data['title']='Solicitudes pendientes';
			$data['main_content'] = 'solicitudes_pendientes_view';
            $this->load->view('includes/template', $data);
		}

		function listar_solicitudes()
		{
			$data['estados']      = $this->preparar_dropdown($this->login_model->trae_todo('estados'));
			$data['estados_id']   = $this->input->post('filtros');
			$data['solicitudes'] = $this->login_model->listar_solicitudes($data['estados_id']);
			$data['h1'] = "Listado de solicitudes";
            $data['title']='Listado de solicitudes';
			$data['main_content'] = 'cliente_solicitudes_view';
            $this->load->view('includes/template', $data);
		}

		function asignar_responsable($id)
		{
				
			$data  = $this->input->post('data');
			$where = $this->input->post('where');
			if(!empty($data))
			{
				$data['estados_id'] = 2;
				$this->login_model->actualizar('solicitudes', $data, $where);
				response.redirect('solicitud/ficha/'.$id);
			}
			$data['solicitud']      = $this->login_model->mostrar_solicitud($id);
			$data['contacto']       = $this->login_model->mostrar_contacto($data['solicitud']->contactos_id);
			$data['cliente']        = $this->login_model->mostrar_cliente($data['contacto']->clientes_id);
			$data['responsables']   = $this->preparar_dropdown($this->login_model->traer_usuarios($rol = 2));
			$data['h1']             = 'Asignar responsable';
            $data['title']          = 'Ficha Solicitud';
			$data['hidden']         =  array('where[id]' => $id);
			$data['main_content']   = 'solicitud_asignar_view';
            $this->load->view('includes/template', $data);
		}
		
		function aceptar_solicitud($id)
		{
			$data  = $this->input->post('data');
			$where = $this->input->post('where');
			if(!empty($data))
			{
				$data['estados_id'] = 3;
				$data['acepta_fecha_propuesta'] = ordenar_fechaServidor($data['acepta_fecha_propuesta']);
				$this->login_model->actualizar('solicitudes', $data, $where);
				response.redirect('/solicitud/ficha/'.$where['id']);
			}
			$data['solicitud'] = $this->login_model->mostrar_solicitud($id);
			$data['contacto']  = $this->login_model->mostrar_contacto($data['solicitud']->contactos_id);
			$data['cliente']   = $this->login_model->mostrar_cliente($data['contacto']->clientes_id);
			
			$data['acepta_comentario'] =array(
	          'name'        => 'data[acepta_comentario]',
	          'id'          => 'acepta_comentario',
	          'value'       => '',
	          'maxlength'   => '100',
	          'size'        => '50',
	          'style'       => 'width: 500px; height: 80px',
        	);
			
			$data['fecha_propuesta'] =array(
	          'name'        => 'data[acepta_fecha_propuesta]',
	          'id'          => 'fecha_propuesta',
	          'value'       => '',
	          'maxlength'   => '100',
	          'size'        => '50',
	          'style'       => 'width: 120px;',
        	);
			
			$data['hidden'] = array(
								'where[id]'=>$id
			);
			$data['h1'] = "recahzar solicitud";
            $data['title']='Aceptar solicitud';
			$data['main_content'] = 'solicitud_acepta_view';
            $this->load->view('includes/template', $data);
		}

		function rechazar_solicitud($id)
		{
			$data  = $this->input->post('data');
			$where = $this->input->post('where');
			if(!empty($data))
			{
				$data['estados_id'] = 4;
				$this->login_model->actualizar('solicitudes', $data, $where);
				response.redirect('/solicitud/ficha/'.$where['id']);
			}
			$data['solicitud'] = $this->login_model->mostrar_solicitud($id);
			$data['contacto']  = $this->login_model->mostrar_contacto($data['solicitud']->contactos_id);
			$data['cliente']   = $this->login_model->mostrar_cliente($data['contacto']->clientes_id);
			
			$data['rechaza_comentario'] =array(
	          'name'        => 'data[rechaza_comentario]',
	          'id'          => 'rechaza_comentario',
	          'value'       => '',
	          'maxlength'   => '100',
	          'size'        => '50',
	          'style'       => 'width: 500px; height: 80px',
        	);
			
			$data['hidden'] = array(
								'where[id]'=>$id
			);
			$data['h1'] = "Rechazar solicitud";
            $data['title']='Rechazar solicitud';
			$data['main_content'] = 'solicitud_rechaza_view';
            $this->load->view('includes/template', $data);
		}
		
		function finalizar_solicitud($id)
		{
			$data  = $this->input->post('data');
			$where = $this->input->post('where');
			if(!empty($data))
			{
				$data['estados_id'] = 5;
				$data['finaliza_fecha_inicio']  = ordenar_fechaServidor($data['finaliza_fecha_inicio']);
				$data['finaliza_fecha_termino'] = ordenar_fechaServidor($data['finaliza_fecha_termino']);
				$this->login_model->actualizar('solicitudes', $data, $where);
				response.redirect('/solicitud/ficha/'.$where['id']);
			}
			$data['solicitud'] = $this->login_model->mostrar_solicitud($id);
			$data['contacto']  = $this->login_model->mostrar_contacto($data['solicitud']->contactos_id);
			$data['cliente']   = $this->login_model->mostrar_cliente($data['contacto']->clientes_id);
			
			$data['finaliza_comentario'] =array(
	          'name'        => 'data[finaliza_comentario]',
	          'id'          => 'finaliza_comentario',
	          'value'       => '',
	          'maxlength'   => '100',
	          'size'        => '50',
	          'style'       => 'width: 500px; height: 80px',
        	);
			
			$data['fecha_inicio'] =array(
	          'name'        => 'data[finaliza_fecha_inicio]',
	          'id'          => 'fecha_inicio',
	          'value'       => '',
	          'maxlength'   => '100',
	          'size'        => '50',
	          'style'       => 'width: 120px;',
        	);
			
			$data['fecha_termino'] =array(
	          'name'        => 'data[finaliza_fecha_termino]',
	          'id'          => 'fecha_termino',
	          'value'       => '',
	          'maxlength'   => '100',
	          'size'        => '50',
	          'style'       => 'width: 120px;',
        	);
			
			$data['hidden'] = array(
								'where[id]'=>$id
			);
			$data['h1'] = "Finalizar atención técnica";
            $data['title']='Finalizar atención técnica';
			$data['main_content'] = 'solicitud_finalizada_view';
            $this->load->view('includes/template', $data);
		}

		function reportes()
		{
			$data['h1'] = "Reportes";
            $data['title']='Reportes';
			$data['main_content'] = 'solicitud_reportes_view';
            $this->load->view('includes/template', $data);
		}
		
		function reporte_mensual()
		{
			$data['h1'] = "Reporte mensual";
            $data['title']='Reporte mensual';
			$data['main_content'] = 'solicitud_reportes_mensuales_view';
            $this->load->view('includes/template', $data);
		}

    }