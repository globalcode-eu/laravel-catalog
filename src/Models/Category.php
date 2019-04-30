<?php

namespace GlobalCode\LaravelCatalog\Models;

use GlobalCode\LaravelCatalog\Readers\CatData;
use GlobalCode\LaravelCatalog\Readers\Reader;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

abstract class Category extends Model
{
    public abstract function children(): HasMany;
    public abstract function parent(): HasOne;
    public abstract static function root(): Builder;
    public abstract static function import(Reader $reader, CatData $catData, Category $parent = null): Category;
}
