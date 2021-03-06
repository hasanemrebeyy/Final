<?php namespace ZN\EncodingSupport\MultiLanguage;

interface DeleteInterface
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
    // Delete
    //--------------------------------------------------------------------------------------------------------
    //
    // Silinecek dil dosyası.
    // @param string $app
    // @param mixed  $key
    //
    // @return bool
    //
    //--------------------------------------------------------------------------------------------------------
    public function do(String $app, $key) : Bool;

    //--------------------------------------------------------------------------------------------------------
    // Delete All
    //--------------------------------------------------------------------------------------------------------
    //
    // Silinecek dil dosyası.
    // @param string $app
    //
    //--------------------------------------------------------------------------------------------------------
    public function all($app = NULL) : Bool;
}
