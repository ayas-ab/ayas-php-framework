<?php
namespace Core;
class Route
{

    public $name;

    public $url;

    public $controller;
    public $active;

    public static $routes = Array();

    function __construct($name, $url, $controller)
    {
        $this->name = $name;
        $this->url = $url;
        $this->controller = $controller;
        $this->active = false;
    }

    public static function add($name, $url, $controller)
    {
        Route::$routes[] = new Route($name, $url, $controller);
    }
    

    public static function get_controller_by_name($n) : Route
    {
        foreach (Route::$routes as $r) {
            if ($r->name == $n) {
                return $r;
            }
        }
        return null;
    }
    
    public static function get_urls()
    {
        $return_array = [];
        foreach (Route::$routes as $r) {
            $return_array[$r->name]['url'] = BASE_URL.$_SESSION['lang'].'/'.$r->url.'/';
            $return_array[$r->name]['active'] = false;
        }
        
        return $return_array;
       
        
    }
}

?>