<?php
/**
 * Class to test the MvcLite\Traits\Config trait
 *
 * @category    PHP
 * @package     MvcLite
 * @subpackage  Tests
 * @since       File available since release 3.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */

namespace MvcLite;

use MvcLite\Traits\Config as ConfigTrait;
use \PhpUnitTest\TestCase as TestCase;

/**
 * Class to test the MvcLite\Traits\Config trait
 *
 * @category    PHP
 * @package     MvcLite
 * @subpackage  Tests
 * @since       File available since release 3.1.0
 * @author      Cory Collier <corycollier@corycollier.com>
 */
class ConfigTraitsTest extends TestCase
{
    /**
     * Tests the getConfig method of the trait
     */
    public function testGetConfig()
    {
        $sut = new TestFixtureConfigTrait;
        $result = $sut->getConfig();
        $this->assertInstanceOf('\MvcLite\Config', $result);
    }
}

// @codingStandardsIgnoreStart
// testing classes
class TestFixtureConfigTrait
{
    use ConfigTrait;
}
// @codingStandardsIgnoreEnd
