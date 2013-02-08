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

	/**
	* Constructor
	*/

	protected function __construct() {
		//Get the instance of CLydia to $ly
		$ly = CLydia::Instance();
		//Make $this->config the same as $ly->config and so on. 
		//Now we can reference CLydia with $this instead of $ly
		$this->config 	=&$ly->config;
		$this->request 	=&$ly->request;
		$this->data 	=&$ly->data;
		$this->db 		=&$ly->db;
		$this->views 	=&$ly->views;
		$this->session  =&$ly->session;
	}


}