<?php

//
// PHASE: BOOTSTRAP
// Defines the path to our installation path of Frost MVC & our site path
// within our installation path. Dirname(__FILE__) Returns the current 
// Directory we are working in. 
define('LYDIA_INSTALL_PATH', dirname(__FILE__));
define('LYDIA_SITE_PATH', LYDIA_INSTALL_PATH . '/site');

//We require our bootstrap.php. Our bootstrap.php handles the 
//instantation of our classes so that we can use the $ly variable
require(LYDIA_INSTALL_PATH. '/src/CLydia/bootstrap.php');

//Create a new instance of CLydia
$ly = CLydia::Instance();
//
// PHASE: FRONTCONTROLLER ROUTE
//
$ly->FrontControllerRoute();
//
// PHASE: THEME ENGINE RENDER
//
$ly->ThemeEngineRender();