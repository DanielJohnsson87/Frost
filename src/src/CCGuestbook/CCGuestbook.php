<?php
/**
* A guestbook controller as an example to show off som basic controller and model stuff
*
* @package FrostCore
*/

class CCGuestbook extends CObject implements IController {

/**
* Members
*/
private $guestbookModel;
private $pageTitle = "Frost Guestbook";

/**
* Constructor
*/
public function __construct() {
	//Construct according to CObjects constructor
	parent::__construct();
	$this->guestbookModel = new CMGuestbook();
}

/**
* Implementing interface IController. All controllers must have an index() action.
* 
*/
public function Index() {
	//Set the title of the page
$this->views->SetTitle($this->pageTitle);
	// Include index.tpl.php and pass an array with content
$this->views->AddInclude(__DIR__ . '/index.tpl.php', array(
	'entries' => $this->guestbookModel->ReadAll(),
	'formAction' => $this->request->CreateUrl('guestbook/handler')
	 ));
	 }
/**
* Add a entry to the guestbook
*/
public function Handler() {
	//If $_Post['doAdd'] is is set, save the post to $this->Add and use
	//Strip_tags to sanitize the input
	if(isset($_POST['doAdd'])) {
		$this->guestbookModel->Add(strip_tags($_POST['newEntry']));
	}
	//If post['doClear'] is set, clear the guestbook
	elseif(isset($_POST['doClear'])) {
		$this->guestbookModel->DeleteAll();
	}
	//If post['doCreate'] is set, create a new table 
	elseif(isset($_POST['doCreate'])) {
		$this->guestbookModel->Init();
	}
	//Redirect to index() method 
 	header('Location: ' . $this->request->CreateUrl('guestbook'));
}

}       