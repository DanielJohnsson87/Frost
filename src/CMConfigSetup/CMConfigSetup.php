<?php 
/**
* A model for a seting up the site/config.php via the 5-min-install.
*
* @package FrostCore
*/
class CMConfigSetup extends CObject implements IHasSQL, IModule {


  /**
   * Constructor
   */
  public function __construct() {
    parent::__construct();
  }

   /**
   * Implementing interface IHasSQL. Encapsulate all SQL used by this class.
   *
   * @param string $key the string that is the key of the wanted SQL-entry in the array.
   */
  public static function SQL($key=null) {
    $queries = array(
      'create table config'  => "CREATE  TABLE IF NOT EXISTS 'config' ('id' INTEGER PRIMARY KEY  AUTOINCREMENT  NOT NULL , 'setting' , 'value' );",
      'insert into config'   => 'INSERT INTO "config" ("setting","value") VALUES ("Fastvärde1","Fastvärde2");',
      'select * from config' => 'SELECT * FROM config ORDER BY id DESC;',
     );
    if(!isset($queries[$key])) {
      throw new Exception("No such SQL query, key '$key' was not found.");
    }
    return $queries[$key];
  }
/**
* Implementing interface IModule. Manage install/update/deinstall and equal actions.
*/
  public function Manage($action=null) {
    switch($action) {
      case 'install':
    try {
      $this->db->ExecuteQuery(self::SQL('create table config'));
      $this->db->ExecuteQuery(self::SQL('insert into config'));
          return array('success', 'Successfully created the database tables and created a default "Hello World" blog post, owned by you.');

    } catch(Exception$e) {
      die("$e<br/>Failed to open database: " . $this->config['database'][0]['dsn']);
    }
    break;

    default:
    throw new Exception('Unsupported action for this module.');
    break;
  }

  }

}