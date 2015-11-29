<?php
/**
 * Unit tests for the Lib_Object class
 *
 * @category    MVCLite
 * @package     Tests
 * @subpackage  Object
 * @since       File available since release 1.0.6
 * @author      Cory Collier <corycollier@corycollier.com>
 */
/**
 * Unit tests for the Lib_Object class
 *
 * @category    MVCLite
 * @package     Tests
 * @subpackage  Object
 * @since       Class available since release 1.0.6
 * @author      Cory Collier <corycollier@corycollier.com>
 */

class Tests_Lib_ObjectTest
extends PHPUnit_Framework_TestCase
{

    /**
     * The setup method, called before each test
     */
    public function setUp ( )
    {
        $this->fixture = new Lib_Object;

    }

    /**
     * The tear down hook, called after each test
     */
    public function tearDown ( )
    {

    }

    /**
     * Test the __get method on the Lib_Object
     */
    public function test_magicMethodGet ( )
    {
        $this->setExpectedException('Lib_Exception');

        $result = $this->fixture->varaible;

    }

    /**
     * Test the __set method on the Lib_Object
     */
    public function test_magicMethodSet ( )
    {
        $this->setExpectedException('Lib_Exception');

        $this->fixture->varaible = 'empty result';

    }

    /**
     * Test the __call method on the Lib_Object
     */
    public function test_magicMethodCall ( )
    {
        $this->setExpectedException('Lib_Exception');

        $result = $this->fixture->nonExistantMethod('var');

    }

} // END class ModelTest
