<?php
    if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    $route['default_controller']                     = "login";
    $route['404_override']                           = '';
	$route['salir']                                  = "login/cerrar_sesion";
	
	$route['admin']                                  = "administracion";
	

/* End of file routes.php */
/* Location: ./application/config/routes.php */

$route['mantenedores/empresas/([0-9]+)/ficha']  = 'mantenedores/mantenedor_empresas/empresas_ficha/$1';
$route['mantenedores/empresas/([0-9]+)/editar'] = 'mantenedores/mantenedor_empresas/empresas_editar/$1';
$route['mantenedores/empresas/listar'] = 'mantenedores/mantenedor_empresas';
$route['mantenedores/empresas/nuevo'] = 'mantenedores/mantenedor_empresas/empresas_crear';
$route['mantenedores/empresas/([0-9]+)/eliminar'] = 'mantenedores/mantenedor_empresas/eliminar_empresas/$1';

$route['mantenedores/agentes/([0-9]+)/ficha']  = 'mantenedores/mantenedor_agentes/agentes_ficha/$1';
$route['mantenedores/agentes/([0-9]+)/editar'] = 'mantenedores/mantenedor_agentes/agentes_editar/$1';
$route['mantenedores/agentes/listar'] = 'mantenedores/mantenedor_agentes';
$route['mantenedores/agentes/nuevo'] = 'mantenedores/mantenedor_agentes/agentes_crear';
$route['mantenedores/agentes/([0-9]+)/eliminar'] = 'mantenedores/mantenedor_agentes/eliminar_agentes/$1';

$route['mantenedores/clientes/([0-9]+)/ficha']  = 'mantenedores/mantenedor_clientes/clientes_ficha/$1';
$route['mantenedores/clientes/([0-9]+)/editar'] = 'mantenedores/mantenedor_clientes/clientes_editar/$1';
$route['mantenedores/clientes/listar'] = 'mantenedores/mantenedor_clientes';
$route['mantenedores/clientes/nuevo'] = 'mantenedores/mantenedor_clientes/clientes_crear';
$route['mantenedores/clientes/([0-9]+)/eliminar'] = 'mantenedores/mantenedor_clientes/eliminar_clientes/$1';

$route['mantenedores/productos/([0-9]+)/ficha']  = 'mantenedores/mantenedor_productos/productos_ficha/$1';
$route['mantenedores/productos/([0-9]+)/editar'] = 'mantenedores/mantenedor_productos/productos_editar/$1';
$route['mantenedores/productos/listar'] = 'mantenedores/mantenedor_productos';
$route['mantenedores/productos/nuevo'] = 'mantenedores/mantenedor_productos/productos_crear';
$route['mantenedores/productos/([0-9]+)/eliminar'] = 'mantenedores/mantenedor_productos/eliminar_productos/$1';

$route['mantenedores/usuarios/([0-9]+)/ficha']  = 'mantenedores/mantenedor_usuarios/usuarios_ficha/$1';
$route['mantenedores/usuarios/([0-9]+)/editar'] = 'mantenedores/mantenedor_usuarios/usuarios_editar/$1';
$route['mantenedores/usuarios/listar'] = 'mantenedores/mantenedor_usuarios';
$route['mantenedores/usuarios/nuevo'] = 'mantenedores/mantenedor_usuarios/usuarios_crear';
$route['mantenedores/usuarios/([0-9]+)/eliminar'] = 'mantenedores/mantenedor_usuarios/eliminar_usuarios/$1';