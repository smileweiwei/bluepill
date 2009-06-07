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
* Our login class contains all of user login stuff, etc.
*/
class user
{
	/**
	* User data
	*/
	public $data = array();
	
	/**
	* Setup our user session, etc. Also setups our style
	*/
	function __construct()
	{
		global $db, $general, $template;
		
		// @todo once user schema is setup, get the user info and populate data
		
		$template->set_template_name($general->config['force_style'] == 0 ? $user->data['user_style'] : $general->config['system_style']);
		
	}
	
	/**
	* Our login function
	* @param $name mixed Username
	* @param $pass mixed Password (not hashed)
	* @return bool True if successful, otherwise false. Also updates the session info
	*/
	function login($name, $pass)
	{
		
	}
}
?>