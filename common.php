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
* Autoloads any files that may be needed for includes.
* By using this, it means that we do not need to include them on our own...
* PHP will check here if the function does not exist and include all of these for us
*/
function __autoload($temp)
{
	/**
	* The Savant template engine and our own implementation
	*/
	require BASE_DIR . 'includes/third_party/Savant3-3.0.0/Savant3.php';
	require BASE_DIR . 'includes/class_template.php';
	
	/**
	* adodb5 (for database abstraction)
	*/
	require BASE_DIR . 'includes/third_party/adodb5/adodb.inc.php';
	
	/**
	* Our modules system
	*/
	require BASE_DIR . 'includes/abstract_module.php';
	require BASE_DIR . 'includes/class_module_master.php';
}

define('BASE_DIR', getcwd() . '/');

$template = new template();

require 'config.php';
$db = NewADOConnection($db_info['dbms']);
$db->Connect($db_info['host'], $db_info['user'], $db_info['pass'], $db_info['name']);
define('DB_PREFIX', $db_info['pfix']);
unset($db_info);

require BASE_DIR . 'includes/constants.php';

$p_master = new module_master();
?>