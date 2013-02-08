<?php
/**
* Helpers for theming, available for all themes in their template files and functions.php. 
* This file is included right before the themes own functions.php
*/

/**
* Create a url by prepending the base_url
*/
function base_url($url) {
	return CLydia::Instance()->request->base_url . trim($url, '/');
}

/**
* Return the current url
*/
function current_url() {
	return CLydia::Instance()->request->current_url;
}
/**
* Render all views.
*/
function render_views() {
	return CLydia::Instance()->views->Render();
}
/**
* Print debuginformation from the framework.
*/
function get_debug() {
  $ly = CLydia::Instance(); 
  $html = null;
  if(isset($ly->config['debug']['db-num-queries']) && $ly->config['debug']['db-num-queries'] && isset($ly->db)) {
    $html .= "<p>Database made " . $ly->db->GetNumQueries() . " queries.</p>";
  }   
  if(isset($ly->config['debug']['db-queries']) && $ly->config['debug']['db-queries'] && isset($ly->db)) {
    $html .= "<p>Database made the following queries.</p><pre>" . implode('<br/><br/>', $ly->db->GetQueries()) . "</pre>";
  }   
  if(isset($ly->config['debug']['lydia']) && $ly->config['debug']['lydia']) {
    $html .= "<hr><h3>Debuginformation</h3><p>The content of CLydia:</p><pre>" . htmlent(print_r($ly, true)) . "</pre>";
  }   
  if(isset($ly->config['debug']['session']) && $ly->config['debug']['session']) {
    $html .= "<hr><h3>SESSION</h3><p>The content of CLydia->session:</p><pre>" . htmlent(print_r($ly->session, true)) . "</pre>";
    $html .= "<p>The content of \$_SESSION:</p><pre>" . htmlent(print_r($_SESSION, true)) . "</pre>";
  }  
  return $html;
}
  /**
  * Get message stored in flash-session
  */
function get_messages_from_session() {
  	$messages = CLydia::Instance()->session->GetMessages();
  	$html = null;
  	if(!empty($messages)) {
  		foreach($messages as $val) {
  			$valid = array('info', 'notice', 'success', 'warning', 'error', 'alert');
  			$class = (in_array($val['type'], $valid)) ? $val['type'] : 'info';
  			$html .= "<div class='$class'>{$val['message']}</div>\n";
  		}
  	}
  	return $html;
  }