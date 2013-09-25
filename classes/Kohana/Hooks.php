<?php defined('SYSPATH') or die('No direct access allowed.');
/**
 * Hooks - event class for kohana.
 *
 * @package		Hooks
 * @author		David Stutz
 * @copyright	(c) 2013 David Stutz
 * @license		http://opensource.org/licenses/bsd-3-clause
 */
class Kohana_Hooks {

    /**
     * @var	array 	events
     */
    protected static $_events = array();

    public static function reset() {
        Hooks::$_events = array();
    }

    /**
     * Fires an given event.
     *
     * @param	string	event
     * @param	array 	args
     */
    public static function fire($event, array $args = array()) {
        if (isset(Hooks::$_events[$event])) {
            foreach (Hooks::$_events[$event] as $array) {
                call_user_func_array($array[0], array_merge($array[1], $args));
            }
        }
    }
    
    /**
     * Fires a given event and collects the results as array.
     * 
     * @param   string  event
     * @param   array   args
     * @return  array   results
     */
    public static function collect($event, array $args = array()) {
        $results = array();
        
        if (isset(Hooks::$_events[$event])) {
            foreach (Hooks::$_events[$event] as $array) {
                $results[] = call_user_func_array($array[0], array_merge($array[1], $args));
            }
        }
        
        return $results;
    }
    
    /**
     * Register an event.
     *
     * @param	mixed		event
     * @param	string	function
     * @param	array 		args
     */
    public static function register($mixed, $function, $args = array()) {
        if (is_array($mixed)) {
            foreach ($mixed as $event) {
                Hooks::$_events[$event][] = array($function, $args);
            }
        }
        else {
            Hooks::$_events[$mixed][] = array($function, $args);
        }
    }

    /**
     * Check for registered functions.
     *
     * @param	mixed	event
     * @return	int		number of registered functions
     */
    public static function registered($mixed) {
        if (is_array($mixed)) {
            $array = array();
            
            foreach ($mixed as $event) {
                if (isset(Hooks::$_events[$event])) {
                    array_merge($array, Hooks::$_events[$event]);
                }
            }
            
            return $array;
        }
        else {
            if (isset(Hooks::$_events[$mixed])) {
                return Hooks::$_events[$mixed];
            }
            else {
                return array();
            }
        }
    }

}
