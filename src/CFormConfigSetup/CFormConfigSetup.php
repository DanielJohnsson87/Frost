<?php
/**
 * A form for editing the user profile.
 * 
 * @package FrostCore
 */
class CFormConfigSetup extends CForm {

  /**
   * Constructor
   */
  public function __construct($object) {
    parent::__construct();
    $this->AddElement(new CFormElementText('hashing_algorithm', array('required'=>false)))
          ->AddElement(new CFormElementText('language', array('required'=>false)))
          ->AddElement(new CFormElementText('url_type', array('required'=>false)))
          ->AddElement(new CFormElementSubmit('create', array('callback'=>array($object, 'DoCreate'))));
  }
  
}