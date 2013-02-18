<?php
class CFormElementText extends CForm {
/**
* Constructor
*
* @param string name of the element
* @param array attributes to set to the element. Default is an empty array.
*/
public function __contruct($name, $attributes=array()) {
	parent::__construct($name, $attributes);
	$this['type'] = 'text';
	$this->UseNameAsDefaultLabel();
}

}