<?php

namespace GlobalCode\LaravelCatalog\Commands;

use GlobalCode\LaravelCatalog\Exceptions\UnrecognizedFileTypeException;
use GlobalCode\LaravelCatalog\Models\Category;
use GlobalCode\LaravelCatalog\Readers\CatData;
use GlobalCode\LaravelCatalog\Readers\JsonReader;
use GlobalCode\LaravelCatalog\Readers\Reader;
use Illuminate\Console\Command;

class Import extends Command
{
    protected $signature = 'catalog:import ' .
        '{model : Category model} ' .
        '{file : Data file (currently only JSON is supported)}';

    protected $description = 'Import catalog data to DB';

    /**
     * @var JsonReader
     */
    private $reader;

    /**
     * @var string
     */
    private $modelClass;

    private function createCategory(CatData $catData, Category $parent = null)
    {
        /* @var Category $category */
        $category = call_user_func(
            [$this->modelClass, 'import'],
            [
                $this->reader,
                $catData,
                $parent,
            ]
        );
        $category->save();
        foreach ($catData->children() as $catDataChild) {
            $this->createCategory($catDataChild, $category);
        }
    }

    /**
     * @throws UnrecognizedFileTypeException
     */
    public function handle()
    {
        $this->reader = Reader::create($this->argument('file'));
        $this->modelClass = $this->argument('model');
        foreach ($this->reader->getData() as $catData) {
            $this->createCategory($catData);
        }
    }
}
