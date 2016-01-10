<?php
/**
 * Unit tests for the MvcLite\Dispatcher class
 *
 * @category    MVCLite
 * @package     Tests
 * @subpackage  Dispatcher
 * @since       File available since release 1.0.2
 * @author      Cory Collier <corycollier@corycollier.com>
 */

namespace MvcLite;

use \PhpUnitTest\TestCase as TestCase;

/**
 * Unit tests for the MvcLite\Dispatcher class
 *
 * @category    MVCLite
 * @package     Tests
 * @subpackage  Dispatcher
 * @since       Class available since release 1.0.2
 * @author      Cory Collier <corycollier@corycollier.com>
 */

class DispatcherTest extends TestCase
{
    /**
     * tests the init method of the Dispatcher
     */
    public function testInit()
    {
        global $loader;

        $sut = $this->getMockBuilder('MvcLite\Dispatcher')
            ->disableOriginalConstructor()
            ->setMethods(['getConfig', 'getRequest', 'getResponse'])
            ->getMock();

        $config = $this->getMockBuilder('MvcLite\Config')
            ->disableOriginalConstructor()
            ->setMethods(['init'])
            ->getMock();
        $config->expects($this->once())->method('init');

        $request = $this->getMockBuilder('MvcLite\Request')
            ->disableOriginalConstructor()
            ->setMethods(['init'])
            ->getMock();
        $request->expects($this->once())->method('init');

        $response = $this->getMockBuilder('MvcLite\Response')
            ->disableOriginalConstructor()
            ->setMethods(['init'])
            ->getMock();
        $response->expects($this->once())->method('init');

        $sut->expects($this->once())
            ->method('getConfig')
            ->will($this->returnValue($config));

        $sut->expects($this->once())
            ->method('getRequest')
            ->will($this->returnValue($request));

        $sut->expects($this->once())
            ->method('getResponse')
            ->will($this->returnValue($response));

        $result = $sut->init($loader);
    }

    /**
     * tests the dispatch method of the dispatcher
     *
     * @runInSeparateProcess
     * @dataProvider provideDispatch
     */
    public function testDispatch($controller, $action, $loadClass = null, $params = [])
    {
        $sut = $this->getMockBuilder('\MvcLite\Dispatcher')
            ->disableOriginalConstructor()
            ->setMethods([
                'translateControllerName',
                'translateActionName',
                'getRequest',
                'getConfig',
                'getLoader',
                'setMethod',
            ])
            ->getMock();

        $loader = $this->getMockBuilder('\Composer\Autoload\ClassLoader')
            ->disableOriginalConstructor()
            ->setMethods(['loadClass'])
            ->getMock();

        $config = $this->getMockBuilder('\MvcLite\Config')
            ->disableOriginalConstructor()
            ->setMethods(['init'])
            ->getMock();

        $request = $this->getMockBuilder('\MvcLite\Request')
            ->disableOriginalConstructor()
            ->setMethods(['getParams', 'setMethod'])
            ->getMock();

        $request->expects($this->once())
            ->method('getParams')
            ->will($this->returnValue($params));

        $loader->expects($this->once())
            ->method('loadClass')
            ->with($this->equalTo($controller))
            ->will($this->returnValue($loadClass));

        $sut->expects($this->any())
            ->method('getRequest')
            ->will($this->returnValue($request));

        $sut->expects($this->any())
            ->method('getConfig')
            ->will($this->returnValue($config));

        $sut->expects($this->once())
            ->method('getLoader')
            ->will($this->returnValue($loader));

        $sut->expects($this->once())
            ->method('translateControllerName')
            ->with($this->equalTo($params['controller']))
            ->will($this->returnValue($controller));

        $sut->expects($this->once())
            ->method('translateActionName')
            ->with($this->equalTo($params['action']))
            ->will($this->returnValue($action));

        $result = $sut->init($loader);

        $sut->dispatch();

        // $this->assertSame('error', $r equest->getParam('action'));
    }

