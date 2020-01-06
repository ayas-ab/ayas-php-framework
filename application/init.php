<?php
// ##################################################################
// ######### File: Init.php #########################################
// ##################################################################
// ######### This file is used to load important components##########
// #########required to run the application##########################
// ##################################################################

$composer = require_once ('vendor/autoload.php');
//file search function
function rglob(string $pattern, $flags = 0) : array
{
    $files = glob($pattern, GLOB_ONLYDIR);
    foreach (glob(dirname($pattern) . '/*', GLOB_ONLYDIR | GLOB_NOSORT) as $dir) {
        $files = array_merge($files, rglob($dir . '/' . basename($pattern), $flags));
    }
    return $files;
}


//auto loader, loads all classes in models and classes folder.
function myAutoload(string $class_name)
{
    $class_name = strtolower($class_name);

    $filtered_name = explode('\\', $class_name);
    $class_name = end($filtered_name);

    $directories = rglob(__DIR__ . '/models/*');

    $directories2 = rglob(__DIR__ . '/classes/*');
    $path = __DIR__ . "/models";

    $path2 = __DIR__ . "/classes";

    $merge = array_unique(array_merge($directories, $directories2));
    $merge[] = $path;
    $merge[] = $path2;

    foreach ($merge as $key => $value) {
        $path = $value . '/' . $class_name . '.php';

        if (file_exists($path)) {
            require_once ($path);
        }
    }
}

spl_autoload_register('myAutoload');
include_once ('application/config.php');
include_once('application/db_connection.php');
require_once ('application/core/route_class.php');
require_once ('core/application.php');
require_once ('core/model.php');
require_once ('core/controller.php');


?>