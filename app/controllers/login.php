<?php
    class Login extends CI_Controller
    {
        public function  __construct()
        {
            parent::__construct();
            $this->load->model('login_model');
              $this->load->model('clientes_model');
               $this->load->model('gestion_model');
                              $this->load->model('administracion_model');
            $this->load->library('session');
            $this->load->helper('email'); 
			$this->load->library('general_model');
                        $this->load->model('mantenedores/mantenedor_general_model');
                        $this->load->model('administracion_model');
        }
		
		function index()
		{
			
			$data['cliente'] = "active in";
            $data['hidden'] = array('flag' => 'cliente');
            $data['title']='Login: Ingrese con sus datos';
            $data['main_content'] = 'login/login_view';
            $this->load->view('shared/layout_login', $data);		
		}
		
        public function cliente()
        {
            $where   = $this->input->post('cliente');
     
			$where['password'] =do_hash(trim($where['password']));
                       $where['correo'] = ($where['correo']);
			$where['activo'] = TRUE;
			$result = $this->general_model->get_row_by_where('clientes', $where);
                       
			
            if(!empty($result))
            {
                if($result->tipo==1)
                {
                 $usuario_data = array(
                    'correo' => $result->correo,
                         'nombre' => $result->nombre);
				$hash = sha1(mt_rand());
                $this->general_model->update_row('clientes', array('remember_token'=> $hash), $result->id,$result->correo);
                $this->session->set_userdata('token_cliente', $hash);
                $this->session->set_userdata($usuario_data);
              
                response.redirect("/clientes_admin");
                }else
                {
                 if($result->tipo==2)
                {
                 $usuario_data = array(
                    'correo' => $result->correo,
                         'nombre' => $result->nombre);
				$hash = sha1(mt_rand());
                $this->general_model->update_row('clientes', array('remember_token'=> $hash), $result->id,$result->correo);
                $this->session->set_userdata('token_cliente', $hash);
                $this->session->set_userdata($usuario_data);
              
                response.redirect("/clientes");
				
			}
            }
            }
            else{
                        $this->session->set_flashdata('error_login',' <div class="alert alert-danger" >" <strong>El correo o la password son incorrectos</strong> </div>');
                        response.redirect("/");}
               
                        
            
        }

		public function agente()
        {
            $where   = $this->input->post('agente');
			$where['password'] = do_hash(trim($where['password']));
			$where['activo']   = TRUE;
			$result = $this->general_model->get_row_by_where('agentes', $where);
            if(!empty($result))
            {
                 $usuario_data = array(
                    'correo' => $result->correo,
                          'nombre' => $result->nombre);
				$hash = sha1(mt_rand());
                               
                $this->general_model->update_row('hd_agentes', array('remember_token'=> $hash), $result->id);
                $this->session->set_userdata('token_agente', $hash);
                 $this->session->set_userdata($usuario_data);
                response.redirect("/gestion");
            }
            else
			{
				$this->session->set_flashdata('error_login',' <div class="alert alert-danger" >" <strong>El correo o la password son incorrectos</strong> </div>');
				response.redirect("/");
			}
        }

		function admin()
		{
			$post = $this->input->post();
			if($post['flag'])
			{
				$where   = $this->input->post('admin');
				$where['password'] = do_hash(trim($where['password']));
				$where['activo'] = TRUE;
				$result = $this->general_model->get_row_by_where('hd_backoffices', $where);
				
	            if(!empty($result))
	            {
                        $usuario_data = array(
                    'correo' => $result->correo,
                          'nombre' => $result->nombre);
					$hash = sha1(mt_rand());
	                $this->general_model->update_row('hd_backoffices', array('remember_token'=> $hash), $result->id);
	                $this->session->set_userdata('token_admin', $hash);
                        $this->session->set_userdata($usuario_data);
	                response.redirect("/administracion");
	            }
	            else
				{
					$this->session->set_flashdata('error_login', 'El correo o la password son incorrectos');
					//response.redirect("/login/admin");
				}
			}
			$data['title']='Login: Ingrese con sus datos';
            $data['main_content'] = 'login/login_admin_view';
            $this->load->view('shared/layout_login', $data);
		}
	public function recupera_contrasena_admin()
		{
                    $data['h1'] = "Recuperar contraseÃ±a";
            $data['hidden'] = array('flag' => 1);
            $data['title']='Login: Ingrese con sus datos';
            $data['main_content'] = 'login/login_recuperaContrasena_admin_view';
             
			$data['accion'] = 0;
			$post = (object)$this->input->post('data');
                        $password = genera_password();
			$data['password'] = sha1($password);
                     
			if(!empty($post->correo))
			{
				$data['accion'] = 1;
                               $data['correo'] = $post->correo;
				$dato =array(
                                    'remember_token'=>null,
                                    'password'=>$data['password']
                                );
                              
                              $id=  $this->administracion_model->getid($post->correo);
                               $this->mantenedor_general_model->actualizar($id->id, $dato, 'hd_backoffices','id');
                               
                               
                              
				$info_correo['titulo']    = " Hitch Help";
				$info_correo['contenido'] = "Se ha generado un nuevo password, recuerde cambiarlo al iniciar sesion ";
				$info_correo['h3']        = 'Su password nueva es: '.$password;
					
				$mail['mensaje']          = $this->load->view('shared/_correo_view',$info_correo,TRUE);
				$mail['asunto']  = 'Solicitud Recuperar Contraseña';
				$mail['para'] =$post->correo;
                               enviar_correo_sendgrid($mail);
                             
                               }

 $this->load->view('shared/layout_login', $data);

		}
		public function recupera_contrasena()
		{
                    $data['h1'] = "Recuperar contraseÃ±a";
            $data['hidden'] = array('flag' => 1);
            $data['title']='Login: Ingrese con sus datos';
            $data['main_content'] = 'login/login_recuperaContrasena_view';
             
			$data['accion'] = 0;
			$post = (object)$this->input->post('data');
                        $password = genera_password();
			$data['password'] = sha1($password);
                     
			if(!empty($post->correo) && !empty($post->user))
			{
				$data['accion'] = 1;
                               $data['correo'] = $post->correo;
				$dato =array(
                                    'remember_token'=>null,
                                    'password'=>$data['password']
                                );
                                
                               if($post->user=='cliente'){
                              $id=  $this->clientes_model->getid($post->correo);
                               $this->mantenedor_general_model->actualizar($id->id, $dato, 'hd_clientes','id');
                               }else{
                                   if($post->user=='agente')
                                   {
                                        $id=  $this->gestion_model->getid($post->correo);
                               $this->mantenedor_general_model->actualizar($id->id, $dato, 'hd_agentes','id');
                                   }
                               }
                              
				$info_correo['titulo']    = " Hitch Help";
				$info_correo['contenido'] = "Se ha generado un nuevo password, recuerde cambiarlo al iniciar sesion ";
				$info_correo['h3']        = 'Su password nuevo es: '.$password;
					
				$mail['mensaje']          = $this->load->view('shared/_correo_view',$info_correo,TRUE);
				$mail['asunto']  = 'Solicitud Recuperar Password';
				$mail['para'] =$post->correo;
                               enviar_correo_sendgrid($mail);
                             
                               }
          $this->load->view('shared/layout_login', $data);
		}

		function cerrar_sesion()
		{
			foreach($this->session->userdata as $key => $row)
            {
            	$this->session->unset_userdata($key);
			}
			$data['main_content'] = 'login/logout_view';
            $data['title'] = 'Saliendo';
            $this->load->view('shared/layout_login', $data);
		}
    }