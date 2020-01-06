<?php
namespace Controllers;

use Core\Controller;
use Classes\Helpers\Filters\Input as inputFilter;
use Models\User_model;
use Zend\Validator\EmailAddress;

class Ajax extends Controller
{

    public function __construct()
    {
        $this->set_csrf_check(false);
    }

    public function check_email_ajax(bool $for_register = false)
    {
        header('Content-Type: application/json');

        $this->set_login_required(false);
        if (isset($_POST['email'])) {
            inputFilter::Filter_all_posts();
            $myacc = new User_model();

            $user_exists = $myacc->get_user_by_email($_POST['email']);
            if (! empty($user_exists)) {

                if (! $for_register) {
                    echo json_encode('true');
                } else {
                    echo json_encode('This account is already in use !');
                }
                die();
            }
        }

        if (! $for_register) {
            echo json_encode('Account does not exist.');
        } else {
            $validator = new EmailAddress();

            if ($validator->isValid($_POST['email'])) {
                echo json_encode('true');
          
            }else {
                echo json_encode('Please type in a valid email!');
                
            }

        }
        die();
    }

    // end
}

?>