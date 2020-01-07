<?php



// static pages here like home page, about us, contact, 404 error etc.
namespace Controllers;

use Core\Controller;
use Models\User_model;
class Static_page extends Controller
{

    
    public function home()
    {
       
          
        $this->set_login_required(false);
        
        $this->information['page_title'] = SITE_NAME;
        $this->information['description'] = "Just a test page";
        $this->information['nav_urls']['home']['active'] = true;
        $user_model = new User_model();
        $this->information['user_list'] = $user_model->get_all_users();
        $this->load_view('home_view.php', $this->information);
    }
    

    
    public function view_user($id = null)
    {
        $this->set_login_required(false);
        
       
        if($id == null)
        {
            self::error();
            die();
        }
        
        
        $user_model = new User_model();
        $user_exists = $user_model->get_user_by_id($id);
        if(empty($user_exists))
        {
            self::error();
            die();
        }
        
     
        $this->information['page_title'] = $user_exists->first_name."'s Profile";
        $this->information['view_user'] = $user_exists;
        $this->information['description'] = "Just a test page";
        $this->load_view('public_profile_view.php', $this->information);
        
        
    }
    
    public function error()
    {
        header("HTTP/1.0 404 Not Found");
        $this->set_login_required(false);
        $this->information['page_title'] = '404 - '.SITE_NAME;
        $this->information['description'] = "404 wops";
        $this->load_view('404_view.php', $this->information);
    }
    

    // end
}

?>
