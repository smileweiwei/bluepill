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
* The abstract class the defines the methods and variables that modules must implement
*/
abstract class module
{
	/**
	* The module name (display to the user)
	*/
	public $_name = null;
	
	/**
	* The module name (internal)
	*/
	public $_internal = null;
	
	/**
	* The module author
	*/
	public $_author = null;
	
	/**
	* The module version
	*/
	public $_version = null;
	
	/**
	* The module author
	*/
	public $_author = null;
	
	/**
	* The module class (the folder it is located in)
	*/
	public $_class = null;
	
	/**
	* The module dependencies
	*/
	public $_depends = array();
	
	/**
	* The setup function called when the module is loaded
	* @param string $mode The module's mode (passed to module_master by the script, will be provided if passed)
	* @param array $args Arguments specified by the calling script
	* @return bool Returns true
	*/
	abstract public function module_setup($mode = '', $args);
	
	/**
	* The output fetcher, retrieves any HTML the module may wish to output
	* Note: Modules should _NOT_ communicate directly with the template engine
	* All template calls should be handled with module_master
	* All processing regarding this output should be done in module_setup or a function called by it
	* @return string The output to send to the template
	*/
	abstract public function get_output();
}
?>