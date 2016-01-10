<?php
/**
 * String to upper filter test
 *
 * @category    PHP
 * @package     MvcLite
 * @subpackage  Tests
 * @since       File available since release 1.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */

namespace MvcLite;

use MvcLite\Filter;
use MvcLite\Filter\StringToUpper as StringToUpper;
use \PhpUnitTest\TestCase as TestCase;

/**
 * String to upper filter test
 *
 * @category    PHP
 * @package     MvcLite
 * @subpackage  Tests
 * @since       Class available since release 1.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */

class FilterStringToUpperTest extends TestCase
{
    /**
     *
     * method to test the StringToUpper filter's ability to filter a string
     *
     * @param string $unfiltered
     * @param string $expected
     *
     * @dataProvider provideFilter
     */
    public function testFilter($unfiltered, $expected)
    {
        $filter = new StringToUpper;
        $this->assertSame($expected, $filter->filter($unfiltered));
    }

    /**
     * provide data for testing the StringToUpper filter's ability to filter
     *
     * @return array An array of data to use for testing the filter.
     */
    public function provideFilter()
    {
        return [
            ['Word', 'WORD'],
            ['Lion', 'LION'],
            ['tIer', 'TIER'],
            ['The Dog', 'THE DOG'],
            ['123 SomethinG', '123 SOMETHING'],
            ['wow AWeSoME', 'WOW AWESOME'],
        ];
    }
}
