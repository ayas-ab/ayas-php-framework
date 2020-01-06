<?php
namespace Classes;
// Helper file, to manage previous post values.
class Last_form_session
{

    private $exceptions;

    public function __construct()
    {
        $this->exceptions = Array(
            'password'
        );
        if (! isset($_SESSION['last_form_session'])) {
            $_SESSION['last_form_session'] = Array();
        }

        $this->clear_old_values();
    }

    //$timer is in seconds. 
    public function add_form($form_name, $timer)
    {
        foreach ($_POST as $key => $value) {
            if (! in_array($key, $this->exceptions)) {
                $_SESSION['last_form_session'][$form_name][$key] = $value;
                $_SESSION['last_form_session'][$form_name]['expire'] = time() + $timer;
            }
        }
    }

    public function add_exception($name)
    {
        $this->exception[] = $name;
    }

    public function clearForms()
    {

        $_SESSION['last_form_session'] = [];
    }

    public function clearForm($form_name)
    {
        try{
        array_splice($_SESSION['last_form_session'], array_search($form_name, array_keys($_SESSION['last_form_session'])), 1);
        }catch(\Exception $e)
        {
            
        }
    }

    // function to get last session value
    public function getLastFormValue($form_name, $element = null)
    {
        $a = "";
        if (isset($_SESSION['last_form_session'][$form_name])) {

            if ($_SESSION['last_form_session'][$form_name]['expire'] > time()) {
                
                if ($element == null)
                {
                $a = $_SESSION['last_form_session'][$form_name];
                }else
                {
                    if(isset( $_SESSION['last_form_session'][$form_name][$element]))
                    {
                        $a = $_SESSION['last_form_session'][$form_name][$element];
                        
                    }
                }
            } else {
                $this->clearForm($form_name);
            }
        }

        return $a;
    }

    public function clear_old_values()
    {
        foreach ($_SESSION['last_form_session'] as $key => $value) {
            if ($value['expire'] < time()) {

                $this->clearForm($key);
            }
        }
    }

    // function to get last session value
    public function geAlltLastFormValue()
    {
        return $_SESSION['last_form_session'];
    }
}

?>