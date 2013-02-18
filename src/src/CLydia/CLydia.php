<?php
/**
* Main class for Frost, holds everything.
*
* @package FrostCore
*/

class CLydia implements ISingleton {

  private static $instance = null;

  /**
   * Constructor
   */
  protected function __construct() {
    // include the site specific config.php and create a ref to $ly to be used by config.php
    $ly = &$this;
    require(LYDIA_SITE_PATH.'/config.php');

    //Start a named session
    session_name($this->config['session_name']);
    session_start();
    //populate $this->session with a new object of CSession
    //pass the session_key set in config.php to CSession
    $this->session = new CSession($this->config['session_key']);
    $this->session->PopulateFromSession();

    //Set default date/time-zone
    date_default_timezone_set($this->config['timezone']);

    //Create a database object.
    if(isset($this->config['database'][0]['dsn'])) {
      $this->db = new CDatabase($this->config['database'][0]['dsn']);
    }

    //Create a container for all views and theme data
    $this->views = new CViewContainer();
  }

  /**
   * Singleton pattern. Get the instance of the latest created object or create a new one. 
   * @return CLydia The instance of this class. This way we can be shure that there
   * will always only be one instance of CLydia.
   */

  public static function Instance() {
    if(self::$instance == null) {
      self::$instance = new CLydia();
    }
    return self::$instance;
  }
  
/**
* Frontcontroller, check url and rout to controllers
*/			
public function FrontControllerRoute() {

	// Take current url and divide it in controller, method and parameters
  // Instansiate new CRequest in $this->request. Now we have access to CRequest
  // Through $this->request. Send the user defined url_type from our config.php.
  // 
	$this->request = new CRequest($this->config['url_type']);

  //Run the init() method in CRequest. Pass our user defined base_url from our 
  //Config.php file.
	$this->request->Init($this->config['base_url']);

  // The results from CRequest->init() will populate these variables
	$controller 	= $this->request->controller;
	$method			= $this->request->method;
	$arguments		= $this->request->arguments;
	
	// Is the controller enabled in config.php? Uses the $controller variable
  // we get from CRequest->init()
	$controllerExists	= isset($this->config['controllers'][$controller]);
	$controllerEnabled	= false;
	$className			= false;
	$classExists		= false;

  //If the controller exists
	if($controllerExists) {
    //Set $controllerEnabled to true
		$controllerEnabled		= ($this->config['controllers'][$controller]['enabled'] == true);
    //Set $className to the classname we want to call from our config.php. The classname
    //Must be defined in our config.php
		$className				= $this->config['controllers'][$controller]['class'];
    //Checks if the class exists
		$classExists			= class_exists($className);
	}

	// Check if there is a callable method in the controller class, if then call it
    if($controllerExists && $controllerEnabled && $classExists) {
      $rc = new ReflectionClass($className);
      // if the class implements IController(All controllers must implement IController)
      if($rc->implementsInterface('IController')) {
        //Formats the url. Deletes _ and - from the request
        $formattedMethod = str_replace(array('_', '-'), '', $method);
        //If the controller has the method that is sent from the URL
        if($rc->hasMethod($formattedMethod)) {
          //Create a new instance of the Reflection class object
          $controllerObj = $rc->newInstance();
          //Get the method 
          $methodObj = $rc->getMethod($formattedMethod);
          //If the method is declared as public
          if($methodObj->isPublic()) {
            //Invoke("Use") the controller and pass the arguments(from the url)
            $methodObj->invokeArgs($controllerObj, $arguments);
          } else {
            die("404. " . get_class() . ' error: Controller method not public.');          
          }
        } else {
          die("404. " . get_class() . ' error: Controller does not contain method.');
        }
      } else {
        die('404. ' . get_class() . ' error: Controller does not implement interface IController.');
      }
    } 
    else { 
      die('404. Page is not found...this is me3');
    }


}

/**
* Theme Engine Render, renders the reply of the request
*/
public function ThemeEngineRender() {
//Save to session before output anything
      $this->session->StoreInSession();

//Get the path and settings for the theme
	$themeName		= $this->config['theme']['name'];
	$themePath		= LYDIA_INSTALL_PATH . "/themes/{$themeName}";
	$themeUrl		= $this->request->base_url . "themes/{$themeName}";

	//Add stylesheet path to the $ly->data array
	$this->data['stylesheet'] = "{$themeUrl}/style.css";

	//Include the global functions.php and the functions.php that are part of the theme
	$ly = &$this;
  include(LYDIA_INSTALL_PATH . '/themes/functions.php');
	$functionsPath = "{$themePath}/functions.php";
	if(is_file($functionsPath)) {
		include $functionsPath;
	}
	//Extract $ly->data and $ly->view to own variables and hand over to the template file
	extract($this->data);
  extract($this->views->GetData());
	include("{$themePath}/default.tpl.php");
}

}