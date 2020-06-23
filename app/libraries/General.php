<?php
    class General
    {
        function sesion($array)
        {
            if(!isset($array['habilitado']))
            {
                print_r();
                die('P&aacute;gina con acceso restringido. <a href="/admin?url='.$_SERVER['REDIRECT_URL'].'">Click aqu&iacute; para hacer login</a>');
            }
            else
            {
                return 1;
            }
        }
    }