<?php
/**
* Standard controller layout
*
*@package LydiaCore
*/
class CCReport implements IController {

	/**
	* Implementing interface IController. All Controllers mus have an index action
	*/
	public function Index() {
		global $ly;
		$ly->data['title'] = "The Report Controller";
	}
		public function Report() {
		global $ly;
		$ly->data['title'] = "The Report Controller";
	}
}