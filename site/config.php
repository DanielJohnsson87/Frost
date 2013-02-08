<?php
/**
*Site config, this file is changed by the user per site
*
*/

/*
* Set level of error reporting
*/
error_reporting(-1);
ini_set('display_errors', 1);

/*
* Define session name
*/
$ly->config['session_name'] = preg_replace('/[:\.\/-_]/', '', $_SERVER["SERVER_NAME"]);

/*
* Define server timezone
*/
$ly->config['timezone'] = 'Europe/Stockholm';
/*
* Define character encoding
*/
$ly->config['character_encoding'] = 'UTF-8';

/*
* Define Language
*/
$ly->config['language'] = 'en';

/*
* Set session key
*/
$ly->config['session_key'] = 'lydia';

/**
* Define the controllers, their classname and enable/disable them.
*
* The array-key is matched against the url, for example:
* the url 'developer/dump' would instantiate the controller with the key "developer", that is
* CCDeveloper and call the method "dump" in that class. This process is managed in:
* $ly->FrontControllerRoute();
* which is called in the frontcontroller phase from index.php.
*/

$ly->config['controllers'] = array(
	'index'		=> array('enabled' => true,
						 'class' => 'CCIndex'),
	'developer'		=> array('enabled' => true,
						 'class' => 'CCDeveloper'),
	'guestbook'		=> array('enabled' => true,
							'class' => 'CCGuestbook')

	);

/**
* Settings for the theme.
*/
$ly->config['theme'] = array(
	//The name of the theme in the theme directory
	'name'		=> 'core',
	);

/**
* Set the base_url to use another than the default calculated
*/
$ly->config['base_url'] = null;

/**
* What type of urls should be used?
*
* default 		= 0		=> index.php/controller/method/arg1/arg2/arg3
* clean 		= 1 	=> controller/method/arg1/arg2/arg3
* querystring 	= 2 	=> index.php?q=controller/method/arg1/arg2/arg3
*/
$ly->config['url_type'] = 1;





    /**
    * Set what to show as debug or developer information in the get_debug() theme helper.
    */
    $ly->config['debug']['lydia'] = true;
    $ly->config['debug']['db-num-queries'] = true;
    $ly->config['debug']['db-queries'] = true;
    $ly->config['debug']['session'] = true;

/**
* What database do you want to use?
* Configurate your settings
*/
$ly->config['database'][0]['dsn'] = 'sqlite:' . LYDIA_SITE_PATH . '/data/.ht.sqlite';

