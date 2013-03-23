<?php
/**
 * A form for editing the user profile.
 * 
 * @package FrostCore
 */
class CFormUserCreate extends CForm {

  /**
   * Constructor
   */
  public function __construct($object) {
    parent::__construct();
    $this->AddElement(new CFormElementText('acronym', array('required'=>true)))
         ->AddElement(new CFormElementPassword('password', array('required'=>true)))
         ->AddElement(new CFormElementPassword('password1', array('required'=>true, 'label'=>'Password again:')))
         ->AddElement(new CFormElementText('name', array('required'=>true)))
         ->AddElement(new CFormElementText('email', array('required'=>true)))
         ->AddElement(new CFormElementSubmit('create', array('callback'=>array($object, 'DoCreate'))));

    $this->SetValidation('name', array('not_empty'));
    $this->SetValidation('password', array('not_empty'));
    $this->SetValidation('password1', array('not_empty'));
    $this->SetValidation('email', array('not_empty'));
    $this->SetValidation('acronym', array('not_empty'));



  }
  
}