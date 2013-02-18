<?php
/**
* Interface for class that interacts with the database to encapsulate all SQL requests.
* @package FrostCore
*/
interface IHasSQL {
	public static function SQL($key=null);
}