<?php
/**
 * Test class to test the Lib_File class
 * 
 * @category    MVCLite
 * @package     Tests
 * @subpackage  File
 * @since       File available since release 2.0.1
 * @author      Cory Collier <corycollier@corycollier.com>
 */
/**
 * Test class to test the Lib_File class
 * 
 * @category    MVCLite
 * @package     Tests
 * @subpackage  File
 * @since       File available since release 2.0.1
 * @author      Cory Collier <corycollier@corycollier.com>
 */
 
class Tests_Lib_FileTest
extends PHPUnit_Framework_TestCase
{
    /**
     * Local implementation of the setup hook
     */
    public function setUp ( )
    {
        $this->fixture = new Lib_File;
        
    } // END function setUp

    /**
     * test the file class's ability to check if a file exists
     *
     * @param string $filename
     * @dataProvider provide_test
     */
    public function test_test ($filename, $expected = false)
    {
        $this->assertSame($this->fixture->test($filename), $expected);
        
    } // END function test_test

    /**
     * provides data to use for testing the file class's ability to test a given
     * file existance
     *
     * @return array
     */
    public function provide_test ( )
    {
        return array(
            array(implode(DIRECTORY_SEPARATOR, array(
                ROOT, 'lib', 'file.php'
            )), true),

            array(implode(DIRECTORY_SEPARATOR, array(
                ROOT, 'tests', 'lib', 'FileTest.php'
            )), true),

            array(implode(DIRECTORY_SEPARATOR, array(
                ROOT, 'bad-folder', 'file.php'
            )), false),
        );
        
    } // END function provide_test

    /**
     * tests the file class's abilty to load a file
     *
     * @param string $filename
     * @param boolean $shouldExist
     * @dataProvider provide_load
     */
    public function test_load ($filename, $shouldExist = false)
    {
        if (! $shouldExist) {
            $this->setExpectedException('Lib_Exception');
        }

        $this->fixture->load($filename);

        $property = new ReflectionProperty('Lib_File', '_contents');
        $property->setAccessible(true);
        $result = $property->getValue($this->fixture);

        $this->assertEquals(file_get_contents($filename), $result);
        
    } // END function test_load

    /**
     * provides data to use for testing the file class's ability to load files
     *
     * @return array
     */
    public function provide_load ( )
    {
        return array(
            array(implode(DIRECTORY_SEPARATOR, array(
                ROOT, 'lib', 'file.php'
            )), true),

            array(implode(DIRECTORY_SEPARATOR, array(
                ROOT, 'tests', 'lib', 'FileTest.php'
            )), true),

            array(implode(DIRECTORY_SEPARATOR, array(
                ROOT, 'bad-folder', 'file.php'
            )), false),
        );
        
    } // END function provide_load

    /**
     * tests the file class's ability to return it's _contents property
     *
     * @param string $contents
     * @dataProvider provide_getContents 
     */
    public function test_getContents ($contents)
    {
        $property = new ReflectionProperty('Lib_File', '_contents');
        $property->setAccessible(true);
        $property->setValue($this->fixture, $contents);

        $this->assertSame($contents, $this->fixture->getContents());
        
    } // END function test_getContents

    /**
     * provides data to test the file class's ability to return it's _contents
     * property
     *
     * @return array
     */
    public function provide_getContents ( )
    {
        return array(
            array('test1'),
            array(" "),
        );
        
    } // END function provide_getContents

} // END class Tests_Lib_FileTest