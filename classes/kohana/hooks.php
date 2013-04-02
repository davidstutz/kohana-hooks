<?php defined('SYSPATH') or die('No direct access allowed.');
/**
 * Hooks - event class for kohana.
 * 
 * @package		Hooks
 * @author		David Stutz
 * @copyright	(c) 2012 David Stutz
 * @license		http://opensource.org/licenses/bsd-3-clause
 */
class Kohana_Hooks
{

	/**
	 * @var	array 	events
	 */
	protected static $_events = array();
	
	/**
	 * Fires an given event.
	 * 
	 * @param	string	event
	 * @param	array 	args
	 */
	public static function fire($event, $args = array())
	{
		if(isset(Kohana_Hooks::$_events[$event]))
		{
			foreach(Kohana_Hooks::$_events[$event] as $array)
			{
				call_user_func_array($array[0], array_merge($array[1], $args));
			}
		}
	}

	/**
	 * Register an event.
	 * 
	 * @param	string		event
	 * @param	string	function
	 * @param	array 		args
	 */
	public static function register($event, $function, $args = array())
	{
		Kohana_Hooks::$_events[$event][] = array($function, $args);
	}
	
	/**
	 * Check for registered functions.
	 * 
	 * @param	string	event
	 * @return	int		number of registered functions
	 */
	public static function registered($event)
	{
		if (isset(Kohana_Hooks::$_events[$event]))
		{
			return Kohana_Hooks::$_events[$event];
		}
		else
		{
			return array();
		}
	}
}
