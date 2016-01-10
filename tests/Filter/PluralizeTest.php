<?php
/**
 * Pluralize filter test
 *
 * @category    PHP
 * @package     MvcLite
 * @subpackage  Tests
 * @since       File available since release 1.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */

namespace MvcLite;

use MvcLite\Filter;
use MvcLite\Filter\Pluralize as Pluralize;
use \PhpUnitTest\TestCase as TestCase;

/**
 * Pluralize filter test
 *
 * @category    PHP
 * @package     MvcLite
 * @subpackage  Tests
 * @since       Class available since release 1.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */

class FilterPluralizeTest extends TestCase
{
    /**
     *
     * method to test the Pluralize filter's ability to filter a string
     *
     * @param string $unfiltered
     * @param string $expected
     *
     * @dataProvider provideFilter
     */
    public function testFilter($unfiltered, $expected)
    {
        $filter = new Pluralize;
        $this->assertSame($expected, $filter->filter($unfiltered));
    }

    /**
     * provide data for testing the Pluralize filter's ability to filter
     *
     * @return array An array of data to use for testing the filter.
     */
    public function provideFilter()
    {
        return [
            ['word', 'words'],
            ['lion', 'lions'],
            ['tiger', 'tigers'],
            ['dog', 'dogs'],
            ['horse', 'horses'],
            ['baby', 'babies'],
            ['story', 'stories'],
        ];
    }
}
