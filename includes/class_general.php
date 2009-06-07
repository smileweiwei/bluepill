<?php
/**
*
* @package bluepill
* @version $Id$
* @copyright (c) 2009 p3net
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
* General purpose functions
*/
class bluepill_general
{
	/**
	* Config array (populated directly from db table)
	*/
	public $config = array();
	
	/**
	* Our constructor, also setups the config array
	*/
	function __construct()
	{
		global $db;
		
		$_query = 'SELECT * FROM ' . CONFIG_TABLE;
		$this->config = $db->GetAll($_query);
	}
}
?>