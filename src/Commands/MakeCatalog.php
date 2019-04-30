<?php

namespace GlobalCode\LaravelCatalog\Commands;

use Illuminate\Console\GeneratorCommand;

class MakeCatalog extends GeneratorCommand
{
//    protected $signature = 'make:catalog';
    protected $name = 'make:catalog';
    protected $description = 'Create a new catalog class';
    protected $type = 'Catalog model';

    protected function getStub()
    {
        return __DIR__ . 'stubs/category.stub';
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Models';
    }
}
