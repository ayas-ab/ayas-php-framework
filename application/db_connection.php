<?php

$GLOBAL_APP_DB = null;
$Queries_Done = 0;
//db connection
try {
    $options = [
        PDO::ATTR_EMULATE_PREPARES   => false, // turn off emulation mode for "real" prepared statements
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, //turn on errors in the form of exceptions
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, //make the default fetch be an associative array
    ];
    $GLOBAL_APP_DB = new PDO("mysql:host=".HOST.";dbname=".DATABASE.";charset=utf8", USERNAME, PASSWORD, $options);
    
    
}
catch(PDOException $e)
{
    die( "Connection failed: " . $e->getMessage());
}



?>