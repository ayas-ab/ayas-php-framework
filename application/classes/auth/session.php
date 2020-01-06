<?php 
namespace Classes\Auth;
use Models\User_model as myAccount;
use Classes\Helpers\Filters\Input as myInputFilter;
use Classes\Helpers\Cipher\Open_ssl;
class Session

{
    
    public static function destroy()
    {
     
        $m = new myAccount();
        $m->remove_user_session($_COOKIE['pb_auth']);
        
        if (isset($_SERVER['HTTP_COOKIE'])) {
            $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
            foreach ($cookies as $cookie) {
                $parts = explode('=', $cookie);
                $name = trim($parts[0]);
                setcookie($name, '', time() - 1000);
                setcookie($name, '', time() - 1000, '/');
            }    }
    
        unset($m);
        session_destroy();
    }
    
    public static function isLoggedIn()
    {
        
        
        $object = null;
        if (isset($_COOKIE['pb_auth'])) {
            
            $m = new myAccount();
            $user = $m->get_user_by_session($_COOKIE['pb_auth']);
            
            
            if (!empty($user)) {
                
                if(myInputFilter::filter_text($_SERVER['HTTP_USER_AGENT']) == $user->user_agent){
                    $object = $user;
                    $m->updateUserLastOnline($user->id);
                    

                       
                }
                
            }
            else {
                self::destroy();
            }
            unset($m);
        }
        
        return $object;
    }
    
 
    
    public static function set_auth_cookie(string $hour, string $name)
    {
        setcookie('pb_auth', $name, $hour, '/', HTTP_URL, 0, true);
    }
	
	
	public static function set($key, $value)
	{
		$_SESSION[$key] = $value;
		
		
	}
	
	public static function get($key)
	{
		if (isset($_SESSION[$key]))
		{
			return $_SESSION[$key];
	    }
		
		return false;	
		
	}
    
}





?>