    /**
     * Data provider for DispatcherTestCase::testDispatch.
     *
     * @return array An array of data to use for testing.
     */
    public function provideDispatch()
    {
        return [
            'good controller request' => [
                'controller' => '\App\IndexController',
                'action'    => 'index',
                'exception' => true,
                'params' => [
                    'controller' => 'index',
                    'action'    => 'index'
                ]
            ],

            'bad controller request' => [
                'controller' => '\App\FailController',
                'action'    => 'index',
                'exception' => null,
                'params' => [
                    'controller' => 'index',
                    'action'    => 'index'
                ]
            ],
        ];
    }

    /**
     * Tests testTranslateControllerName().
     *
     * @dataProvider provideTranslateControllerName
     */
    public function testTranslateControllerName($expected, $input, $filtered)
    {
        $sut = $this->getMockBuilder('\MvcLite\Dispatcher')
            ->disableOriginalConstructor()
            ->setMethods(['getFilterChain'])
            ->getMock();

        $chain = $this->getMockBuilder('\MvcLte\FilterChain')
            ->disableOriginalConstructor()
            ->setMethods(['filter'])
            ->getMock();

        $chain->expects($this->once())
            ->method('filter')
            ->with($this->equalTo($input))
            ->will($this->returnValue($filtered));

        $sut->expects($this->once())
            ->method('getFilterChain')
            ->with($this->equalTo(['DashToCamelcase', 'StringToProper']))
            ->will($this->returnValue($chain));

        $result = $this->getReflectionMethod($sut, 'translateControllerName')->invoke($sut, $input);
        $this->assertEquals($expected, $result);
    }

    /**
     * Data provider for testTranslateControllerName.
     *
     * @return array An array of data to use for testing.
     */
    public function provideTranslateControllerName()
    {
        return [
            'simple' => [
                'expected' => '\App\ValueController',
                'input'    => 'value',
                'filtered' => 'Value',
            ],

            'with dashes' => [
                'expected' => '\App\SomeValueController',
                'input'    => 'some-value',
                'filtered' => 'SomeValue',
            ],
        ];
    }

    /**
     * Tests MvcLite\Dispatcher::translateActionName.
     *
     * @param  string $expected The expected result
     * @param  string $input    The input string
     *
     * @dataProvider provideTranslateActionName
     */
    public function testTranslateActionName($expected, $input, $filtered)
    {
        $sut = $this->getMockBuilder('\MvcLite\Dispatcher')
            ->disableOriginalConstructor()
            ->setMethods(['getFilterChain'])
            ->getMock();

        $chain = $this->getMockBuilder('\MvcLte\FilterChain')
            ->disableOriginalConstructor()
            ->setMethods(['filter'])
            ->getMock();

        $chain->expects($this->once())
            ->method('filter')
            ->with($this->equalTo($input))
            ->will($this->returnValue($filtered));

        $sut->expects($this->once())
            ->method('getFilterChain')
            ->with($this->equalTo(['DashToCamelcase']))
            ->will($this->returnValue($chain));

        $result = $this->getReflectionMethod($sut, 'translateActionName')->invoke($sut, $input);
        $this->assertEquals($expected, $result);

    }

    /**
     * Data provider for testTranslateActionNAme
     *
     * @return array An array of data to use for testing.
     */
    public function provideTranslateActionName()
    {
        return [
            'simple' => [
                'expected' => 'valueAction',
                'input'    => 'value',
                'filtered' => 'value',
            ],

            'with dashes' => [
                'expected' => 'someValueAction',
                'input'    => 'some-value',
                'filtered' => 'someValue',
            ],
        ];
    }
}

// @codingStandardsIgnoreStart
// testing classes
namespace App;
class IndexController extends \MvcLite\Controller {}
class ErrorController extends \MvcLite\Controller{
    public function errorAction(){}
}
// @codingStandardsIgnoreEnd
