<?php

class Clientes_admin extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('clientes_model');
        $this->load->model('gestion_model');
        $this->load->library('pagination');
        $this->load->library('session');
        $this->load->library('general_model');
        $this->load->helper('email');
        define("CLIENTE_ID", validar_cliente($this->session->userdata('token_cliente')));
        define("EMPRESA_ID", validar_empresa(CLIENTE_ID));
    }

    function index() {
        $data['active_inicio'] = " active ";
        $data['titulo'] = "<center><b> Bienvenido " .  $this->session->userdata('nombre');"</b></center>";
        $data['hidden'] = array('flag' => 1);
        $data['main_content'] = 'cliente_admin/index_view';
        $this->load->view('shared/layout_cliente_admin', $data);
    }

   
        
   
    function nueva_solicitud() {
      
   
        $post = $this->input->post();
        if ($post['flag'] == 1) {
            $data = $post['data'];

            $this->db->select("correlativo");
            $this->db->where("empresas_id", EMPRESA_ID);
            $this->db->order_by("correlativo", 'desc');
            $this->db->limit(1);
            $query = $this->db->get('solicitudes');

            $data['correlativo'] = $query->row()->correlativo + 1;
            $data['etapas_id'] = 10; // inicio
            $data['estados_id'] = 100; //Creado
            $data['clientes_id'] = CLIENTE_ID;
            $data['empresas_id'] = EMPRESA_ID;
            
            $solicitud_id = $this->general_model->insert('solicitudes', $data);

            //ingreso imagen
            
      
      if (!empty($_FILES['imagen']['name'])) {
                $ruta_carpeta = 'uploads/';
                $nombre_foto = crear_nombre_imagen($_FILES['imagen']['name']);
                $ruta_contenido = $ruta_carpeta . $nombre_foto;
                if (copy($_FILES['imagen']['tmp_name'], $ruta_contenido)) {
                    $this->general_model->update_row('solicitudes', array('img_1' => $nombre_foto), $solicitud_id);
                }
            }
        
         
            
            $bitacora['solicitudes_id'] = $solicitud_id;
            $bitacora['descripcion'] = "Se crea la solicitud con el correlativo " . $data['correlativo'];
            $bitacora['estados_id'] = 100;
            $this->general_model->insert('bitacora', $bitacora);

            $where_agente['activo'] = TRUE;
            $agentes = $this->general_model->get_result_by_where('agentes', $where_agente);
            $empresa = $this->general_model->get_row_by_pk('empresas', EMPRESA_ID);
            $solicitud = $this->general_model->get_row_by_pk('solicitudes', $solicitud_id);
            $info_correo['titulo'] = "Nuevo Ticket desde Hitch Help Desk";
            $info_correo['contenido'] = "Se ha generado generado una nueva solicitud con el número: <b>$solicitud_id</b>";
            $info_correo['h3'] = "Revisar a la brevedad";
            $info_correo['solicitud_id'] = $solicitud_id;
            $info_correo['empresa'] = $empresa;
            $info_correo['solicitud'] = $solicitud;

                
            
          
                $correo['mensaje'] = $this->load->view('shared/_correo_cliente_view', $info_correo, TRUE);
                $correo['para'] = 'soporte@hitch.cl';
                $correo['nombre_remitente'] = 'Soporte Tickets';
                $correo['asunto'] = 'Se ha abierto una nueva Solicitud';
                enviar_correo_sendgrid($correo);
            
            $this->session->set_flashdata('mensaje_creacion', "Su solicitud ha sido procesada correctamente y se ha registrado con el N° <strong>" . $solicitud_id . "</strong>");
            response . redirect(base_url() . 'clientes_admin/solicitud/' . $data['correlativo']);
        }

        $data['productos'] = $this->general_model->get_result_by_join('productos', 'productos_empresas', array('id' => 'productos_id'), array('empresas_id' => EMPRESA_ID));
        $data['titulo'] = "Nueva solicitud";
        $data['hidden'] = array('flag' => 1);
        $data['main_content'] = 'cliente_admin/nueva_solicitud_view';
        $this->load->view('shared/layout_cliente_admin', $data);
    }

    function solicitud($correlativo = 0) {
        $where['correlativo'] = $correlativo;
        $where['empresas_id'] = EMPRESA_ID;
        $data['solicitud'] = $this->general_model->get_row_by_where('solicitudes', $where);

        $data['solicitud']->estado = $this->general_model->get_value_by_pk("estados", $data['solicitud']->estados_id, "nombre");
        $data['solicitud']->producto = $this->general_model->get_value_by_pk("productos", $data['solicitud']->productos_id, "nombre");
        $data['comentarios'] = $this->clientes_model->traer_comentarios($data['solicitud']->id);

        $data['bitacora'] = $this->general_model->get_result_by_where('bitacora', array('solicitudes_id' => $data['solicitud']->id), '', array('id' => 'desc'));
        $data['agente'] = $this->general_model->get_row_by_pk('agentes', $data['solicitud']->agentes_id);

        $data['mensaje_creacion'] = $this->session->flashdata("mensaje_creacion");
        $data['titulo'] = "Solicitud N° " . $correlativo;
        $data['hidden'] = array('flag' => 1);
     
        $data['main_content'] = 'cliente_admin/solicitud_view';
        $this->load->view('shared/layout_cliente_admin', $data);
    }

    function guardar_comentarios() {
        $post = $this->input->post();
        $where['correlativo'] = $post['correlativo'];
        $where['empresas_id'] = EMPRESA_ID;
        $solicitud = $this->general_model->get_row_by_where('solicitudes', $where);

        $insert['solicitudes_id'] = $solicitud->id;
        $insert['descripcion'] = $post['descripcion'];
        $insert['clientes_id'] = CLIENTE_ID;
       $solicitud_id= $this->general_model->insert('comentarios', $insert);
        
                    if (!empty($_FILES['imagen']['name'])) {
                $ruta_carpeta = 'adjuntas_gestion/';
                $nombre_foto = crear_nombre_imagen($_FILES['imagen']['name']);
                $ruta_contenido = $ruta_carpeta . $nombre_foto;
                if (copy($_FILES['imagen']['tmp_name'], $ruta_contenido)) {
                    $this->general_model->update_row('comentarios', array('img_1' => $nombre_foto), $solicitud_id);
                }
            }

      redirect('clientes_admin/solicitud/'. $post['correlativo']);
    }

    function rechazo_no_conforme($correlativo) {
        $this->cambiar_estado($correlativo, 20, 230, $correo);
    }

    function rechazo_conforme($correlativo) {
        $this->cambiar_estado($correlativo, 20, 240, $correo);
    }

    function proceso_no_conforme($correlativo) {
        $this->cambiar_estado($correlativo, 20, 260, $correo);
    }

    function cerrar_solicitud($correlativo) {
        $this->cambiar_estado($correlativo, 30, 300, $correo);
    }

    function solicitudes_sin_procesar() {

        
        $data['titulo'] = "Solicitudes sin procesar";
        $data['active_sin_procesar'] = " active ";


        $this->traer_solicitudes(10, $data);
    }

    function solicitudes_en_curso() {
        $data['titulo'] = "Solicitudes en curso";
        $data['active_en_curso'] = " active ";
        $this->traer_solicitudes(20, $data);
    }

    function solicitudes_terminadas() {
        $data['titulo'] = "Solicitudes terminadas";
        $data['active_terminadas'] = " active ";
        $this->traer_solicitudes(30, $data);
    }

    private function cambiar_estado($correlativo, $etapa_id, $estado_id, $correo) {
        $where['correlativo'] = $correlativo;
        $where['empresas_id'] = EMPRESA_ID;
        $solicitud = $this->general_model->get_row_by_where('solicitudes', $where);

        $update['etapas_id'] = $etapa_id;
        $update['estados_id'] = $estado_id;
        $update['update'] = ahoraServidor();
        $this->general_model->update_row('solicitudes', $update, $solicitud->id);

        //envio correo
        $agente = $this->general_model->get_row_by_pk('agentes', $solicitud->agentes_id);

        switch ($estado_id) {
            case 230:
                $asunto = "Rechazo solicitud N°" . $solicitud->id . " no fue aceptada conforme";
                $mensaje = "El rechazo a la solicitud  N° " . $solicitud->id . " no fue aceptado conforme.";
                $h3 = "Revisar comentarios o contactar a cliente";
                $desc_bitacora = "El rechazo a la solicitud no fue aceptada conforme";
                break;
            

            case 240:
                $asunto = "Rechazo solicitud N°". $solicitud->id . " fue aceptada conforme";
                $mensaje = "El rechazo a la solicitud  N° " . $solicitud->id . " fue aceptado conforme.";
                $desc_bitacora = "Rechazo solicitud fue aceptada conforme";
                break;
            case 260:
                $asunto = "La resolución a la solicitud N° " . $solicitud->id . " no fue aceptada conforme";
                $mensaje = "La resolución a la solicitud  N° " . $solicitud->id . "  <b>NO</b> fue aceptada conforme";
                $h3 = "Revisar comentarios o contactar a cliente";
                $desc_bitacora = "Resolución a la solicitud no fue aceptada conforme";
                break;
            case 300:
                $asunto = "La resolución a la solicitud N°" . $solicitud->id . " fue aceptada conforme <br>";
                $mensaje = "La resolución a la solicitud  N° " . $solicitud->id . " fue aceptado conforme y fue cerrada correctamente";
                $desc_bitacora = "Resolución a la solicitud fue aceptada conforme y cerrada";
                break;
        }


        $bitacora['descripcion'] = $desc_bitacora;
        $bitacora['solicitudes_id'] = $solicitud->id;
        $bitacora['estados_id'] = $estado_id;
        $this->general_model->insert('bitacora', $bitacora);
    
        response . redirect(base_url() . 'cliente_admin/solicitud/' . $solicitud->correlativo);
    }

    function cambiar_pass() {
        $post = $this->input->post();
        if ($post['flag']) {

            $where['id'] = CLIENTE_ID;
            $where['password'] = do_hash($post['actual']);
            $cliente = $this->general_model->get_row_by_where('clientes', $where);

            if (!empty($cliente)) {
                if ($post['nueva'] == $post['nueva2'] && strlen($post['nueva']) > 0) {
                    $update['password'] = do_hash($post['nueva']);
                    $this->general_model->update_row('clientes', $update, $cliente->id);
                    $this->session->set_flashdata('mensaje', 'La password fue cambiada correctamente');
                } else {
                    $this->session->set_flashdata('mensaje', 'Las password no coinciden');
                }
            } else {
                $this->session->set_flashdata('mensaje', 'Las password actual no es correcta');
            }
            response . redirect(base_url() . 'clientes/cambiar_pass/');
        }
        $data['mensaje'] = $this->session->flashdata("mensaje");
        $data['titulo'] = "Cambiar password";
        $data['hidden'] = array('flag' => 1);
        $data['main_content'] = 'shared/_cambiar_pass_view';
        $this->load->view('shared/layout_cliente_admin', $data);
    }

    private function traer_solicitudes($etapa = 0, $data) {
        $where['empresas_id'] = EMPRESA_ID;
         
        $where['solicitudes.etapas_id'] = $etapa;
        $data['solicitudes'] = $this->general_model->get_result_by_join('solicitudes', 'estados', array('estados_id' => 'id'), $where, array('solicitudes.update' => 'desc'));
        $data['main_content'] = 'cliente_admin/listado_solicitudes_view';
  
        $this->load->view('shared/layout_cliente_admin', $data);
    }

}
