<?php namespace ZN\Services\Remote;

use File, SSH;

class InternalProcessor extends RemoteCommon implements InternalProcessorInterface
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

    const config = 'Services:processor';

    //--------------------------------------------------------------------------------------------------------
    // Processor Path
    //--------------------------------------------------------------------------------------------------------
    //
    // @var string
    //
    //--------------------------------------------------------------------------------------------------------
    protected $processorPath = PROCESSOR_DIR;

    //--------------------------------------------------------------------------------------------------------
    // Output
    //--------------------------------------------------------------------------------------------------------
    //
    // @var array
    //
    //--------------------------------------------------------------------------------------------------------
    protected $output;

    //--------------------------------------------------------------------------------------------------------
    // Return
    //--------------------------------------------------------------------------------------------------------
    //
    // @var int
    //
    //--------------------------------------------------------------------------------------------------------
    protected $return;

    //--------------------------------------------------------------------------------------------------------
    // Driver
    //--------------------------------------------------------------------------------------------------------
    //
    // @var string
    //
    //--------------------------------------------------------------------------------------------------------
    protected $driver;

    //--------------------------------------------------------------------------------------------------------
    // Construct
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function __construct()
    {
        parent::__construct();

        $config       = SERVICES_PROCESSOR_CONFIG;
        $this->path   = $config['path'];
        $this->driver = $config['driver'];
    }

    //--------------------------------------------------------------------------------------------------------
    // Exec
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  string $command: empty
    // @return string
    //
    //--------------------------------------------------------------------------------------------------------
    public function exec($command)
    {
        switch( $this->driver )
        {
            case 'exec':
                return exec($command, $this->output, $this->return);
            break;

            case 'shell_exec':
                return shell_exec($command);
            break;

            case 'system':
                return system($command, $this->return);
            break;

            case 'ssh':
                return SSH::run($command);
            break;
        }
    }

    //--------------------------------------------------------------------------------------------------------
    // PHP
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $command
    //
    //--------------------------------------------------------------------------------------------------------
    public function php(String $command) : String
    {
        $phpCommand = "require_once '".REAL_BASE_DIR."zerocore'; ".$command.";";
        $phpCommand = presuffix(str_replace('"', '\"', $phpCommand), '"');
        $commands   = $this->path;
        $commands  .= ' -r ';
        $commands  .= $phpCommand;

        $this->stringCommand = $commands;

        return $this->_run($commands);
    }

    //--------------------------------------------------------------------------------------------------------
    // File
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $file
    //
    //--------------------------------------------------------------------------------------------------------
    public function file(String $file) : String
    {
        $commands  = $this->path;
        $commands .= ' -f ';
        $commands .= $this->_fileControl($file);

        $this->stringCommand = $commands;

        return $this->_run($commands);
    }

    //--------------------------------------------------------------------------------------------------------
    // Read
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $file
    //
    //--------------------------------------------------------------------------------------------------------
    public function read(String $file) : String
    {
        $content = File::read($this->_fileControl($file));
        $content = str_ireplace(['<?php', '?>'], NULL, $content);

        return $this->php($content);
    }

    //--------------------------------------------------------------------------------------------------------
    // Controller
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $path
    //
    //--------------------------------------------------------------------------------------------------------
    public function controller(String $path) : String
    {
        $command  = '$datas = ZN\Core\Structure::data("'.$path.'");';
        $command .= '$parameters = $datas["parameters"];';
        $command .= '$page       = $datas["page"];';
        $command .= '$isFile     = $datas["file"];';
        $command .= '$function   = $datas["function"];';
        $command .= '$namespace  = $datas["namespace"];';
        $command .= 'if( ! is_file($isFile) )';
        $command .= '{';
        $command .= 'exit("Error: URL does not contain a valid controller information! `".$page."` controller could not be found!");';
        $command .= '}';
        $command .= 'import($isFile);';
        $command .= 'if( ! class_exists($page, false) )';
        $command .= '{';
        $command .= '$page = $namespace.$page;';
        $command .= '}';
        $command .= 'if( strtolower($function) === "index" && ! is_callable([$page, $function]) )';
        $command .= '{';
        $command .= '$function = "main";';
        $command .= '}';
        $command .= 'if( is_callable([$page, $function]) )';
        $command .= '{';
        $command .= 'uselib($page)->$function(...$parameters);';
        $command .= '}';
        $command .= 'else';
        $command .= '{';
        $command .= 'exit("Error: URL does not contain a valid function or method information! `".$function."` method could not be found!");';
        $command .= '}';

        return $this->php($command);
    }

    //--------------------------------------------------------------------------------------------------------
    // PHP Path
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $php
    //
    //--------------------------------------------------------------------------------------------------------
    public function path(String $path) : InternalProcessor
    {
        $this->path = $path;

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Driver
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function driver(String $driver) : InternalProcessor
    {
        $this->driver = $driver;

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Output
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function output() : Array
    {
        return $this->output;
    }

    //--------------------------------------------------------------------------------------------------------
    // Return
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function return() : Int
    {
        return $this->return;
    }

    //--------------------------------------------------------------------------------------------------------
    // File Control
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _fileControl($path)
    {
        $path = File::originpath($path);
        $file = $this->processorPath.$path;

        if( ! is_file($file) )
        {
            $file = EXTERNAL_PROCESSOR_DIR.$path;
        }

        return $file;
    }

    //--------------------------------------------------------------------------------------------------------
    // Run
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _run($command)
    {
        $return = $this->exec($command);

        $this->_defaultVariables();

        return $return;
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Default Variables
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _defaultVariables()
    {
        $this->command = NULL;
        $this->path    = NULL;
        $this->driver  = NULL;
    }
}
