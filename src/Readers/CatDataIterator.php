<?php

namespace GlobalCode\LaravelCatalog\Readers;

use Iterator;

class CatDataIterator implements Iterator
{
    /**
     * @var Reader
     */
    public $reader;

    /**
     * @var array
     */
    private $data;

    /**
     * @var CatData
     */
    public $parent;

    public function __construct(Reader $reader, array $data, CatData $parent = null)
    {
        $this->reader = $reader;
        $this->data = $data;
        $this->parent = $parent;
    }

    public function current()
    {
        return new CatData($this->reader, current($this->data), $this->parent);
    }

    public function next()
    {
        next($this->data);
    }

    public function key()
    {
        return key($this->data);
    }

    public function valid()
    {
        return isset($this->data[$this->key()]);
    }

    public function rewind()
    {
        reset($this->data);
    }
}
