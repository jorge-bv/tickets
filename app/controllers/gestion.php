<?php

class Gestion extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('gestion_model');
        $this->load->model('clientes_model');
        $this->load->library('session');
        $this->load->library('general_model');
        $this->load->helper('email');
        $this->load->helper('url');
               $this->load->library('pagination');

        //define("AGENTE_ID", validar_agente($this->session->userdata('token_agente')));
    }

    function index() {

        $data['titulo'] = "<center><b> Bienvenido " . $this->session->userdata('nombre');
        "</b></center>";
        $data['active_inicio'] = " active ";
        $data['main_content'] = 'gestion/index_view';
        $this->load->view('shared/layout_gestion', $data);
    }

    function solicitudes() {
        $page = ($this->uri->segment(3)) ? ($this->uri->segment(3) - 1) : 0;
         
           $config['base_url'] = base_url() . 'gestion/solicitudes/';
          $config['total_rows'] = $this->gestion_model->numero_usuario();
            $config['per_page'] = 6;
            $config['num_links'] = 2;
              $config['full_tag_open'] = '<div class="pagging text-center"<nav><ul class="pagination">';
            $config['full_tag_close'] = '</ul></nav></div>';
            $config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
            $config['num_tag_close'] = '</span></li>';
            $config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
            $config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>';
            $config['next_tag_open'] = '<li class"page-item"><span class="page-link">';
            $config['next_tagl_close'] = '<span aria-hidden="true">&raquo;</span></span></li>';
            $config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
            $config['prev_tagl_close'] = '</span></li>';
            $config['first_tag_open'] = '<li class="page-item"><span class="page-link">';
            $config['first_tagl_close'] = '</span></li>';
            $config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
            $config['last_tagl_close'] = '</span></li>';
            $this->pagination->initialize($config);
             $data = array('solicitudes' => $this->gestion_model->paginar_tabla($config['per_page'],$page),
                'pagination' => $this->pagination->create_links());
          
//        $where['solicitudes.etapas_id'] = 10; //Etapa solictudes creadas
//        $where['estados_id'] = 100; // creada sin procesar
//        
        //$data['solicitudes'] = $this->general_model->get_result_by_join('solicitudes', 'estados', array('estados_id' => 'id'), $where, array('solicitudes.id' => 'desc'));
        
        $data['url'] = base_url() . 'gestion/ficha_solicitud/';
        $data['active_disponibles'] = " active ";
        $data['titulo'] = "Solicitudes disponibles";
        $data['main_content'] = 'gestion/listado_solicitudes_view';
        $this->load->view('shared/layout_gestion', $data);
    }

    function solicitudesClientes($id) {


        $where['solicitudes.clientes_id'] = $id;
        $data['solicitudes'] = $this->general_model->get_result_by_join('solicitudes', 'estados', array('estados_id' => 'id'), $where, array('solicitudes.id' => 'desc'));

        $data['url'] = base_url() . 'gestion/ficha_solicitud/';
        $data['active_disponibles'] = " active ";
        $data['titulo'] = "Solicitudes disponibles";
        $data['main_content'] = 'gestion/listado_solicitudes_view';
        $this->load->view('shared/layout_gestion', $data);
    }

    function clientes() {
        $data['cliente'] = $this->clientes_model->get_all_usuarios();
        $data['url'] = base_url() . 'gestion/ficha_solicitud/';
        $data['active_cliente'] = " active ";
        $data['titulo'] = "Clientes";
        $data['main_content'] = 'gestion/clientes_view';

        $this->load->view('shared/layout_gestion', $data);
    }

    function nueva_solicitud_correo($correox,$asunto,$idCorreo) {
        echo $correox.' '.$asunto.' '.$idCorreo;
       
        
        $correo2= str_replace("ARROBA", "@",$correox);
       $asunto2= urldecode($asunto);
       $asunto3= str_replace("/"," ",$asunto2);
     
        $this->db->select("id_correo"); 
        $this->db->where("id_correo",$idCorreo);
        $this->db->limit(1);
        $query = $this->db->get('solicitudes');

        if ($correo2 != 'soporte@hitch.cl' && $query->num_rows()==0) {
            $this->db->select("correlativo");
            $this->db->order_by("correlativo", 'desc');
            $this->db->limit(1);
            $query = $this->db->get('solicitudes');

            $data['correlativo'] = $query->row()->correlativo + 1;
            $data['etapas_id'] = 10; // inicio
            $data['estados_id'] = 100; //Creado
            $data['clientes_id'] = 220;
            $data['empresas_id'] = 12;
            $data['agentes_id'] = 213;
            $data['productos_id']=11;
            $data['titulo']=$asunto3;
            $data['id_correo']=$idCorreo;
          $solicitud_id=  $this->general_model->insert('solicitudes', $data);
             $where_agente['activo'] = TRUE;
            $agentes = $this->general_model->get_result_by_where('agentes', $where_agente);
            $empresa = $this->general_model->get_row_by_pk('empresas', $data['empresas_id']);
            $solicitud = $this->general_model->get_row_by_pk('solicitudes', $solicitud_id);
            $info_correo['titulo'] = "Nuevo Ticket desde Hitch Help Desk";
            $info_correo['contenido'] = "Se ha generado generado una nueva solicitud con el número: <b>$solicitud_id</b>";
            $info_correo['h3'] = "Revisar a la brevedad";
            $info_correo['solicitud_id'] = $solicitud_id;
            $info_correo['solicitud'] = $solicitud;




            $correo['mensaje'] = $this->load->view('shared/_correo_cliente_view', $info_correo, TRUE);
            $correo['para'] = 'soporte@hitch.cl,'.$correo2;
            $correo['nombre_remitente'] = 'Soporte Tickets';
            $correo['asunto'] = 'Se ha abierto una nueva Solicitud';
            enviar_correo_sendgrid($correo);
          
        }
        else
        {
            exit();
        }
    }

    function nueva_solicitud() {


        $post = $this->input->post();
        if ($post['flag'] == 1) {
            $data = $post['data'];

            if (!empty($data['correlativo'])) {



                $data['etapas_id'] = 10; // inicio
                $data['estados_id'] = 100; //Creado
                $data['clientes_id'] = $data['clientes_id'];
                $data['empresas_id'] = $data['empresas_id'];
                $where['correlativo'] = $data['correlativo'];
                 $this->general_model->update_row_by_where('solicitudes', $data, $where);
                $solicitude['soli']= $this->gestion_model->getid2($data['correlativo']);
                $solicitud_id=$solicitude['soli']->id;
                //ingreso imagen


                if (!empty($_FILES['imagen']['name'])) {
                    $ruta_carpeta = 'uploads/';
                    $nombre_foto = crear_nombre_imagen($_FILES['imagen']['name']);
                    $ruta_contenido = $ruta_carpeta . $nombre_foto;
                    if (copy($_FILES['imagen']['tmp_name'], $ruta_contenido)) {
                        $this->general_model->update_row('solicitudes', array('img_1' => $nombre_foto), $solicitud_id);
                    }
                }
                
                         
            } else {

                $this->db->select("correlativo");
                $this->db->where("empresas_id", $data['empresas_id']);
                $this->db->order_by("correlativo", 'desc');
                $this->db->limit(1);
                $query = $this->db->get('solicitudes');

                $data['correlativo'] = $query->row()->correlativo + 1;
                $data['etapas_id'] = 10; // inicio
                $data['estados_id'] = 100; //Creado
                $data['clientes_id'] = $data['clientes_id'];
                $data['empresas_id'] = $data['empresas_id'];

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
            }




            $bitacora['solicitudes_id'] = $solicitud_id;
            $bitacora['descripcion'] = "Se crea la solicitud con el correlativo " . $data['correlativo'];
            $bitacora['estados_id'] = 100;
            $this->general_model->insert('bitacora', $bitacora);

            $where_agente['activo'] = TRUE;
            $agentes = $this->general_model->get_result_by_where('agentes', $where_agente);
            $empresa = $this->general_model->get_row_by_pk('empresas', $data['empresas_id']);
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
           
            response . redirect(base_url() . 'gestion/solicitud/' . $solicitud_id);
        }
        $data['empresas'] = $this->general_model->get_table('empresas');
        $data['productos'] = $this->general_model->get_result_by_join('productos', 'productos_empresas', array('id' => 'productos_id'));
        $data['cliente'] = $this->clientes_model->get_all_usuarios();
        $where['empresas_id'] = 12;
        $data['solicitud'] = $this->general_model->get_result_by_where('solicitudes', $where, 'correlativo');
        $data['titulo'] = "Nueva solicitud";
        $data['hidden'] = array('flag' => 1);
        $data['main_content'] = 'gestion/nueva_solicitud_view';
        $this->load->view('shared/layout_gestion', $data);
    }

    function solicitud($correlativo = 0) {
        $where['id'] = $correlativo;
        //$where['empresas_id'] = EMPRESA_ID;
        $this->asignar_solicitud($correlativo);
        $data['solicitud'] = $this->general_model->get_row_by_where('solicitudes', $where);

        $data['solicitud']->estado = $this->general_model->get_value_by_pk("estados", $data['solicitud']->estados_id, "nombre");
        $data['solicitud']->producto = $this->general_model->get_value_by_pk("productos", $data['solicitud']->productos_id, "nombre");
        $data['comentarios'] = $this->clientes_model->traer_comentarios($data['solicitud']->id);

        $data['bitacora'] = $this->general_model->get_result_by_where('bitacora', array('solicitudes_id' => $data['solicitud']->id), '', array('id' => 'desc'));
        $data['agente'] = $this->general_model->get_row_by_pk('agentes', $data['solicitud']->agentes_id);

        $data['mensaje_creacion'] = $this->session->flashdata("mensaje_creacion");
        $data['titulo'] = "Solicitud N° " . $correlativo;
        $data['hidden'] = array('flag' => 1);
        $data['main_content'] = 'gestion/gestionar_solicitud_view';
        $this->load->view('shared/layout_gestion', $data);
    }

    function mis_solicitudes() {

        $where['solicitudes.etapas_id'] = 20; //Etapa en proceso
      

        $data['solicitudes'] = $this->general_model->get_result_by_join('solicitudes', 'estados', array('estados_id' => 'id'), $where, array('solicitudes.update' => 'desc'));
        $data['url'] = base_url() . 'gestion/gestionar_solicitud/';

        $data['active_mias'] = " active ";
        $data['titulo'] = "Mis solicitudes asignadas";
        $data['main_content'] = 'gestion/listado_solicitudes_view';
        $this->load->view('shared/layout_gestion', $data);
    }

    function mis_solicitudes_cerradas() {
        $where['solicitudes.etapas_id'] = 30; //Etapa en proceso
        $where['agentes_id'] = AGENTE_ID;

        $data['solicitudes'] = $this->general_model->get_result_by_join('solicitudes', 'estados', array('estados_id' => 'id'), $where, array('solicitudes.id' => 'desc'));
        //pre($);
        $data['url'] = base_url() . 'gestion/solicitud_cerrada/';

        $data['active_cerradas'] = " active ";
        $data['titulo'] = "Solicitudes cerradas";
        $data['main_content'] = 'gestion/listado_solicitudes_view';
        $this->load->view('shared/layout_gestion', $data);
    }

    function ficha_solicitud($solicitud_id) {
        $data['solicitud'] = $this->general_model->get_row_by_pk('solicitudes', $solicitud_id);
        $data['solicitud']->estado = $this->general_model->get_value_by_pk("estados", $data['solicitud']->estados_id, "nombre");
        $data['solicitud']->producto = $this->general_model->get_value_by_pk("productos", $data['solicitud']->productos_id, "nombre");
        $data['comentarios'] = $this->clientes_model->traer_comentarios($data['solicitud']->id);
        $data['bitacora'] = $this->general_model->get_result_by_where('bitacora', array('solicitudes_id' => $data['solicitud']->id), '', array('id' => 'desc'));
        $data['cliente'] = $this->general_model->get_row_by_pk('clientes', $data['solicitud']->clientes_id);
        $data['empresa'] = $this->general_model->get_row_by_pk('empresas', $data['cliente']->empresas_id);
        $data['active_disponibles'] = " active ";
        $data['titulo'] = "Ficha solicitud";
        $data['hidden'] = array('flag' => 1);

        $data['main_content'] = 'gestion/ficha_solicitud_view';
        $this->load->view('shared/layout_gestion', $data);
    }

    function asignar_solicitud($solicitud_id) {
        $update['agentes_id'] = AGENTE_ID;
        $update['estados_id'] = 200;
        $update['etapas_id'] = 20;
        $update['update'] = ahoraServidor();
        $this->general_model->update_row('solicitudes', $update, $solicitud_id);

        $agente = $this->general_model->get_row_by_pk('agentes', AGENTE_ID);
        $bitacora['solicitudes_id'] = $solicitud_id;
        $bitacora['descripcion'] = "La solicitud fue asignada al agente " . $agente->nombre;
        $bitacora['estados_id'] = 200;
        $this->general_model->insert('bitacora', $bitacora);

        $solicitud = $this->general_model->get_row_by_pk('solicitudes', $solicitud_id);
        $cliente = $this->general_model->get_row_by_pk('clientes', $solicitud->clientes_id);

        $info_correo['titulo'] = "Solicitud N° " . $solicitud->correlativo . " recepcionada";
        $info_correo['contenido'] = "La solicitud N° " . $solicitud->correlativo . " fue correctamente recepcionada por el equipo de soporte.";
        $info_correo['h3'] = "Nos comunicaremos con usted a la brevedad";
        $info_correo['link'] = base_url('clientes/solicitud/' . $solicitud->correlativo);

        $correo['mensaje'] = $this->load->view('shared/_correo_view', $info_correo, TRUE);
        $correo['para'] = $cliente->correo;
        $correo['nombre_remitente'] = 'Soporte Tickets';
        $correo['asunto'] = "Solicitud " . $solicitud->correlativo . " recepcionada";
        enviar_correo_sendgrid($correo);

        response . redirect(base_url() . 'gestion/gestionar_solicitud/' . $solicitud_id);
    }

    function gestionar_solicitud($solicitud_id) {
        error_reporting(0);
        $post = $this->input->post();

        if ($post['flag'] == 1) {
            $update = $post['data'];
            $update['update'] = ahoraServidor();

            //ENVIAR CORREO INFORMANDO RECHAZO
            $solicitud = $this->general_model->get_row_by_pk('solicitudes', $post['solicitud_id']);
            $cliente = $this->general_model->get_row_by_pk('clientes', $solicitud->clientes_id);
            if ($post['tipo_respuesta'] == "rechazo") { // estado 221
                $info_correo['titulo'] = "Solicitud N° " . $solicitud->correlativo . " rechazada";
                $info_correo['contenido'] = "La solicitud N° " . $solicitud->correlativo . " fue rechazada por el (los) siguientes motivos:";
                $info_correo['h3'] = $update['motivo_rechazo'];
                $info_correo['link'] = base_url('clientes/solicitud/' . $solicitud->correlativo);

                $correo['mensaje'] = $this->load->view('shared/_correo_view', $info_correo, TRUE);
                $correo['para'] = $cliente->correo;
                $correo['nombre_remitente'] = 'Soporte Tickets';
                $correo['asunto'] = 'La solicitud N°' . $solicitud->correlativo . ' ha sido rechazada';

                enviar_correo_sendgrid($correo);
                $desc_bitacora = "La solicitud ha sido rechazada";

                $update['estados_id'] = 221; // Rechazo con comentario
            } elseif ($post['tipo_respuesta'] == "proceso_terminado") { // estado 250
                $info_correo['titulo'] = "Solicitud N° " . $solicitud->correlativo . " resuelta";
                $info_correo['contenido'] = "La solicitud N° " . $solicitud->correlativo . " fue resuelta correctamente y se ha agregado el siguiente comentario técnico:";
                $info_correo['h3'] = $update['observacion_tecnica'];
                $info_correo['link'] = base_url('clientes/solicitud/' . $solicitud->correlativo);
                $correo['mensaje'] = $this->load->view('shared/_correo_view', $info_correo, TRUE);
                $correo['para'] = $cliente->correo;
                $correo['nombre_remitente'] = 'Soporte Tickets';
                $correo['asunto'] = 'La solicitud N°' . $solicitud->correlativo . ' resuelta correctamente';
                enviar_correo_sendgrid($correo);

                $desc_bitacora = "La solicitud ha sido resuelta";
            }
            $this->general_model->update_row('solicitudes', $update, $post['solicitud_id']);

            //Ingreso bitacora
            $bitacora['solicitudes_id'] = $solicitud->id;
            $bitacora['descripcion'] = $desc_bitacora;
            $bitacora['estados_id'] = $update['estados_id'];
            $this->general_model->insert('bitacora', $bitacora);

            response . redirect(base_url() . 'gestion/mis_solicitudes');
        }
        $data['solicitud'] = $this->general_model->get_row_by_pk('solicitudes', $solicitud_id);
        $data['solicitud']->estado = $this->general_model->get_value_by_pk("estados", $data['solicitud']->estados_id, "nombre");
        $data['solicitud']->producto = $this->general_model->get_value_by_pk("productos", $data['solicitud']->productos_id, "nombre");
        $data['comentarios'] = $this->clientes_model->traer_comentarios($data['solicitud']->id);
        $data['bitacora'] = $this->general_model->get_result_by_where('bitacora', array('solicitudes_id' => $data['solicitud']->id), '', array('id' => 'desc'));
        $data['cliente'] = $this->general_model->get_row_by_pk('clientes', $data['solicitud']->clientes_id);
        $data['empresa'] = $this->general_model->get_row_by_pk('empresas', $data['cliente']->empresas_id);

        $data['active_mias'] = " active ";
        $data['titulo'] = "Gestión solicitud";
        $data['hidden'] = array('flag' => 1);

        $data['main_content'] = 'gestion/gestionar_solicitud_view';
        $this->load->view('shared/layout_gestion', $data);
    }

    function guardar_comentarios() {
        $post = $this->input->post();


        $insert['solicitudes_id'] = $post['solicitud_id'];
        $insert['descripcion'] = $post['descripcion'];


        $insert['agentes_id'] = AGENTE_ID;
        $solicitud_id = $this->general_model->insert('comentarios', $insert);

        if (!empty($_FILES['imagen']['name'])) {
            $ruta_carpeta = 'adjuntas_gestion/';
            $nombre_foto = crear_nombre_imagen($_FILES['imagen']['name']);
            $ruta_contenido = $ruta_carpeta . $nombre_foto;
            if (copy($_FILES['imagen']['tmp_name'], $ruta_contenido)) {
                $this->general_model->update_row('comentarios', array('img_1' => $nombre_foto), $solicitud_id);
            }
        }
        //$data['comentarios'] = $this->clientes_model->traer_comentarios($post['solicitud_id']);
        redirect('gestion/gestionar_solicitud/' . $post['solicitud_id']);
    }

    function procesar_solicitud($solicitud_id) {
        $update['etapas_id'] = 20;
        $update['estados_id'] = 210;
        $update['update'] = ahoraServidor();
        $this->general_model->update_row('solicitudes', $update, $solicitud_id);

        //Ingreso bitacora
        $bitacora['solicitudes_id'] = $solicitud_id;
        $bitacora['descripcion'] = "Se procesa la solicitud";
        $bitacora['estados_id'] = $update['estados_id'];
        $this->general_model->insert('bitacora', $bitacora);

        //envio correo
        $solicitud = $this->general_model->get_row_by_pk('solicitudes', $solicitud_id);
        $cliente = $this->general_model->get_row_by_pk('clientes', $solicitud->clientes_id);

        $info_correo['titulo'] = "Solicitud N° " . $solicitud->correlativo . " Está siendo procesada";
        $info_correo['contenido'] = 'La solicitud N° ' . $solicitud->correlativo . ' Fue recepcionada correctamente y está siendo procesada por el equipo de soporte.';
        $info_correo['link'] = base_url('clientes/solicitud/' . $solicitud->correlativo);
        $correo['mensaje'] = $this->load->view('shared/_correo_view', $info_correo, TRUE);
        $correo['para'] = $cliente->correo;
        $correo['nombre_remitente'] = 'Soporte Tickets';
        $correo['asunto'] = 'La solicitud N°' . $solicitud->correlativo . ' Está siendo procesada';

        enviar_correo_sendgrid($correo);



        response . redirect(base_url() . 'gestion/gestionar_solicitud/' . $solicitud_id);
    }

    function rechazar_solicitud($solicitud_id) {
        $update['etapas_id'] = 20;
        $update['estados_id'] = 220;
        $update['update'] = ahoraServidor();
        $this->general_model->update_row('solicitudes', $update, $solicitud_id);
        response . redirect(base_url() . 'gestion/gestionar_solicitud/' . $solicitud_id);
    }

    function cerrar_solicitud($solicitud_id) {
        $update['etapas_id'] = 30;
        $update['estados_id'] = 300;
        $update['update'] = ahoraServidor();
        $this->general_model->update_row('solicitudes', $update, $solicitud_id);

        $solicitud = $this->general_model->get_row_by_pk('solicitudes', $solicitud_id);
        $cliente = $this->general_model->get_row_by_pk('clientes', $solicitud->clientes_id);

        $info_correo['titulo'] = "Solicitud N° " . $solicitud->correlativo . " Cerrada";
        $info_correo['contenido'] = 'La solicitud N° ' . $solicitud->correlativo . ' fue cerrada correctamente.';
        $info_correo['link'] = base_url('clientes/solicitud/' . $solicitud->correlativo);
        $correo['mensaje'] = $this->load->view('shared/_correo_view', $info_correo, TRUE);
        $correo['para'] = $cliente->correo;
        $correo['nombre_remitente'] = 'Soporte Tickets';
        $correo['asunto'] = 'La solicitud N°' . $solicitud->correlativo . ' ha sido cerrada';

        enviar_correo_sendgrid($correo);

        //Ingreso bitacora
        $bitacora['solicitudes_id'] = $solicitud_id;
        $bitacora['descripcion'] = "Se cierra la solicitud";
        $this->general_model->insert('bitacora', $bitacora);

        response . redirect(base_url() . 'gestion/gestionar_solicitud/' . $solicitud_id);
    }

    function solicitud_cerrada($solicitud_id) {
        $data['solicitud'] = $this->general_model->get_row_by_pk('solicitudes', $solicitud_id);
        $data['solicitud']->estado = $this->general_model->get_value_by_pk("estados", $data['solicitud']->estados_id, "nombre");
        $data['comentarios'] = $this->clientes_model->traer_comentarios($data['solicitud']->id);
        $data['bitacora'] = $this->general_model->get_result_by_where('bitacora', array('solicitudes_id' => $data['solicitud']->id), '', array('id' => 'desc'));
        $data['solicitud']->producto = $this->general_model->get_value_by_pk("productos", $data['solicitud']->productos_id, "nombre");
        $data['cliente'] = $this->general_model->get_row_by_pk('clientes', $data['solicitud']->clientes_id);
        $data['empresa'] = $this->general_model->get_row_by_pk('empresas', $data['cliente']->empresas_id);
        $data['active_cerradas'] = " active ";
        $data['titulo'] = "Solicitud cerrada";
        $data['main_content'] = 'gestion/solicitud_cerrada_view';
        $this->load->view('shared/layout_gestion', $data);
    }

    function cambiar_pass() {
        $post = $this->input->post();
        if ($post['flag']) {

            $where['id'] = AGENTE_ID;
            $where['password'] = do_hash($post['actual']);
            $agente = $this->general_model->get_row_by_where('agentes', $where);

            if (!empty($agente)) {

                if ($post['nueva'] == $post['nueva2'] && strlen($post['nueva']) > 0) {
                    $update['password'] = do_hash(trim($post['nueva']));
                    $this->general_model->update_row('agentes', $update, $agente->id);
//						pre_die($this->db->last_query());
                    $this->session->set_flashdata('mensaje', 'La password fue cambiada correctamente');
                } else {
                    $this->session->set_flashdata('mensaje', 'Las password no coinciden');
                }
            } else {
                $this->session->set_flashdata('mensaje', 'Las password actual no es correcta');
            }
            response . redirect(base_url() . 'gestion/cambiar_pass/');
        }
        $data['mensaje'] = $this->session->flashdata("mensaje");
        $data['titulo'] = "Cambiar password";
        $data['hidden'] = array('flag' => 1);
        $data['main_content'] = 'shared/_cambiar_pass_view';
        $this->load->view('shared/layout_gestion', $data);
    }

}
