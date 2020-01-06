<?php

// ###################################################################
// ######### Class: Model class ######################################
// ###################################################################
// $q->rowCount()
namespace Core;

use PDOException;
use PDO;
use Zend\Validator\Date;

class Model
{

    public $users_table = "`users`";



    public $session_table = "`session`";

  

    private function getDatabase()
    {
        global $Queries_Done;
        $Queries_Done ++;
        global $GLOBAL_APP_DB;
        return $GLOBAL_APP_DB;
    }

    public function prepare(string $q)
    {
        $data = $this->getDatabase()->prepare($q, array(
            PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY
        ));
        
        
        return $data;
    }
}

?>