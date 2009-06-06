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
*	Controls the loading and rendering of modules
*/
class module_master
{
	/**
	* Modules that are currently loaded
	* 'name' refers to the modules name given to the user
	* 'mode' refers to the module mode passed to the leader
	* 'internal' refers to the internal file name
	* 'instant' refers to the function name within the script that the class is instantiated as
	* Each module looks like array('name' => '', 'class' => '', 'mode' => '', 'internal => '', 'instant' => '')
	*/
	private $_modules = array();
	
	/**
	* The module output to the template
	*/
	private $_module_output = array();
	
	/**
	* Load a module
	* @param string $internal_name The name used within the filesystem
	* @param string $mode The module mode
	* @param array $args The arguments passed to the module
	* @param string $module_class The parent class (folder) of the module
	* @return bool Returns true if instantiated, false otherwise
	*/
	function load($internal_name, $mode = '', $args = array(), $module_class = '')
	{
		// First we need to make sure the module exists
		if (!file_exists(BASE_DIR . 'modules/' . (empty($module_class) ? '' : $module_class . '/') . $internal_name . '.php') || class_exists($internal_name))
		{
			return false;
		}
		
		require BASE_DIR . 'modules/' . (empty($module_class) ? '' : $module_class . '/') . $internal_name . '.php';
		
		/* Looks like we need to do an instantiation to get the info we want, then do it again for the script.
		 @todo remove for PHP 5.3.0 */
		$module_temp =& new $internal_name;
		
		// Since some modules specify dependencies, see if those are loaded and return false if they are not
		if (sizeof($module_temp->$_dependencies))
		{
			foreach($module->temp->_dependencies as $depends)
			{
				if (!in_array($this->_modules, $depends))
				{
					return false;
				}
			}
		}
		
		unset($module_temp);
		
		$gen_name = '_' . md5($internal_name . time());
		
		$this->$gen_name = new $internal_name;
		
		$module_details = $this->$gen_name->_name = array(
			'name'		=> $this->$gen_name->_name,
			'class'		=> $this->$gen_name->_class,
			'mode'		=> $mode,
			'internal'	=> $this->$gen_name->_internal,
			'instant'	=> $gen_name,
		);
		
		array_push($this->_modules, $module_details);
		
		$this->$gen_name->module_setup($mode, $args);
	}
	
	/**
	* Send module output (all of those loaded) to template
	* @param string $class If class is specified, only the output of modules of said class will be loaded
	*/
	function load_to_template($class = '')
	{
		global $template;
		
		foreach($this->_modules as $load_module)
		{
			if (empty($class) || $load_module['class'] == $class)
			{
				array_push($this->_module_output, array($load_module['internal'] => $this->$load_module['instant']->get_output));
			}
		}
		
		$template->assign('modules', $this->module_output, true, false);
	}
}
?>