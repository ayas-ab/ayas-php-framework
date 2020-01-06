<?php
namespace Models;

use PDO;
use Core\Model as BaseModel;
use Classes\Helpers\Converters\Dates as Datetools;

class User_model extends BaseModel
{

    
    public function update_info(string $fname, string $lname, string $number, int $id)
    {
        $update_query = $this->prepare("UPDATE {$this->users_table} u SET `first_name` = :fname,  `last_name` = :lname,  `number` = :number WHERE u.id = :id");

        $update_query->bindParam(':fname', $fname);
        $update_query->bindParam(':lname', $lname);
        $update_query->bindParam(':number', $number);
    
        $update_query->bindParam(':id', $id);
        $update_query->execute();
        $update_query = null;
    }
    
    
    public function add_user(string $fname, string $lname, string $number, string $email, string $password, $ip)
    {
        
   
        $update_query = $this->prepare("INSERT INTO {$this->users_table} (first_name, last_name, email, password, number, user_type, last_ip) VALUES (:fname,  :lname,  :email,  :password, :number, 0, :ip)");  
        $update_query->bindParam(':fname', $fname);
        $update_query->bindParam(':lname', $lname);
        $update_query->bindParam(':number', $number);
        $update_query->bindParam(':email', $email);
        $update_query->bindParam(':password', $password);
        $update_query->bindParam(':ip', $ip);
        
        
        
        
        $update_query->execute();
        $update_query = null;
    }


    public function updateUserLastOnline(string $id)

    {
      
    }

   
    public function get_user_by_email(string $email)
    {
       $data = $this->prepare("SELECT *  FROM  {$this->users_table} WHERE {$this->users_table}.email = :email");
     
        $data->bindParam(':email', $email);
        $data->execute();
        $final = $data->fetchObject('\Classes\Db_objects\User');
        // $final = $data->fetchAll(PDO::FETCH_CLASS, '\Classes\User');
        // $final = $data->fetch(\PDO::FETCH_OBJ);
        $data = null;
        return $final;
    }
    
    
    public function get_user_by_id(string $id)
    {
        $data = $this->prepare("SELECT * FROM {$this->users_table} WHERE id = :id");
        $data->bindParam(':id', $id);
        $data->execute();
        $final = $data->fetchObject('\Classes\Db_objects\User');
        // $final = $data->fetchAll(PDO::FETCH_CLASS, '\Classes\User');
        // $final = $data->fetch(\PDO::FETCH_OBJ);
 
        return $final;
    }
    
    public function get_all_users()
    {
        $data = $this->prepare("SELECT * FROM {$this->users_table}");
        $data->execute();
        $final = $data->fetchAll(PDO::FETCH_ASSOC);
        $data=null;
        return $final;
    }
    
    
    //should also store ip, but leave for later.
    public function add_user_session(string $user_id, string $user_agent,string $cookie, string $expire_at)
    {
        $q = "INSERT INTO {$this->session_table} (user_id, cookie, user_agent, last_online, expire_at) VALUES (:user_id, :cookie, :user_agent, :last_online, :expire_at)";
        $data = $this->prepare($q);
        $expire_at = Datetools::timestampToDateTime($expire_at);
        $date = date("Y-m-d H:i:s"); 
        $data->bindParam(':user_id', $user_id);
        $data->bindParam(':user_agent', $user_agent);
        $data->bindParam(':cookie', $cookie);
        $data->bindParam(':last_online', $date);
        $data->bindParam(':expire_at', $expire_at);
        $data->execute();

    }
    
    
    public function get_user_by_session(string $cookie_name)
    {
        $today = date("Y-m-d H:i:s"); 
        $q = "SELECT  @uid:={$this->users_table}.id, {$this->users_table}.*, {$this->session_table}.cookie, {$this->session_table}.user_agent, {$this->session_table}.expire_at FROM {$this->users_table}, {$this->session_table} WHERE {$this->users_table}.id = {$this->session_table}.user_id AND {$this->session_table}.cookie = :cookie_name AND {$this->session_table}.expire_at > :today ";
        $data = $this->prepare($q);
        $data->bindParam(':cookie_name', $cookie_name);
        $data->bindParam(':today', $today);
        
        $data->execute();
        $final = $data->fetchObject('\Classes\Db_objects\User');
      
        return $final;
    }
    
    
    public function remove_user_session($cookie_name)
    {
        $q  = "DELETE FROM {$this->session_table} WHERE cookie = :cookie_name";
        $data = $this->prepare($q);
        $data->bindParam(':cookie_name', $cookie_name);
        $data->execute();
        $data = null;
    }
  
    
   
    
    
 
    
    

   /* old 
    public function get_user_by_email(string $email)
    {
        $data = $this->getDatabase()->prepare("SELECT * from users u WHERE u.email = :email", array(
            PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY
        ));
        $data->bindParam(':email', $email);
        $data->execute();
        $final = $data->fetch(PDO::FETCH_ASSOC);
        $data = null;
        return $final;
    }
    
    */
}

?>