<?php

class StringFunctions
{
    static public function seo_url($string, $seperator='-')
    {
        $string = strtolower($string);
        $string = preg_replace("/[^a-z0-9_\s-]/", $seperator, $string);
        $string = preg_replace("/[\s-]+/", " ", $string);
        $string = preg_replace("/[\s_]/", $seperator, $string);
        return $string;
    }
    static public function generateClassName($string, $separator = "_")
    {
        $className = "";
        $string = preg_replace("/(_){2,}/", $separator, $string);
        $temp = explode($separator, $string);
        foreach($temp as $subName) {
            $className .=ucfirst($subName);
        }
        return $className;
    }
    static public function isSerialized($data)
    {
        return (@unserialize($data) === false)? false: true;
    }
}