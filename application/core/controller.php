<?php

// ########################################################################
// ######### Class: Controller.class ######################################
// ########################################################################
// ######### This class is used to extend custom made Controllers##########
// #########which are the pages############################################
// ########################################################################
// #########They load important settings required##########################
// #########for custom made controller to work#############################
// ########################################################################
// ########################################################################
namespace Core;

use PDO;
use Classes\Auth\Session as mySession;
use Classes\Helpers\Filters\Input as myInputFilter;
use Classes\Helpers\Ipaddress\Ip as Ip_tools;
use Classes\Helpers\Cipher\Open_ssl as myCipher;

class Controller
{

    private $login_required = null;

    private $logged_user = null;

    private $csrf_check = true;

    // this is information variable array. It is used to store View variables.
    public $information = Array();

    public function set_login_required(bool $value)
    {
        $this->login_required = $value;
        $this->start();
    }

    // this function starts the controller loading some things in
    // to make this run properly
    private function start()
    {
        myInputFilter::Filter_all_gets();
        myInputFilter::Filter_all_cookies();

       
        // error_reporting(0);
        // @ini_set('display_errors', 0);
        

        // Protection againts cros site request forgery

        if ($this->csrf_check) {
            if (! isset($_SESSION['anti_csrf_token'])) {
                $_SESSION['anti_csrf_token'] = myCipher::uniqueToken();
            }
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                
                $clear = true;

                if (isset($_POST['anti_csrf_token'])) {
                    if ($_POST['anti_csrf_token'] == $_SESSION['anti_csrf_token']) {
                        $clear = false;
                        $_SESSION['anti_csrf_token'] = myCipher::uniqueToken();
                    }
                }

                if ($clear) {
                    $_POST = array();
                    $_GET = array();
                }
            }

            
        }
        // end of csrf protection

        $this->checkLogout();
        $this->checkLoginRequirement();
        $this->information['nav_urls'] = Route::get_urls();
        $this->information['directory'] = SITE_DIR;
        $this->information['used_language'] = $_SESSION['lang'];        
        
        
    }

    public function checkLogout()
    {
        if (isset($_GET['logout'])) {
            mySession::destroy();
            header("Location: " . $this->getSiteUrl());
            exit();
        }
    }

    public function checkLoginRequirement()
    {
        $logged_in = mySession::isLoggedIn();

        if ($logged_in != null) {

            $this->information['logged_in_user_info'] = $logged_in;
            $this->logged_user = $logged_in;
        }

        if ($this->login_required && $this->logged_user == null) {

            mySession::destroy();
            header("Location: " . $this->getSiteUrl());
            exit();
        }

        unset($logged_in);
    }

    // needs improvement, later on
    public static function getSiteUrl(): string
    {
   
        return BASE_URL;
    }

    public function getCurrentUrl(bool $https = false): string
    {
        $protocol = "http";
        if($https)
        {
            $protocol = "https";
        }
        return $protocol."://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    }

    public function load_view(string $view, array $data = [])
    {
        /*
         * $loader = new \Twig_Loader_Filesystem('application/views');
         * $twig = new \Twig_Environment($loader);
         * echo $twig->render($view, $data);
         * unset($loader);
         * unset($twig);
         */
        ob_start();
        include_once ('application/views/' . $view);
        echo ob_get_clean();
    }

    public function get_logged_user()
    {
        return $this->logged_user;
    }

    public function getFormToken()
    {
        return '<input type="hidden" name="anti_csrf_token" value="' . $_SESSION['anti_csrf_token'] . '" />';
    }

    public function set_csrf_check($status)
    {
        $this->csrf_check = $status;
    }

    public function redirect_404()
    {
        header('location: ' . BASE_URL . $_SESSION['lang'] . '/' . Route::get_controller_by_name('404')->url . '/', TRUE, 301);
        die();
    }
}

?>