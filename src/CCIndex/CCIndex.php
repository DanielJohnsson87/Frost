<?php
/**
* Standard controller layout
*
*@package LydiaCore
*/
class CCIndex implements IController {

	/**
	* Implementing interface IController. All Controllers mus have an index action
	*/
	public function Index() {
		global $ly;
		$ly->data['title'] = "The Index Controller";
	}
}