<?php
/**
 * Unit tests for the Lib_Session class
 * 
 * @category    MVCLite
 * @package     Tests
 * @subpackage  Session
 * @since       File available since release 1.1.3
 * @author      Cory Collier <corycollier@corycollier.com>
 */
/**
 * Unit tests for the Lib_Session class
 * 
 * @category    MVCLite
 * @package     Tests
 * @subpackage  Session
 * @since       Class available since release 1.1.3
 * @author      Cory Collier <corycollier@corycollier.com>
 */

class SessionTest
extends PHPUnit_Framework_TestCase
{
    
    /**
     * The setup method, called before each test
     */
    public function setUp ( )
    {
        $this->fixture = Lib_Session::getInstance();
        
    } // END function setup
    
    /**
     * The tear down hook, called after each test
     */
    public function tearDown ( )
    {
        $this->fixture->destroy();
        
    } // END function tearDown
    
    /**
     * test the getInstance method of the session object
     */
    public function test_getInstance ( )
    {
        $session = Lib_Session::getInstance();
        
        $this->assertInstanceOf('Lib_Session', $session);
        
    } // END function test_getInstance
    
    /**
     * test the set params method of the session object
     * @dataProvider _provideParams
     */
    public function test_setParams ($param, $value = '')
    {
        $params = array(
            $param => $value,
        );

        $this->fixture->setParams($params);
        
        $this->assertSame($this->fixture->getParam($param), $value);
        
    } // END function test_setParams
    
    /**
     * test the get params method of the session object
     */
    public function test_getParams ( )
    {
        $params = array(
            'var1'  => 'test1',
            'var2'  => 'test2',
            'var3'  => 'test3',
        );
        
        $this->fixture->setParams($params);
        
        $this->assertSame($params, $this->fixture->getParams());
        
    } // END function test_getParams
    
    /**
     * test the set param method of the session object
     * @dataProvider _provideParams
     */
    public function test_setParam ($param, $value = '')
    {
        $this->fixture->setParam($param, $value);
        
        $this->assertSame($value, $this->fixture->getParam($param));
        
    } // END function test_setParam
    
    /**
     * test the destroy method of the session object
     */
    public function test_destroy ( )
    {
        $params = array(
            'var1'  => 'test1',
            'var2'  => 'test2',
            'var3'  => 'test3',
        );
        
        $this->fixture->setParams($params);
        
        $this->fixture->destroy();
        
        $this->assertNull($this->fixture->getParams());
        
    } // END function test_destroy
    
    /**
     * method to provide parameters to test against
     */
    public function _provideParams ( )
    {
        return array(
            array(
                'test1', 'value1',
            ),
            array(
                'test2', 'value2',
            ),
            array(
                'test3', 'value3',
            ),
        );
        
    } // END function _provideParams
    
} // END class SessionTest