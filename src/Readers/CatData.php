<?php

namespace GlobalCode\LaravelCatalog\Readers;

use Exception;

/**
 * Class CatData
 * @package GlobalCode\LaravelCatalog\Readers
 */
class CatData
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

    public function getId()
    {
        return $this->data['id'];
    }

    public function getNumericId(): int
    {
        return $this->data['id']
            ?? crc32(implode('|', $this->getBreadcrumbs()));
    }

    public function getName(): string
    {
        return $this->data['name'];
    }

    public function getBreadcrumbs(): array
    {
        $breadcrumbs = $this->parent
            ? $this->parent->getBreadcrumbs()
            : [];
        $breadcrumbs[] = $this->getName();
        return $breadcrumbs;
    }

    /**
     * @param $name
     * @return mixed
     * @throws Exception
     */
    public function __get($name)
    {
        if (!isset($this->data[$name])) {
            throw new Exception('Property ' . $name . ' not defined!');
        }
        return $this->data[$name];
    }

    public function children(): ?CatDataIterator
    {
        return isset($this->data['children']) && is_array($this->data['children'])
            ? new CatDataIterator($this->reader, $this->data['children'], $this)
            : null;
    }
}
