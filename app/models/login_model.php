<?php
    class login_model extends CI_Model
    {   
        function ingresar($correo, $pass)
        {
          	$where = array
        	(
        	    'u.correo'   => $correo,
                'u.password' => do_hash($pass)
        	);
			$this->db->select('*');
            $this->db->where($where);
			$this->db->from('clientes');
    	    $query = $this->db->get(); 
        	return $query->row();
        }
        function buscar_usuario($user)
        {
        	$sql="SELECT nombre, pass FROM usuario where nombre = '$user'";
        	$query = $this->db->query($sql);
        	return $query->result();
        }
        function dataUsuario($tabla, $usuarioId)
        {
    	    $this->db->from($tabla);
    	    $this->db->where('usuario_id', $usuarioId);
    	    $query = $this->db->get();
    	    return $query->result();
        }
		function trae_todo($tabla)
		{
			//$this->db->order_by('nombre', 'ASC');
			return $this->db->get($tabla)->result();
		}
		
		function crear_nuevo()
		{
			$this->db->insert('solicitudes', $this->input->post('data'));
			return $this->db->insert_id();
		}
		
		public function listar_solicitudes($estados_id)
		{
			if(!empty($estados_id))
			{
				if($estados_id > 0)
				{
					$this->db->where('sol.estados_id', $estados_id);
				}
			}
			$this->db->select('sol.*, dir.nombre ubicacion, est.nombre estado, if(usu.nombre IS NULL,"Sin asignar",usu.nombre) responsable', FALSE);
			$this->db->where('sol.contactos_id', 4);
			$this->db->order_by('sol.id', DESC);
			$this->db->join('direcciones dir', 'sol.direcciones_id = dir.id');
			$this->db->join('estados est', 'sol.estados_id = est.id');
			$this->db->join('usuarios usu', 'sol.usuarios_id = usu.id', LEFT);
			$this->db->limit(6);
			$query = $this->db->get('solicitudes sol');
    	    return $query->result();
		}
		
		public function mostrar_solicitud($id)
		{
			$this->db->select('sol.*, dir.nombre ubicacion, est.nombre estado, if(usu.nombre IS NULL AND sol.estados_id = 1,"Sin asignar",usu.nombre) responsable', FALSE);
			$this->db->where('sol.id', $id);
			$this->db->join('direcciones dir', 'sol.direcciones_id = dir.id');
			$this->db->join('estados est', 'sol.estados_id = est.id');
			$this->db->join('usuarios usu', 'sol.usuarios_id = usu.id', LEFT);
			$query = $this->db->get('solicitudes sol');
    	    return $query->row();
		}

		public function mostrar_contacto($id)
		{
			$this->db->select('usu.*, con.clientes_id, con.usuarios_id');
			$this->db->from('usuarios usu');
			$this->db->where('usu.id', $id);
			$this->db->join('contactos con', 'usu.id = con.usuarios_id');
			$query = $this->db->get();
    	    return $query->row();
		}

		public function mostrar_cliente($id)
		{
			$this->db->where('id', $id);
			$query = $this->db->get('clientes');
    	    return $query->row();
		}
		
		function evaluar_atencion($data, $where)
		{
			$this->db->update('solicitudes', $data, $where);
			return 1;
		}

		public function listar_solicitudes_pendientes()
		{
			$this->db->select('sol.*, dir.nombre ubicacion, est.nombre estados', FALSE);
			$this->db->where('sol.estados_id', 1);
			$this->db->order_by('sol.id', DESC);
			$this->db->join('direcciones dir', 'sol.direcciones_id = dir.id');
			$this->db->join('estados est', 'sol.estados_id = est.id');
			$query = $this->db->get('solicitudes sol');
    	    return $query->result();
		}
		
		public function traer_usuarios($rol)
		{
			if(!empty($rol))
			{
				$this->db->where('roles_id', $rol);
			}
			$query = $this->db->get('usuarios');
    	    return $query->result();
		}

		public function actualizar($tabla, $data, $where)
		{
			$this->db->update($tabla, $data, $where);
			return 1;
		}
		
		public function listar_solicitudes_asignadas($usuarios_id, $estados_id)
		{
			$this->db->select('sol.*, dir.nombre ubicacion, est.nombre estado', FALSE);
			$this->db->where('sol.usuarios_id', $usuarios_id);
			if(!empty($estados_id))
			{
				if($estados_id > 0)
				{
					$this->db->where('sol.estados_id', $estados_id);
				}
			}
			$this->db->order_by('sol.id', DESC);
			$this->db->join('direcciones dir', 'sol.direcciones_id = dir.id');
			$this->db->join('estados est', 'sol.estados_id = est.id');
			$query = $this->db->get('solicitudes sol');
    	    return $query->result();
		}

		function traer_filtro_estados($array)
		{
			$this->db->where_in('id', $array);
			return $this->db->get('estados')->result();
		}
    }