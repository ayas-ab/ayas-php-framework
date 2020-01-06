<?php
namespace Controllers;

use Core\Controller;
use Classes\Helpers\Validation\Form as form_validator;
use Models\User_model;
use Classes\Helpers\Filters\Input as myInputFilter;
use Classes\Helpers\Html\Alerts as MyAlerts;
use Classes\Helpers\Cipher\Open_ssl;
use Classes\Last_form_session;
use Classes\Helpers\Html\Jquery_validation;
use Core\Route;
use Classes\Helpers\Ipaddress\Ip as ip_tools;

class Account extends Controller
{

    public $account_model;
    public $ssl;
    public $html_alerts;

    public function __construct()
    {
        $this->account_model = new User_model();
        
        
        $this->ssl = new Open_ssl();
        $this->html_alerts = new MyAlerts();
        
        $this->last_form_values =  new Last_form_session();
        $this->last_form_values->clear_old_values();
    }

    public function profile()
    {
        //you must be logged in to access this page.
        $this->set_login_required(true);
        $this->information['page_title'] = 'Profile Page';
        $this->information['description'] = "Just a sample profile page";
        $this->information['nav_urls']['account']['active'] = true;

        $this->load_view('account/account_view.php', $this->information);
    }

    public function edit()
    {
        //you must be logged in to access this page.
        $this->set_login_required(true);
        
        $this->information['page_title'] = 'Account';
        $this->information['description'] = "My account";
        $this->information['nav_urls']['edit_account']['active'] = true;
        $this->check_edit_account();

        
        //JqueryValidation PHP wrapper for quick browserside validation
        // Example
        $client_validation =  new Jquery_validation('#edit_account_validate');
        $client_validation->addRule('fname')->required(true)->minlength(3)->maxlength(50)->lettersonly();
        $client_validation->addRule('lname')->required(true)->minlength(3)->maxlength(50)->lettersonly();
        $client_validation->addRule('number')->required(true)->isDigit()->maxlength(10)->minlength(10);
        $client_validation->addRule('password')->required(true)->minlength(5);
        
        $this->information['validation_js'] = $client_validation->getJs();
        
        $this->load_view('account/edit_account_view.php', $this->information);
    }
    
    public function create()
    {
        //noneed to be logged in to access this page
        $this->set_login_required(false);
        
        
        $this->information['page_title'] = 'Make an account';
        $this->information['description'] = "Make an account";
        $this->information['nav_urls']['register']['active'] = true;
        
        $this->information['last_form_values'] = $this->last_form_values->geAlltLastFormValue();
        
        //JqueryValidation PHP wrapper for quick browserside validation
        // Example
        
        
        $client_validation =  new Jquery_validation('#create_account');
        $client_validation->addRule('fname')->required(true)->minlength(3)->maxlength(50)->lettersonly()->normalizer();
        $client_validation->addRule('lname')->required(true)->minlength(3)->maxlength(50)->lettersonly()->normalizer();
        $client_validation->addRule('number')->required(true)->isDigit()->maxlength(10)->minlength(10);
        $client_validation->addRule('email')->required(true)->isEmail()->remote(Route::get_urls()['api-valid_email']['url']."true");
        
        $client_validation->addRule('password')->required(true)->minlength(8)->maxlength(50);
        $client_validation->addRule('password2')->equalsTo('.pass1')->required(true);
        
        $this->information['validation_js'] = $client_validation->getJs();
        
        
        $this->check_register();
        $this->load_view('account/create_account_view.php', $this->information);
        
        
    }

 

    private function check_edit_account()
    {
        if (isset($_POST['update_user_info'])) {


            $this->information['edit_account_info'] = [];
            
            
            //This is used to filter all $_POST data to prevent XXS
            myInputFilter::Filter_all_posts();

            $myForm = new form_validator();

            $myForm->name('fname')
                ->value($_POST['fname'])
                ->alpha()
                ->min(3)
                ->max(20)
                ->required();

            $myForm->name('lname')
                ->value($_POST['lname'])
                ->alpha()
                ->min(3)
                ->max(20)
                ->required();

            $myForm->name('number')
                ->value($_POST['number'])
                ->phone_number()
                ->required();

            $myForm->name('password')
                ->value($_POST['password'])
                ->min(5)
                ->max(100)
                ->required();

            if ($myForm->isSuccess()) {

                if (password_verify($_POST['password'], $this->get_logged_user()->password)) {

                    $this->account_model->update_info($_POST['fname'], $_POST['lname'], $_POST['number'], $this->get_logged_user()->id);
                    $this->checkLoginRequirement(true); // this is used to update the user info on the website.
                    $this->information['edit_success'] = true;
                    
                } else {

                    $this->information['edit_account_info']['errors']['password']['message'] = "Password is not correct.";
                }
            } else {
                $this->information['edit_account_info']['errors'] = $myForm->getErrors();

                // var_dump($this->information['edit_account_info']['errors']);
            }

            // header('Content-type: application/json');
            // echo json_encode( $this->information['edit_account_info'] );
            // die();
        }
    }
    
    
    
    private function check_register(){
        if (isset($_POST['register'])) {
            
            
            //This is used to filter all $_POST data to prevent XXS
            myInputFilter::Filter_all_posts();
            
            $myForm = new form_validator();
            
            $myForm->name('fname')
            ->value($_POST['fname'])
            ->alpha()
            ->min(3)
            ->max(50)
            ->required();
            
            $myForm->name('lname')
            ->value($_POST['lname'])
            ->alpha()
            ->min(3)
            ->max(60)
            ->required();
            
            $myForm->name('number')
            ->value($_POST['number'])
            ->phone_number()
            ->required();
            
            $myForm->name('password')
            ->value($_POST['password'])->equal($_POST['password2'])
            ->min(5)
            ->max(100)
            ->required();
            
            $myForm->name('email')
            ->value($_POST['email'])->email()->required();
           
            
            if ($myForm->isSuccess()) {
                
                $account_exists = $this->account_model->get_user_by_email($_POST['email']);
                
                if(empty($account_exists))
                {
                    $hash_pass= password_hash($_POST['password'], PASSWORD_ARGON2I);
                    $ip = ip_tools::get_client_ip();
                    $this->account_model->add_user($_POST['fname'], $_POST['lname'], $_POST['number'], $_POST['email'], $hash_pass, $ip);
                    $this->information['create_success'] = true;
                   
                    
                }
                
                                
                
            
            } else 
            {
                
                var_dump($myForm->getErrors());
            }
            
            
        }
        
        
    }

    // end
}

?>
