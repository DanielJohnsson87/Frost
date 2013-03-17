<?php
/**
* Holding a instance of CLydia to enable use of $this-> in subclasses
*
* @package FrostCore
*/
class CObject {

	public $config;
	public $request;
	public $data;
	public $db;
	public $views;
	public $session;
	public $user;

	/**
	* Constructor
	*/

	protected function __construct($ly=null) {
		if(!$ly) {
		//Get the instance of CLydia to $ly
		$ly = CLydia::Instance();
		}
		//Make $this->config the same as $ly->config and so on. 
		//Now we can reference CLydia with $this instead of $ly
		$this->ly 		=&$ly;
		$this->config 	=&$ly->config;
		$this->request 	=&$ly->request;
		$this->data 	=&$ly->data;
		$this->db 		=&$ly->db;
		$this->views 	=&$ly->views;
		$this->session  =&$ly->session;
		$this->user 	=&$ly->user;
	}

	/**
* Wrapper for same method in CLydia. See there for documentation.
*/
protected function RedirectTo($urlOrController=null, $method=null, $arguments=null) {
    $this->ly->RedirectTo($urlOrController, $method, $arguments);
  }


/**
* Wrapper for same method in CLydia. See there for documentation.
*/
protected function RedirectToController($method=null, $arguments=null) {
    $this->ly->RedirectToController($method, $arguments);
  }


/**
* Wrapper for same method in CLydia. See there for documentation.
*/
protected function RedirectToControllerMethod($controller=null, $method=null, $arguments=null) {
    $this->ly->RedirectToControllerMethod($controller, $method, $arguments);
  }


/**
* Wrapper for same method in CLydia. See there for documentation.
*/
  protected function AddMessage($type, $message, $alternative=null) {
    return $this->ly->AddMessage($type, $message, $alternative);
  }


/**
* Wrapper for same method in CLydia. See there for documentation.
*/
protected function CreateUrl($urlOrController=null, $method=null, $arguments=null) {
    return $this->ly->CreateUrl($urlOrController, $method, $arguments);
  }
}