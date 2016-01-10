<?php
/**
 * String to lower filter test
 *
 * @category    PHP
 * @package     MvcLite
 * @subpackage  Tests
 * @since       File available since release 1.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */

namespace MvcLite;

use MvcLite\Filter;
use MvcLite\Filter\StringToLower as StringToLower;
use \PhpUnitTest\TestCase as TestCase;

/**
 * String to lower filter test
 *
 * @category    PHP
 * @package     MvcLite
 * @subpackage  Tests
 * @since       Class available since release 1.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */

class FilterStringToLowerTest extends TestCase
{
    /**
     *
     * method to test the StringToLower filter's ability to filter a string
     *
     * @param string $unfiltered
     * @param string $expected
     *
     * @dataProvider provideFilter
     */
    public function testFilter($unfiltered, $expected)
    {
        $filter = new StringToLower;
        $this->assertSame($expected, $filter->filter($unfiltered));
    }

    /**
     * provide data for testing the StringToLower filter's ability to filter
     *
     * @return array An array of data to use for testing the filter.
     */
    public function provideFilter()
    {
        return [
            ['Word', 'word'],
            ['Lion', 'lion'],
            ['tIer', 'tier'],
            ['The Dog', 'the dog'],
            ['123 SomethinG', '123 something'],
            ['wow AWeSoME', 'wow awesome'],
        ];
    }
}
