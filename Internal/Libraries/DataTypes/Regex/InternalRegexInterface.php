<?php namespace ZN\DataTypes;

interface InternalRegexInterface
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

    //--------------------------------------------------------------------------------------------------------
    // Match
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $pattern
    // @param string $str
    // @param string $ex
    // @param string $delimiter
    //
    //--------------------------------------------------------------------------------------------------------
    public function match(String $pattern, String $str, String $ex = NULL, String $delimiter = '/') : Array;

    //--------------------------------------------------------------------------------------------------------
    // Match All
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $pattern
    // @param string $str
    // @param string $ex
    // @param string $delimiter
    //
    //--------------------------------------------------------------------------------------------------------
    public function matchAll(String $pattern, String $str, String $ex = NULL, String $delimiter = '/') : Array;

    //--------------------------------------------------------------------------------------------------------
    // Replace
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $pattern
    // @param string $rep
    // @param string $str
    // @param string $ex
    // @param string $delimiter
    //
    //--------------------------------------------------------------------------------------------------------
    public function replace(String $pattern, String $rep, String $str, String $ex = NULL, String $delimiter = '/');

    //--------------------------------------------------------------------------------------------------------
    // Group
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $str
    //
    //--------------------------------------------------------------------------------------------------------
    public function group(String $str) : String;

    //--------------------------------------------------------------------------------------------------------
    // Recount
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $str
    //
    //--------------------------------------------------------------------------------------------------------
    public function recount(String $str) : String;

    //--------------------------------------------------------------------------------------------------------
    // To
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $str
    //
    //--------------------------------------------------------------------------------------------------------
    public function to(String $str) : String;

    //--------------------------------------------------------------------------------------------------------
    // Quote
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $data
    // @param string $delimiter
    //
    //--------------------------------------------------------------------------------------------------------
    public function quote(String $data, String $delimiter = NULL) : String;
}
