<?php
namespace Classes\Db_objects;
class User
{

    public $id, $first_name, $last_name, $last_ip, $email, $password, $number, $user_type, $full_name;

  
    
    function __construct()
    {
       $this->full_name = $this->first_name." ".$this->last_name;
        
    }
   /*
    public function toArray() {
        $object = $this;
        $reflectionClass = new \ReflectionClass(get_class($object));
        $array = array();
        foreach ($reflectionClass->getProperties() as $property) {
            $property->setAccessible(true);
            $array[$property->getName()] = $property->getValue($object);
            $property->setAccessible(false);
        }
        return $array;
    }
    
    */
}

?>