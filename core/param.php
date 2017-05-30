<?php
class Param
{
    public static function get($name, $default = null)
    {
        return isset($_REQUEST[$name]) ? $_REQUEST[$name] : $default;
    }

    public static function getHeader($name, $default = null)
    {
        $header_index = 'HTTP_'.strtoupper($name);
        return isset($_SERVER[$header_index]) ? $_SERVER[$header_index] : $default;
    }

    public static function params()
    {
        return $_REQUEST;
    }
}
