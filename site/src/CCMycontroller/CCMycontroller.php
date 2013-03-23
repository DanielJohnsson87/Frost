<?php
/**
* Sample controller for a site builder.
*/
class CCMycontroller extends CObject implements IController {

  /**
   * Constructor
   */
  public function __construct() { parent::__construct(); 
    //Change the nav menu to the nav menu named small
  $this->config['theme']['menu_to_region'] = array('small' => 'header-menu');
}
 

  /**
   * The page about me
   */
  public function Index() {
    
    if(!empty($this->request->arguments['2'])) {
    $arguments = $this->request->arguments['2'];
    } else {
      $this->request->arguments['2'] = "hello-world";
    $arguments = $this->request->arguments['2'];
  }

     $content = new CMContent($arguments);
    $this->views->SetTitle(htmlEnt($content['title']));
    $this->views->AddInclude(__DIR__ . '/page.tpl.php', array(
                  'content' => $content,
                ));
  }


  /**
   * The blog.
   */
  public function Blog() {
    $content = new CMContent();
    $this->views->SetTitle('My blog');
    $this->views->AddInclude(__DIR__ . '/blog.tpl.php', array(
                  'contents' => $content->ListAll(array('type'=>'post', 'order-by'=>'title', 'order-order'=>'DESC')),
                ) , 'content');
    $this->views->AddInclude(__DIR__ . '/sidebar.tpl.php', array(
      'content'=> $content->ListAll(array('type'=>'post', 'order-by'=>'title', 'order-order'=>'DESC'))), 'sidebar');

  }


  /**
   * The guestbook.
   */
  public function Guestbook() {
    $guestbook = new CMGuestbook();
    $form = new CFormMyGuestbook($guestbook);
    $status = $form->Check();
    if($status === false) {
      $this->AddMessage('notice', 'The form could not be processed.');
      $this->RedirectToControllerMethod();
    } else if($status === true) {
      $this->RedirectToControllerMethod();
    }
   
    $this->views->SetTitle('My Guestbook');
    $this->views->AddInclude(__DIR__ . '/guestbook.tpl.php', array(
            'entries'=>$guestbook->ReadAll(),
            'form'=>$form,
         ));
  }
 

}


/**
* Form for the guestbook
*/
class CFormMyGuestbook extends CForm {

  /**
   * Properties
   */
  private $object;

  /**
   * Constructor
   */
  public function __construct($object) {
    parent::__construct();
    $this->object = $object;
    $this->AddElement(new CFormElementTextarea('data', array('label'=>'Add entry:')));
    $this->AddElement(new CFormElementSubmit('add', array('callback'=>array($this, 'DoAdd'), 'callback-args'=>array($object))));
  }
 

  /**
   * Callback to add the form content to database.
   */
  public function DoAdd($form, $object) {
    return $object->Add(strip_tags($form['data']['value']));
  }


}