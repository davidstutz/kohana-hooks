<?php defined('SYSPATH') or die('No direct access allowed.');
/**
 * Hooks - event class for kohana.
 *
 * @package		Hooks
 * @author		David Stutz
 * @copyright	(c) 2013 - 2014 David Stutz
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
     * 
     * 
     * @param   string  event
     * @param   array   args
     * @return  array   results
     */
   protected static function execute($event, array $args = array())
   {
        $results = array();
        
        if (isset(self::$_events[$event])) {
            foreach (self::$_events[$event] as $hook) {
                $results[] = call_user_func_array($hook[0], array_merge($hook[1], $args));
            }
        }
        
        return $results;
    }

    /**
     * Fires an given event.
     *
     * @param	string	event
     * @param	array 	args
     * @return void
     */
    public static function fire($event, array $args = array()) {
        self::execute($event, $args);
    }
    
    /**
     * Fires a given event and collects the results as array.
     * 
     * @param   string  event
     * @param   array   args
     * @return  array   results
     */
    public static function collect($event, array $args = array()) {
        return self::execute($event, $args);
    }
    
    /**
     * Register an event.
     *
     * @param	mixed		$event
     * @param	callable	$function
     * @param	array 		$args
     */
    public static function register($event, $function, array $args = array()) {
        if (is_array($event)) {
            foreach ($event as $name) {
                self::register($name, $function, $args);
            }
        } else {
            if (!isset(self::$_events[$event])) {
                self::$_events[$event] = array();
            }
            if (!in_array(array($function, $args), self::$_events[$event])) {
                self::$_events[$event][] = array($function, $args);
            }
        }
    }

    /**
     * Check for registered functions.
     *
     * @param	mixed	$event
     * @return	array   number of registered functions
     */
    public static function registered($event) {
        if (is_array($mixed)) {
            return array_intersect_key(self::$_events, array_reverse($event));
        }
        return isset(self::$_events[$event]) ? self::$_events[$event] : array();
    }

}
