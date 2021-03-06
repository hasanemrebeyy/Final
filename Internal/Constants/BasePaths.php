<?php
//--------------------------------------------------------------------------------------------------
// Base Paths
//--------------------------------------------------------------------------------------------------
//
// Author     : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
// Site       : www.znframework.com
// License    : The MIT License
// Copyright  : Copyright (c) 2012-2016, ZN Framework
//
//--------------------------------------------------------------------------------------------------

//--------------------------------------------------------------------------------------------------
// BASE_DIR
//--------------------------------------------------------------------------------------------------
//
// @return Uygulamanın bulunduğu dizinin yolu.
//
//--------------------------------------------------------------------------------------------------
define('BASE_DIR', explode(DIRECTORY_INDEX, $_SERVER['SCRIPT_NAME'])[0] ?? '/');

//--------------------------------------------------------------------------------------------------
// CORE_DIR
//--------------------------------------------------------------------------------------------------
//
// @return Internal/Core/
//
//--------------------------------------------------------------------------------------------------
define('CORE_DIR', INTERNAL_DIR.'Core'.DS);

//--------------------------------------------------------------------------------------------------
// PROJECTS_DIR
//--------------------------------------------------------------------------------------------------
//
// @return Applications/
//
//--------------------------------------------------------------------------------------------------
define('PROJECTS_DIR', REAL_BASE_DIR.'Projects'.DS);

//--------------------------------------------------------------------------------------------------
// EXTERNAL_DIR
//--------------------------------------------------------------------------------------------------
//
// @return External/
//
//--------------------------------------------------------------------------------------------------
define('EXTERNAL_DIR', REAL_BASE_DIR.'External'.DS);
