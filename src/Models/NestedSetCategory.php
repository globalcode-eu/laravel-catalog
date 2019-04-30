<?php

namespace GlobalCode\LaravelCatalog\Models;

use GlobalCode\LaravelCatalog\Readers\CatData;
use GlobalCode\LaravelCatalog\Readers\Reader;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class NestedSetCategory extends Category
{
    public function children(): HasMany
    {
        // TODO: Implement children() method.
    }

    public function parent(): HasOne
    {
        // TODO: Implement parent() method.
    }

    public static function root(): Builder
    {
        // TODO: Implement root() method.
    }

    public static function import(Reader $reader, CatData $catData, Category $parent = null): Category
    {
        // TODO: Implement import() method.
    }
}
