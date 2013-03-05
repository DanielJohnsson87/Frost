<?php 
/**
* A test controller for themes.
*
* @package FrostCore
*/
class CCTheme extends CObject implements IController {

	/**
	* Construct
	*/
	public function __construct() {
		parent::__construct();
    $this->views->AddStyle('body:hover{background:#fff url('.$this->request->base_url.
    	'themes/grid/img/grid_12_60_20.png) repeat-y center top;}');	}

	/**
	* Display what can be done with this controller.
	*/
	public function Index() {
		$this->views->SetTitle('Theme');
		$this->views->AddInclude(__DIR__ . '/index.tpl.php', array(
			'theme_name' => $this->config['theme']['name'],
			));
	}

	public function Test() {
		$this->views->SetTitle('This is a test site');
		$this->views->AddInclude(__DIR__ . '/h1h6.tpl.php', array(), 'content'
			);
	}
	/**
	* Put content in some regions.
	*/
	public function SomeRegions() {
		$this->views->SetTitle('Theme display content for some regions.');
		$this->views->AddString('This is the headline', array(), 'headline');

		if(func_num_args()) {
			foreach(func_get_args() as $val) {
				$this->views->AddString("This is region: $val", array(), $val);
				$this->views->AddStyle('#'.$val.'{background-color:hsla(0,0%,90%,0.5);}');
			}
		}
	}

   /**
   * Put content in all regions.
   * Must define all valid regions in site/config.php
   */
 	 public function AllRegions() {
    $this->views->SetTitle('Theme display content for all regions');
    foreach($this->config['theme']['regions'] as $val) {
      $this->views->AddString("This is region: $val", array(), $val);
      $this->views->AddStyle('#'.$val. '{background:hsla(0,0%,90%,0.5);}');
    }
  }
}