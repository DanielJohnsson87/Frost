<?php
/**
* A blog controller to display a blog-like list of all content labelled as "post" in the db.
*
* @package FrostCore
*/
class CCBlog extends CObject implements IController {

	/**
	* Construct
	*/
	public function __construct() {
		parent::__construct();
	}

	/**
	* Display all content of the type "post".
	*/
	public function Index() {
		$content = new CMContent();
		$this->views->SetTitle('Blog');
		$this->views->AddInclude(__DIR__ . '/index.tpl.php', array('contents'=> $content->ListAll(array('type'=>'post', 
			'order-by'=>'title', 'order-order'=> 'DESC')),
		));
	}
}