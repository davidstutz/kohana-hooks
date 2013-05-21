<?php defined('SYSPATH') OR die('Kohana bootstrap needs to be included before tests run');

/**
 * Tests the Arr lib that's shipped with kohana
 *
 * @group hooks
 *
 * @package     Hooks
 * @author      David Stutz
 * @copyright   (c) 2013 David Stutz
 * @license     http://opensource.org/licenses/bsd-3-clause
 */
class Hooks_HooksTest extends Unittest_TestCase {

    /**
     * Set up by resetting hooks.
     */
    public function setUp() {
        parent::setUp();
        
        Hooks::reset();
    }
    
    /**
     * Provides test data for testing reset.
     *
     * @return array
     */
    public function provider_reset() {
        return array(
            array(
                array('event1', 'event2', 'event3'),
                array('function1', 'function2', 'function3'),
            ),
        );
    }
    
    
     /**
     * Tests Hooks::reset().
     * 
     * @test
     * @dataProvider provider_reset
     * @param   array   events
     * @param   array   functions
     */
    public function test_reset($events, $functions) {
        foreach ($events as $event) {
            foreach ($functions as $function) {
                Hooks::register($event, $function);
            }
        }
        
        Hooks::reset();
        
        foreach ($events as $event) {
            $this->assertSame(0, sizeof(Hooks::registered($event)));
            $this->assertSame(array(), Hooks::registered($event));
        }
    }
    
    /**
     * Provides test data for testing register.
     *
     * @return array
     */
    public function provider_register() {
        return array(
            array(
                'event',
                'function',
                array(),
                array(array('function', array()))
            ),
            array(
                'event',
                'function',
                array(1,2,3,4),
                array(array('function', array(1,2,3,4)))
            ),
        );
    }

    /**
     * Tests Hooks::register().
     *
     * @test
     * @dataProvider provider_register
     * @param   string  event
     * @param   string  function
     * @param   array   expected
     */
    public function test_register($event, $function, $args, $expected) {
        Hooks::reset();
        Hooks::register($event, $function, $args);
        $registered = Hooks::registered($event);
        
        $this->assertSame(sizeof($expected), sizeof($registered));
        $this->assertSame($expected, $registered);
    }
    
    /**
     * Provides test data for testing fire.
     *
     * @return array
     */
    public function provider_fire() {
        return array(
            array(
                array(0,10,20),
                array(0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29)
            ),
        );
    }
    
    /**
     * Tests Hooks::fire().
     * 
     * @test
     * @dataProvider provider_fire
     * @param   array   functions
     * @param   string  expected
     */
    public function test_fire($parameters, $expected) {
        foreach ($parameters as $parameter) {
            Hooks::register('event', function($k, &$array) {
                for ($i = $k; $i < $k + 10; $i++) {
                    $array[] = $i;
                }
            }, array($parameter));
        }
        
        $array = array();
        Hooks::fire('event', array(&$array));
        
        $count = 0;
        foreach ($parameters as $parameter) {
            for ($i = $parameter; $i < $parameter + 10; $i++) {
                $count++;
                $this->assertContains($i, $array);
            }
        }
        
        $this->assertSame($count, sizeof($array));
    }
}