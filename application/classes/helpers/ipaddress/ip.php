<?php

namespace Classes\Helpers\Ipaddress;
use Classes\Helpers\filters\Input;

class Ip
{
    // gets ip
    public static function get_client_ip()
    {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if (getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if (getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if (getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if (getenv('HTTP_FORWARDED'))
            $ipaddress = getenv('HTTP_FORWARDED');
        else if (getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';

        return $ipaddress;
    }

    

   

    // this functions gets the city, state, country of an ipaddress
    public static function ip_info()
    {

        $a = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.self::get_client_ip()));
       
           $a = Input::filter_text($a);
       
        return  $a;
        
    }
    
  
    
   
}

?>
