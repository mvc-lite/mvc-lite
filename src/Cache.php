<?php
/**
 * Defines the caching mechanism
 *
 * @category    MvcLite
 * @package     Lib
 * @subpackage  Cache
 * @since       File available since release 2.0.0
 * @author      Cory Collier <corycollier@corycollier.com>
 */

namespace MvcLite;

use \MvcLite\Object\Singleton;
use MvcLite\Filter;

/**
 * Defines the caching mechanism
 *
 * @category    MvcLite
 * @package     Lib
 * @subpackage  Cache
 * @since       File available since release 2.0.0
 * @author      Cory Collier <corycollier@corycollier.com>
 */
class Cache extends Object\Singleton
{
    /**
     * property to store the configuration of the cache object
     *
     * @var array $config
     */
    protected $config;

    /**
     * initialize the cache instance
     *
     * @return Lib_Cache $this for object-chaining.
     */
    public function init(array $data = array())
    {
        $defaults = array('prefix' => 'cache');
        $this->config = array_merge($defaults, $data);
        return $this;

    }

    /**
     * stores data from an object.
     *
     * The object is required, to determine the namespacing of the storage
     *
     * @param \MvcLite\ObjectAbstract $object
     * @param string $name
     * @param unknown_type $data
     *
     * @return Lib_Cache $this for object-chaining.
     */
    public function set(ObjectAbstract $object, $name, $data)
    {
        $key = $this->getCacheKey($object, $name);
        $file = $this->getFilePath($key);
        file_put_contents($file, serialize($data));

        return $this;
    }

    /**
     * returns the relative filepath for a given filename
     *
     * @param string $filename
     * @return string
     */
    protected function getFilePath($filename)
    {
        return implode(DIRECTORY_SEPARATOR, array(
            $this->config['directory'],
            $filename,
        ));
    }

    /**
     * gets data for an object, and a value
     *
     * The object is required, to determine the namespacing of the storage
     *
     * @param \MvcLite\ObjectAbstract $object
     * @param string $name
     *
     * @return unknown_type
     */
    public function get(ObjectAbstract $object, $name)
    {
        $key  = $this->getCacheKey($object, $name);
        $file = $this->getFilePath($key);
        $data = unserialize(file_get_contents($file));

        return $data;

    }

    /**
     * Returns a string to namespace a cache entry.
     *
     * @param \MvcLite\ObjectAbstract $object
     * @param string $name
     *
     * @return string
     */
    protected function getCacheKey(ObjectAbstract $object, $name)
    {
        static $filter;

        if (! $filter) {
            $filter = new FilterChain;
            $filter->addFilter(new Filter\UnderscoreToDash);
            $filter->addFilter(new Filter\StringToLower);
        }

        return $filter->filter(implode('_', array(
            $this->config['prefix'],
            get_class($object),
            $name,
        )));

    }
}
