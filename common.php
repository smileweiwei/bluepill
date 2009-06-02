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
function __autoload()
{
	/**
	* The Savant template engine and our own implementation
	*/
	require 'includes/third_party/Savant3-3.0.0/Savant3.php';
	require 'includes/class_template.php';
}

$template = new template();
?>