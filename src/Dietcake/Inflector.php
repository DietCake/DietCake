<?php
class Inflector
{
    public static function camelize($str)
    {
        return str_replace(' ', '', ucwords(str_replace('_', ' ', $str)));
    }
}
