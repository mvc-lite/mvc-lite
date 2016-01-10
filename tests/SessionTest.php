<?php
/**
 * Unit tests for the MvcLite\Session class
 *
 * @category    PHP
 * @package     MvcLite
 * @subpackage  Tests
 * @since       File available since release 1.1.3
 * @author      Cory Collier <corycollier@corycollier.com>
 */

namespace MvcLite;

use \PhpUnitTest\TestCase as TestCase;

/**
 * Unit tests for the MvcLite\Session class
 *
 * @category    PHP
 * @package     MvcLite
 * @subpackage  Tests
 * @since       Class available since release 1.1.3
 * @author      Cory Collier <corycollier@corycollier.com>
 */

class SessionTest extends TestCase
{

    /**
     * The setup method, called before each test
     */
    public function setUp()
    {
        $this->sut = Session::getInstance();
    }

    /**
     * tests the init method of the Session object
     *
     * @param array $data An array of data.
     *
     * @dataProvider provideData
     * @runInSeparateProcess
     */
    public function testInit($data = [])
    {
        $this->sut->init($data);
        $result = $this->getReflectionPropertyValue($this->sut, 'data');
        $this->assertEquals($data, $result);
    }

    /**
     * test the set params method of the session object.
     *
     * @dataProvider provideParams
     */
    public function testSetParams($param, $value = '')
    {
        $params = [$param => $value];
        $this->sut->setParams($params);
        $this->assertSame($this->sut->getParam($param), $value);
    }

    /**
     * test the get params method of the session object
     *
     * @param array $data An array of data.
     *
     * @dataProvider provideData
     */
    public function testGetParams($data = [])
    {
        $this->setReflectionPropertyValue($this->sut, 'data', $data);
        $result = $this->sut->getParams();
        $this->assertSame($data, $result);
    }

    /**
     * test the set param method of the session object.
     *
     * @dataProvider provideParams
     */
    public function testSetParam($param, $value = '')
    {
        $this->sut->setParam($param, $value);
        $this->assertSame($value, $this->sut->getParam($param));
    }

    /**
     * test the destroy method of the session object
     *
     * @dataProvider provideData
     * @runInSeparateProcess
     */
    public function testDestroy($data = [])
    {
        session_start();
        $this->sut->setParams($data);
        $this->sut->destroy();
        $this->assertNull($this->sut->getParams());
    }

    /**
     * method to provide parameters to test against
     */
    public function provideParams()
    {
        return [
            'simple test' => [
                'param' => 'test1',
                'value' => 'value1',
            ],
        ];
    }

    /**
     * Provides data for associative array type needs.
     *
     * @return array An associative array.
     */
    public function provideData()
    {
        return [
            'simple test' => [
                'data'=> [
                    'var1'  => 'test1',
                    'var2'  => 'test2',
                    'var3'  => 'test3',
                ],
            ],
        ];
    }
}
