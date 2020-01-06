<?php
$bench_mark_time_start = microtime(true);

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



header('X-Powered-By: Ayas');
header("X-XSS-Protection: 0");
header("X-Frame-Options: sameorigin");
header("X-Content-Type-Options: nosniff");
ini_set( 'session.cookie_httponly', 1 );
session_start();


//requires init, to initiate important components
require_once('application/init.php');

//starts the app
$app = new Core\application();

//closing the pdo db connection
$GLOBAL_APP_DB = null;


//number of queries used on page load.
//var_dump($Queries_Done);
?>
<script>
console.log('Total queries used on this page: <?php echo $Queries_Done; ?>');
console.log('It took {<?php $shit = microtime(true); echo ($shit - $bench_mark_time_start); ?>} to run php script.');
</script>