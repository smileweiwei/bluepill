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
* Our template class is instantiated automatically by __autoload
* Contains the various functions used on top of Savant3 in order
* to do everything we need (It seems to be much cleaner to extend
* it than modify it directly so we can just drop-in a new release)
*/
class template extends Savant3
{
	/**
	* Defines if our template variables are overwritable
	* Will throw an exception if we try to override a protected variable
	*/
	private $_protected_variables = array();
	
	/**
	* Assigns variables to the Savant instance for use in the template
	* @param string $name The name the variable will use within the Savant instance
	* @param mixed $value The value of the variable that will be used within the template
	* @param bool $overwrite Whether or not the value should be overwritten if the variable already exists (default to true)
	* @param bool $protected Defines if our variable can be overwritten (only define false if vital to system functions)
	* @param bool $merge Regardless of $protected, if overwriting occurs, will merge instead of doing intended action if both are arrays as long as overwrite is true
	* @return bool Returns true if the value is not assigned OR if the value is already assigned but $overwrite is set to true, otherwise returns false.
	*/
	function assign($name, $value, $overwrite = true, $protected = false, $merge = false)
	{
		if (!isset($this->$name))
		{
			$this->$name = $value;
			
			if ($protected)
			{
				$this->_protected_variables = array_merge($this->_protected_variables, array($name));
			}
			return true;
		}
		else
		{
			if ($overwrite)
			{
				if ($merge && is_array($this->$name) && is_array($value))
				{
					$this->$name = array_merge($this->$name, $value);
					return true;
					
				}
				else if (in_array($this->_protected_variables, $name))
				{
					throw new exception('Attempted to overwrite protected variable \'' . $name . '\'');
					return false;
				}
				$this->$name = $value;
				return true;
			}
		}
		
		return false;
	}
	
	/*
	* Setup a custom template loading function that allows us to specify a custom theme.
	* @param string $template_file Then name of the template file to return
	* @return bool Returns true if successful, otherwise throws an exception if the file does not exist
	*/
	function load($template_file)
	{
		$theme = 'test'; // @todo we need to actually get this the right way, this is placeholder
		$ template_file = BASE_DIR . '/styles/' . $theme . '/' . $template_file . '.tpl';
		
		if (!file_exists($template_file))
		{
			throw new exception('Could not load template file ' . $template_file . ' in theme ' . $theme);
		}
		
		$this->display($template_file);
		return true;
	}
}
?>