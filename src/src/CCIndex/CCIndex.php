<?php
/**
* Standard controller layout
*
*@package FrostCore
*/
class CCIndex  extends CObject implements IController {

	/**
	* Constructor
	*/
	public function __construct() {
	 parent::__construct();
}

	/**
	* Implementing interface IController. All Controllers must have an index action
	*/
	public function Index() {
		//global $ly to tell the scope that we are referencing the $ly outside of this function.(The global scope)
		// We can access $ly because it's defined in the global scope at index.php
		global $ly;
		$this->data['title'] = "The Index Controller";
		$this->data['main'] = "<h1>The Index Controller</h1>";

	}
}