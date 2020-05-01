<?php

// ####################################################
// ######### Class: Application.class #################
// ####################################################
// ######### This class runs the application##########
// ####################################################

// ROUTING NEEDs IMPROVEMNT
namespace Core;

date_default_timezone_set(SERVER_DEFAULT_TIMEZONE);
use Classes\Helpers\Filters\Input as myInputFilter;
session_regenerate_id();
use Controllers;

class application
{

    // dont change this "home".
    private $controller = "home";

    function __construct()
    {
        $_SESSION['lang'] = LANG;

        $this->load_routes();
        $url = $this->sanatize();
        $params = Array();

        // routing needs a rework
        if (empty($url)) {

            header('location: ' . BASE_URL . $_SESSION['lang'] . '/' . Route::get_controller_by_name($this->controller)->url . '/', TRUE, 301);
        } else {

            global $server_existing_langs;
            // setting the language.
            $lang_detected = $this->check_lang($server_existing_langs, $url);

            if ($lang_detected == false) {
                $temp_controller = Route::get_controller_by_name('404');
                $split_controller = explode('/', $temp_controller->controller);
                $this->controller = $split_controller[0];
            } else {

                if (! empty($url)) {

                    $check_route = $this->check_route($url);

                    $temp_controller = $check_route[0];
                    $params = $check_route[1];

                    if ($temp_controller == null) {

                       // $temp_controller = Route::get_controller_by_name('404');
                       // header("HTTP/1.0 404 Not Found");
                        header('location: ' . BASE_URL . $_SESSION['lang'] . '/' . Route::get_controller_by_name($this->controller)->url . '/', TRUE, 301);
                        die();
                        
                    }
                    $split_controller = explode('/', $temp_controller->controller);
                    $controller_name = $split_controller[0];

                    unset($url);
                } else {
                    header('location: ' . BASE_URL. $_SESSION['lang'] . '/' . Route::get_controller_by_name($this->controller)->url . '/', TRUE, 301);
                    die();
                }

                if ($temp_controller != null) {

                    if (file_exists('application/controllers/' . $controller_name . '.php')) {
                        $this->controller = $controller_name;
                    }
                } else {

                 
                    $temp_controller = Route::get_controller_by_name('404');
                    $split_controller = explode('/', $temp_controller->controller);
                    $this->controller = $split_controller[0];
                }
            }
        }

        include_once ("application/controllers/" . $this->controller . ".php");
        $this->controller = 'Controllers\\' . $this->controller;

        $this->controller = new $this->controller();

        $final_method = 'index';

        if (isset($split_controller[1])) {

            if (method_exists($this->controller, $split_controller[1])) {
                $function = $split_controller[1];

                if (is_callable(array(
                    $this->controller,
                    $split_controller[1]
                ))) {
                    $final_method = $function;
                } else {

                    $this->controller = null;
                    $this->controller = 'error_404';
                    include ("application/controllers/" . $this->controller . ".php");

                    $this->controller = 'Controllers\\' . $this->controller;

                    $this->controller = new $this->controller();
                }
            }
        }
        
        $params = myInputFilter::filter_text($params);
        
        call_user_func_array([
            $this->controller,
            $final_method
        ], $params);
    }

    // make it as explode url, check inside lag array, if yes, remove it, and
    // add the session lang
    public function check_lang(array $languages, string &$url)
    {
        $url_lang = explode('/', $url)[0];
        if (in_array($url_lang, $languages)) {
            $_SESSION['lang'] = $url_lang;
            $url = str_replace($url_lang . '/', '', $url);
            return true;
        }

        return false;
    }

    
public function check_route(string $url)
    {
        $url = explode("/", $url);
        $params = [];
        $matching_controller = null;
        foreach (\Core\Route::$routes as $r) {

            $get_r_elements = explode("/", $r->url);

            $exists = true;
            if (count($url) >= count($get_r_elements)) {
                foreach ($get_r_elements as $key => $value) {

                    if ($value != $url[$key]) {

                        $exists = false;
                    }
                }

                if ($exists) {

                    if (sizeof($url) > sizeof($get_r_elements)) {
                        $size = (sizeof($url) - sizeof($get_r_elements)) * - 1;

                        $params = array_splice($url, $size, 1);
                    }

                    if ($matching_controller != null) {
                        if (strlen($matching_controller['controller_object']->url) < strlen($r->url)) {
                            $params = [];
                            if (sizeof($url) > sizeof($get_r_elements)) {
                                $size = (sizeof($url) - sizeof($get_r_elements)) * - 1;

                                $params = array_splice($url, $size, 1);
                            }

                            $matching_controller = [
                                'controller_object' => $r,
                                'params' => $params
                            ];
                        }
                    } else {
                        $matching_controller = [
                            'controller_object' => $r,
                            'params' => $params
                        ];
                    }
                }
            }
        }

        return [
            $matching_controller['controller_object'],
            $matching_controller['params']
        ];
    }

    public function load_routes()
    {
        require_once ('application/routes.php');
    }

    public function sanatize()
    {
        if (isset($_GET['MyNameIsAyasAbdulhadi'])) {

            return $url = filter_var(rtrim($_GET['MyNameIsAyasAbdulhadi'], '/'), FILTER_SANITIZE_URL);
        }
    }
}

?>
