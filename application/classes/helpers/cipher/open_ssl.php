<?php
namespace Classes\Helpers\Cipher;

class Open_ssl
{

    public static function encrypt(string $var) :string
    {
         return openssl_encrypt($var, "AES-128-ECB", HASHKEY);
        
    }
    
    public static function decrypt(string $var) :string
    {
        return openssl_decrypt($var, "AES-128-ECB", HASHKEY);
    }
    
    public static function token_encode(string $var)
    {
        return str_replace('%', '!', rawurlencode(self::encrypt($var)));
    }
    
    public static function token_decode(string $var)
    {
        $var = str_replace('!', '%', $var);
        $var = rawurldecode($var);
        $var = self::decrypt($var);
        return $var;
    }
    
    public static function uniqueToken() : string
    {
        return md5(self::token_encode(uniqid().rand()));
    }
    
}