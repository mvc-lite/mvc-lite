<?php
/**
 * Unit tests for the camelcase to dash class
 *
 * @category    MVCLite
 * @package     Tests
 * @subpackage  Controller
 * @since       File available since release 1.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */

namespace MvcLite;

use \MvcLite\Filter;

/**
 * Unit tests for the camelcase to dash class
 *
 * @category    MVCLite
 * @package     Tests
 * @subpackage  Controller
 * @since       Class available since release 1.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */

class FilterCamelcaseToDashTest extends \MvcLite\TestCase
{
    /**
     * method to test the camelcase-to-dash class's filter method
     *
     * @param string $unfiltered
     * @param string $expected
     * @dataProvider provide_filter
     */
    public function test_filter ($unfiltered, $expected)
    {
        $filter = new \MvcLite\Filter\CamelcaseToDash;

        $this->assertSame($expected, $filter->filter($unfiltered));

    }

    /**
     * provider of data to test the camelcase-to-dash class's filter method
     */
    public function provide_filter ( )
    {
        return array(
            array('somethingElse', 'something-else'),
            array('somethingelse', 'somethingelse'),
            array('somethinGelse', 'somethin-gelse'),
        );

    }

} // END class Tests_\MvcLite\Filter\CamelcaseToDashTest
