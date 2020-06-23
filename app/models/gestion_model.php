<?php
    class gestion_model extends CI_Model
    {   
        function crear($tabla, $data)
        {
            $this->db->insert($tabla, $data);
            return $this->db->insert_id();
        }
        
        function trae_todo($tabla)
        {
            return $this->db->get($tabla)->result();
        }
        
        function trae_ficha($tabla, $id)
        {
            $this->db->where('id', $id);
            return $this->db->get($tabla)->row();
        }
        
        function actualizar($tabla, $data, $id)
        {
            $this->db->where('id', $id);
            $this->db->update($tabla, $data);
            return 1;
        }
        
        public function traer_solicitud($solicitud_id)
        {
            $this->db->select('s.*, e.nombre estado');
            $this->db->from('solicitudes s');
            $this->db->join('estados e', 'e.id = s.estado_id');
            $this->db->where('s.id', $solicitud_id);
            $query = $this->db->get();
            
            return $query->row();
        }
        
         function getid($param) {
        $this->db->select('id');
         $this->db->from('hd_agentes');
        $this->db->where('correo',$param);
         $query = $this->db->get();
    return $query->row();
                
        
    }
     function getid2($param) {
        $this->db->select('id');
         $this->db->from('hd_solicitudes');
        $this->db->where('correlativo',$param);
         $query = $this->db->get();
    return $query->row();
                
        
    }
        
        public function traer_solicitudes()
        {
            $this->db->select('s.*, e.nombre estado');
            $this->db->from('solicitudes s');
            $this->db->join('estados e', 'e.id = s.estado_id');
            $query = $this->db->get();
            
            return $query->result();
        }
        
        public function traer_observaciones($solicitud_id)
        {
            $this->db->select('o.*, u.nombre usuario');
            $this->db->from('observaciones o');
            $this->db->join('usuarios u', 'u.id = o.usuario_id');
            $this->db->where('o.solicitud_id', $solicitud_id);
            $this->db->order_by('id', 'desc');
            $query = $this->db->get();
            
            return $query->result();
        }
        
        function contar_solicitudes($solicitudes_id, $usuario_id)
        {
            $this->db->where('responsable_id', $usuario_id);
            $this->db->where_in('estado_id ', array(1,2,3));
            $this->db->from('solicitudes');
            return $this->db->count_all_results();
        }
        
        public function traer_tareas()
        {
            $this->db->select('s.*, e.nombre estado');
            $this->db->from('solicitudes s');
            $this->db->join('estados e', 'e.id = s.estado_id');
            $this->db->where('s.responsable_id', $this->session->userdata('id'));
            $query = $this->db->get();
            
            return $query->result();
        }
        
        public function traer_responsable($solicitudes_id)
        {
            $this->db->select('u.nombre');
            $this->db->from('usuarios u');
            $this->db->join('solicitudes s', 'u.id = s.responsable_id');
            $this->db->where('s.id', $solicitudes_id);
            $query = $this->db->get();
            
            return $query->row()->nombre;
        }
        
        function traer_falla($falla_id)
        {
            $this->db->where('id', $falla_id);
            $query = $this->db->get('fallas');
            
            return $query->row()->nombre;
        }
        
        public function traer_bitacora($solicitud_id)
        {
            $this->db->select('b.*, bt.nombre tipo, u.nombre usuario');
            $this->db->from('bitacora b');
            $this->db->join('bitacora_tipos bt', 'bt.id = b.bitacora_tipo_id');
            $this->db->join('usuarios u', 'u.id = b.usuario_id');
            $this->db->where('b.solicitud_id', $solicitud_id);
            $this->db->order_by('id', 'desc');
            $query = $this->db->get();
            
            return $query->result();
        }
        
        public function numero_usuario()
    {
        return $this->db->count_all('hd_solicitudes');
    }
     public function getblog($limit) 
    {
          $this->db->join('hd_solicitudes', 'hd_solicitudes.estados_id = hd_estados.id');
     
       $dato=  $this->db->get('hd_estados',$limit,$this->uri->segment(3));
       return $dato->result_array();
               
    }
    
    function paginar_tabla($por_pagina, $pagina)
{
    $this->db->select('solicitudes.id AS solicitudes_id, solicitudes.empresas_id AS solicitudes_empresas_id, solicitudes.clientes_id AS solicitudes_clientes_id, solicitudes.agentes_id AS solicitudes_agentes_id, solicitudes.etapas_id AS solicitudes_etapas_id, solicitudes.estados_id AS solicitudes_estados_id, solicitudes.tipo_id AS solicitudes_tipo_id, solicitudes.productos_id AS solicitudes_productos_id, solicitudes.correlativo AS solicitudes_correlativo, solicitudes.titulo AS solicitudes_titulo, solicitudes.descripcion AS solicitudes_descripcion, solicitudes.observacion_tecnica AS solicitudes_observacion_tecnica, solicitudes.motivo_rechazo AS solicitudes_motivo_rechazo, solicitudes.img_1 AS solicitudes_img_1, solicitudes.img_2 AS solicitudes_img_2, solicitudes.img_3 AS solicitudes_img_3, solicitudes.create AS solicitudes_create, solicitudes.update AS solicitudes_update, solicitudes.id_correo AS solicitudes_id_correo, estados.id AS estados_id, estados.nombre AS estados_nombre, estados.activo AS estados_activo, estados.create AS estados_create, estados.update AS estados_update, estados.etapas_id AS estados_etapas_id');
    $this->db->from('solicitudes');
    $this->db->join('estados', 'solicitudes.estados_id = estados.id');
    $this->db->where(array(
        'solicitudes.etapas_id' => 10,
        'solicitudes.estados_id' => 100
    ));
    $this->db->order_by('solicitudes.id', 'desc');
    $this->db->limit($por_pagina, $pagina);

	$query = $this->db->get();
	return $query->result();
}
    }