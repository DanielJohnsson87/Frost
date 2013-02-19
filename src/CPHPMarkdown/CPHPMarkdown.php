<?php
/**
* A wrapper for HTMLPurifier by Edward Z. Yang, http://htmlpurifier.org/
*
* @package LydiaCore
*/
class CPHPMarkdown {

  /**
   * Properties
   */
  public static $instance = null;


  /**
   * phpmarkdown it. Create an instance of PHPMarkdown if it does not exists.
   *
   * @param $text string the dirty HTML.
   * @returns string as the clean HTML.
   */
   public static function PHPMarkdown($text) {   
    if(!self::$instance) {
      require_once(__DIR__.'/PHP Markdown Extra 1.2.6/markdown.php');
        self::$instance = Markdown($text);

    }
        return self::$instance;

  }
 
 
}