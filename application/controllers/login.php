<?php
// password_hash($text, PASSWORD_ARGON2I);
namespace Controllers;

use Core\Controller;
use Core\Route;
use Models\User_model;
use Classes\Auth\Session;
use Classes\Helpers\Filters\Input as myInputFilter;
use Classes\Helpers\Cipher\Open_ssl;
use Classes\Last_form_session;
class Login extends Controller
{

    public $last_form_values;
    
    function __construct()
    {
        $this->last_form_values =  new Last_form_session();
    
        $this->last_form_values->clear_old_values();
        
    }
    public function index()
    {
        $this->set_login_required(false);
        $this->information['page_title'] = 'Login - ' . SITE_NAME;
        $this->information['description'] = "Login page";
        $this->information['nav_urls']['login']['active'] = true;
     
        
        
        
        if ($this->get_logged_user() != null) {
            header('location: '.Route::get_urls()['account']['url']);
            die();
        }

        $this->check_login_attempt();
        $this->information['last_form_values'] = $this->last_form_values->geAlltLastFormValue();
        $this->load_view('login_view.php', $this->information);
    }

    private function check_login_attempt()
    {
        if (isset($_POST['login'])) {
            myInputFilter::Filter_all_posts();

            $myForm = new \Classes\Helpers\Validation\Form();
            $myForm->name('email')
                ->value($_POST['email'])
                ->email()
                ->required();

            $myForm->name('password')
                ->value($_POST['password'])
                ->required();
                $this->last_form_values->add_form('login', 10);
                
            if ($myForm->isSuccess()) {
                $myacc = new User_model();

                $user_exists = $myacc->get_user_by_email($_POST['email']);

                if (! empty($user_exists)) {

                    if (password_verify($_POST['password'], $user_exists->password)) {

                        if (isset($_COOKIE['pb_auth'])) {

                            $myacc->remove_user_session($_COOKIE['pb_auth']);
                        }

                        $hour = time() + (86400 * 2); // seven days.
                        $name = md5(Open_ssl::token_encode(base64_encode(password_hash(rand() . $user_exists->email . uniqid(), PASSWORD_ARGON2I))));
                        $myacc->add_user_session($user_exists->id, myInputFilter::filter_text($_SERVER['HTTP_USER_AGENT']), $name, $hour);

                        Session::set_auth_cookie($hour, $name);
                        $this->last_form_values->clearForm('login');
                        header("Location: " . Route::get_urls()['account']['url']);
                    } else {

                        $this->information['wrong_password'] = 'Wrong password.';
                    }
                } else {
                    $this->information['wrong_email'] = 'This email is does not belong to any account.';
                }
            } else {
                // echo "Validation error!";
                var_dump($myForm->getErrors());
            }
        }
    }

    // end
}

?>