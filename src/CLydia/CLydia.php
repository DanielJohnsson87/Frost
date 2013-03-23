<?php
/**
* Main class for Frost, holds everything.
*
* @package FrostCore
*/

class CLydia implements ISingleton {


  /**
  * Members
  */
  private static $instance = null;
  public $config = array();
  public $request;
  public $data;
  public $db;
  public $views;
  public $session;
  public $user;

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

    //Create a object for the user(To avoid circular behavior in the constructors)
    // http://dbwebb.se/forum/viewtopic.php?t=282
    $this->user = new CMUser($this);
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
  //Config.php file and routing info.
	$this->request->Init($this->config['base_url'], $this->config['routing']);

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
      die('404. Page is not found.');
    }


}

/**
* Theme Engine Render, renders the reply of the request
*/
public function ThemeEngineRender() {
//Save to session before output anything
      $this->session->StoreInSession();

  // Is theme enabled?
  if(!isset($this->config['theme'])) { return; }

//Get the path and settings for the theme, look in the dir first
	 $themePath  = LYDIA_INSTALL_PATH . '/' . $this->config['theme']['path'];
  $themeUrl   = $this->request->base_url . $this->config['theme']['path'];

  //is there a parent theme?
  $parentPath = null;
  $parentUrl = null;
  if(isset($this->config['theme']['parent'])) {
    $parentPath = LYDIA_INSTALL_PATH . '/' . $this->config['theme']['parent'];
    $parentUrl  = $this->request->base_url . $this->config['theme']['parent'];
  }

  // Add stylesheet name to the $ly->data array
  $this->data['stylesheet'] = $this->config['theme']['stylesheet'];

  //make the theme urls available as part of $ly
  $this->themeUrl = $themeUrl;
  $this->themeParentUrl = $parentUrl;

  $themeName		= $this->config['theme']['name'];
  $themeStyle   = $this->config['theme']['stylesheet'];


  //An empty array to get rid of error with addString
  $emptyArray = array();
  //Map menu to region if defined
  if(is_array($this->config['theme']['menu_to_region'])) {
    foreach($this->config['theme']['menu_to_region'] as $key => $val) {
      $this->views->AddString($this->DrawMenu($key), $emptyArray, $val);
    }
  }
	//Include the global functions.php and the functions.php that are part of the theme
	$ly = &$this;
  //First the default Lydia themes/functions.php
  include(LYDIA_INSTALL_PATH . '/themes/functions.php');
  //Then the functions.php from the parent theme
  if($parentPath) {
	   if(is_file("{$parentPath}/functions.php")) {
		include "{$parentPath}/functions.php";
	   }
  }

  //And last the current theme functions.php
  if(is_file("{$themePath}/functions.php")) {
    include "{$themePath}/functions.php";
  }

	//Extract $ly->data and $ly->view to own variables and hand over to the template file
	extract($this->data); // OBSOLETE, Use $this->views->GetData() to set variables
  extract($this->views->GetData());
  if(isset($this->config['theme']['data'])) {
      extract($this->config['theme']['data']);
  $templateFile = (isset($this->config['theme']['template_file'])) ? $this->config['theme']['template_file'] : 'default.tpl.php';

  if(is_file("{$themePath}/{$templateFile}")) {
    include("{$themePath}/{$templateFile}");
  } else if(is_file("{$parentPath}/{$templateFile}")) {
    include("{$parentPath}/{$templateFile}");
  } else {
    throw new Exception('No such template file.');
  }
}

}
/**
* Redirect to another url and store the session, all redirects should use this method.
*
* @param $urlOrController string the relative url or the controller
* @param $method string the method to use, $url is then the controller or empty for current controller
* @param $arguments string the extra arguments to send to the method
*/
  public function RedirectTo($urlOrController=null, $method=null, $arguments=null) {
    if(isset($this->config['debug']['db-num-queries']) && $this->config['debug']['db-num-queries'] && isset($this->db)) {
      $this->session->SetFlash('database_numQueries', $this->db->GetNumQueries());
    }
    if(isset($this->config['debug']['db-queries']) && $this->config['debug']['db-queries'] && isset($this->db)) {
      $this->session->SetFlash('database_queries', $this->db->GetQueries());
    }
    if(isset($this->config['debug']['timer']) && $this->config['debug']['timer']) {
$this->session->SetFlash('timer', $this->timer);
    }
    $this->session->StoreInSession();
    header('Location: ' . $this->request->CreateUrl($urlOrController, $method, $arguments));
    exit;
  }



/**
* Redirect to a method within the current controller. Defaults to index-method. Uses RedirectTo().
*
* @param string method name the method, default is index method.
* @param $arguments string the extra arguments to send to the method
*/
public function RedirectToController($method=null, $arguments=null) {
    $this->RedirectTo($this->request->controller, $method, $arguments);
  }



/**
* Redirect to a controller and method. Uses RedirectTo().
*
* @param string controller name the controller or null for current controller.
* @param string method name the method, default is current method.
* @param $arguments string the extra arguments to send to the method
*/
public function RedirectToControllerMethod($controller=null, $method=null, $arguments=null) {
$controller = is_null($controller) ? $this->request->controller : null;
$method = is_null($method) ? $this->request->method : null; 
    $this->RedirectTo($this->request->CreateUrl($controller, $method, $arguments));
  }


  /**
* Save a message in the session. Uses $this->session->AddMessage()
*
* @param $type string the type of message, for example: notice, info, success, warning, error.
* @param $message string the message.
* @param $alternative string the message if the $type is set to false, defaults to null.
*/
  public function AddMessage($type, $message, $alternative=null) {
    if($type === false) {
      $type = 'error';
      $message = $alternative;
    } else if($type === true) {
      $type = 'success';
    }
    $this->session->AddMessage($type, $message);
  }


/**
* Create an url. Wrapper and shorter method for $this->request->CreateUrl()
*
* @param $urlOrController string the relative url or the controller
* @param $method string the method to use, $url is then the controller or empty for current
* @param $arguments string the extra arguments to send to the method
*/
public function CreateUrl($urlOrController=null, $method=null, $arguments=null) {
    return $this->request->CreateUrl($urlOrController, $method, $arguments);
  }


  /**
* Draw HTML for a menu defined in $ly->config['menus'].
*
* @param $menu string then key to the menu in the config-array.
* @return string with the HTML representing the menu.
*/
  public function DrawMenu($menu) {
    $items = null;
    if(isset($this->config['menus'][$menu])) {
      foreach($this->config['menus'][$menu] as $val) {
        $selected = null;
        if($val['url'] == $this->request->request || $val['url'] == $this->request->routed_from) {
          $selected = " class='selected'";
        }
        $items .= "<li><a {$selected} href='" . $this->CreateUrl($val['url']) . "'>{$val['text']}</a></li>\n";
      }
    } else {
      throw new Exception('No such menu.');

    }
    return "<header class='header-container clear'> <nav><ul>\n{$items}</ul>\n</nav></header>";
  }

    /**
     * Shows the current phpversion and outputs if the server php meets the requirements
     */
    public function DisplayPhpVersion() {
if(version_compare(PHP_VERSION, '5.0.0') >= 0) {
      $phpinfo['info'] =  'Your using PHP 5 or higher, that´s fine! Your version:' . PHP_VERSION . "\n";
      $phpinfo['class'] = 'success';
    } else {
      $phpinfo['info'] =  'Your using an outdated version of PHP. Frost needs at least PHP 5.0.0 to function properly! Your version:' . PHP_VERSION . "\n";
      $phpinfo['class'] = 'alert';

    }
    return $phpinfo;
  }
}
