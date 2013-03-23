<?php
/**
* A user controller to manage content.
*
* @package FrostCore
*/
class CCContent extends CObject implements IController {


	/**
	* Constructor
	*/
	public function __construct() {
		parent::__construct();
	}

	/**
	* Show a listing of all content.
	*/
	public function Index() {
		$content = new CMContent();
		$this->views->SetTitle('Content Controller');
		$this->views->AddInclude(__DIR__ . '/index.tpl.php', array('contents'=> $content->ListAll(),
			'is_authenticated'=>$this->user['isAuthenticated'],
			));
	}

	/**
	* Edit a selected content, or prepare to create new content if argument is missing.
	*
	* @param key integer the key of the content.
	*/
	public function Edit($key=null) {
		$content = new CMContent($key);
		$form = new CFormContent($content);
		$status = $form->Check();
		if($status === false) {
			$this->session->AddMessage('notice', 'The form could not be processed.');
			$this->RedirectToController('edit', $key);
		} else if($status === true) {
			$this->RedirectToController('edit', $content['key']);
		}

		$title = isset($key) ? 'Edit' : 'Create';
		$this->views->SetTitle("$title content: $key");
		$this->views->AddInclude(__DIR__ . '/edit.tpl.php', array(
			'user'=>$this->user,
			'content'=>$content,
			'form'=>$form,
			));
	}

	/**
	* Create new content.
	*/
	public function Create() {
		$this->Edit();
	}

	/**
	* Init the content database.
	*/
	public function Init() {
		$content = new CMContent();
		$action = 'install';
		$content->Manage($action);
		$this->RedirectToController();
	}
}