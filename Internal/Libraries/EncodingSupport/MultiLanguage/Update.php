<?php namespace ZN\EncodingSupport\MultiLanguage;

class Update implements InsertInterface
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
    // Update
    //--------------------------------------------------------------------------------------------------------
    //
    // Dil dosyasında yer alan bir kelimeyi güncellemek için kullanılır.
    // @param string $app
    // @param mixed  $key
    // @param string $data
    //
    //--------------------------------------------------------------------------------------------------------
    public function do(String $app = NULL, $key, String $data = NULL) : Bool
    {
        return Factory::class('Insert')->do($app, $key, $data);
    }
}
