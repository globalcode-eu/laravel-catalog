<?php

namespace GlobalCode\LaravelCatalog\Readers;

use GlobalCode\LaravelCatalog\Exceptions\UnrecognizedFileTypeException;

/**
 * Class to read categories data from file.
 */
abstract class Reader
{
    /**
     * @var array
     */
    private $data;

    /**
     * Load categories data from file.
     * @param string $file
     * @return array
     */
    protected abstract function readData(string $file): array;

    public function __construct(string $file)
    {
        $this->data = $this->readData($file);
    }

    /**
     * Determines the type of file and creates a corresponding reader.
     * @param string $file
     * @return Reader
     * @throws UnrecognizedFileTypeException
     */
    public static function create(string $file): Reader
    {
        $ext = pathinfo($file, PATHINFO_EXTENSION);
        if ($ext == 'json') {
            return new JsonReader($file);
        }
        throw new UnrecognizedFileTypeException();
    }

    public function getData(): CatDataIterator
    {
        return new CatDataIterator($this, $this->data['categories']);
    }
}
