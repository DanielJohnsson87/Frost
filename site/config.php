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
* How to hash password of new users, choose from plain, md5salt, md5, sha1salt, sha1.
*/
$ly->config['hashing_algorithm'] = 'sha1salt';

/**
* Allow or disable creation of new user accounts.
*/
$ly->config['create_new_users'] = 'true';

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
							'class' => 'CCGuestbook'),
	'user'			=> array('enabled' => true,
							'class' => 'CCUser'),
	'acp'			=> array('enabled' => true,
							'class' => 'CCAdminControlPanel'),
	'content'		=> array('enabled' => true,
							'class' => 'CCContent'),
	'page'			=> array('enabled' => true,
							'class' => 'CCPage'),
	'blog'			=> array('enabled' => true,
							'class' => 'CCBlog'),
	'theme'			=> array('enabled' => true,
							'class' => 'CCTheme'),
	'module'		=> array('enabled' => true,
							'class' => 'CCModules'),
	'my' 			=> array('enabled' => true,
							'class' => 'CCMycontroller'),

	);

/**
* Settings for the theme. The theme may have a parent theme.
*
* When a parent theme is used the parent's functions.php will be included before the current
* theme's functions.php. The parent stylesheet can be included in the current stylesheet
* by an @import clause. See site/themes/mytheme for an example of a child/parent theme.
* Template files can reside in the parent or current theme, the CLydia::ThemeEngineRender()
* looks for the template-file in the current theme first, then it looks in the parent theme.
*
* There are two useful theme helpers defined in themes/functions.php.
*  theme_url($url): Prepends the current theme url to $url to make an absolute url.
*  theme_parent_url($url): Prepends the parent theme url to $url to make an absolute url.
*
* path: Path to current theme, relativly LYDIA_INSTALL_PATH, for example themes/grid or site/themes/mytheme.
* parent: Path to parent theme, same structure as 'path'. Can be left out or set to null.
* stylesheet: The stylesheet to include, always part of the current theme, use @import to include the parent stylesheet.
* template_file: Set the default template file, defaults to default.tpl.php.
* regions: Array with all regions that the theme supports.
* data: Array with data that is made available to the template file as variables.
*
* The name of the stylesheet is also appended to the data-array, as 'stylesheet' and made
* available to the template files.
*/


$ly->config['theme'] = array(
	//The name of the theme in the theme directory
	//'path'	=> 'themes/grid',
	'path'		 => 'site/themes/mytheme',
	'parent'	 => 'themes/grid',
	'name'		 => 'grid',		// The name of the theme in the theme directory
	'stylesheet' => 'style/style.css', //Main stylesheet to include in template files
	'template_file'   => 'index.tpl.php',   // Default template file, else use default.tpl.php
	  //A list of valid theme regions
	'regions' 	=> array('header-logo', 'header-menu', 'header-login', 'headline',
	 'content', 'footer-first', 'footer-second', 'footer-third', 'sidebar'),
	'menu_to_region' => array('navbar' => 'header-menu'),
	//Add static entries for use in the template file.
	'data'		=> array(
			'logo' => '/img/logo-small.png',
			'copyright' => '<p>Frost &copy; by Daniel Johnsson (danne_j87@hotmail.com)</p>',
			'title' => 'FrostMVC - A model view controller made by Daniel Johnsson',
			'footer_first' => '<p>FrostMVC - 2013</p>',
			'footer_second' =>'<p>Developer Daniel Johnsson</p>',
			'footer_third' =>'<p>Blekinge Tekniska Högskola</p>',
			)
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

/**
 * Define a routing table for urls
 *
 * Route custom urls to a defined controller/method/arguments
 */
$ly->config['routing'] = array(
	'home' => array('enabled' => true, 'url' => 'index/index'),
	);

/**
 * Define the menu that you want to use
 */
$ly->config['menus'] = array(
	'navbar' => array(
	'index' => array('text' => 'Home', 'url' => 'index'),
	'guestbook' => array('text' => 'Guestbook', 'url' => 'guestbook'),
	'developer' => array('text' => 'Developer', 'url' => 'developer'),
	'user' => array('text' => 'User', 'url' => 'user'),
	'content' => array('text' => 'Content', 'url' => 'content'),
	'theme' => array('text' => 'Theme', 'url' => 'theme'),
	'module' => array('text' => 'Modules', 'url' => 'module'),
	),
	'small' => array(
	'index' => array('text' => 'Home', 'url' => 'my/index'),
	'guestbook' => array('text' => 'Guestbook', 'url' => 'my/guestbook'),
	'blog' => array('text' => 'Blog', 'url' => 'my/blog'),

	));

