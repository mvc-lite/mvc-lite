<?php
/**
 * Class to test the MvcLite\Traits\Filepath trait
 *
 * @category    PHP
 * @package     MvcLite
 * @subpackage  Tests
 * @since       File available since release 3.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */

namespace MvcLite;

use MvcLite\Traits\Filepath as FilepathTrait;
use \PhpUnitTest\TestCase as TestCase;

/**
 * Class to test the MvcLite\Traits\Filepath trait
 *
 * @category    PHP
 * @package     MvcLite
 * @subpackage  Tests
 * @since       File available since release 3.1.0
 * @author      Cory Collier <corycollier@corycollier.com>
 */
class FilepathTraitsTest extends TestCase
{
    /**
     * Tests the getConfig method of the trait
     *
     * @dataProvider provideGetConfig
     */
    public function testGetConfig($expected, $input)
    {
        $sut = new TestFixtureFilepathTrait;
        $result = $sut->filepath($input);
        $this->assertEquals($expected, $result);
    }

    public function provideGetConfig()
    {
        return [
            'string input' => [
                'expected' => 'the/path/to/the/file',
                'input' => 'the/path/to/the/file',
            ],

            'array input' => [
                'expected' => 'the/path/to/the/file',
                'input' => ['the', 'path', 'to', 'the', 'file'],
            ]
        ];
    }
}

// @codingStandardsIgnoreStart
// testing classes
class TestFixtureFilepathTrait
{
    use FilepathTrait;
}
// @codingStandardsIgnoreEnd
