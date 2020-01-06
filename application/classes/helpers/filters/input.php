<?php
namespace Classes\Helpers\Filters;

class Input
{

    // String filter to prevent any xxs or sql injection
    public static function filter_text($data)
    {
        $escaper = new \Zend\Escaper\Escaper('utf-8');

        // If its empty there is no point cleaning it :\
        if (empty($data)) {
            return $data;
        }
     
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                $data[$key] = self::filter_text($value);
            }

            return $data;
        }

        $data = trim($data);
        $data = stripslashes($data);
        $data = $escaper->escapeHtml($data);
        // $data = htmlspecialchars($data);
        // $data = addslashes($data); not needed. pdo prevents this exploit.
        $data = filter_var($data, FILTER_SANITIZE_STRING);
        unset($escaper);
        return $data;
    }

    // end

    // filter all $_GET values preventing xss and some sql injection
    public static function Filter_all_gets()
    {
//         foreach ($_GET as $key => $value) {

//             $_GET[$key] = self::filter_text($value);
//         }

        $_GET = self::filter_text($_GET);
    }

    public static function Filter_all_cookies()
    {
//         foreach ($_COOKIE as $key => $value) {

//             $_COOKIE[$key] = self::filter_text($value);
//         }

        $_COOKIE = self::filter_text($_COOKIE);
    }

    // sometimes needed to be used, when having allot of popsts
    // isntead of filtering each one on your own.
    public static function Filter_all_posts()
    {
//         foreach ($_POST as $key => $value) {

//             $_POST[$key] = self::filter_text($value);
//         }

        $_POST = self::filter_text($_POST);
    }
}