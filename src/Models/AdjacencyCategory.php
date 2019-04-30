<?php

namespace GlobalCode\LaravelCatalog\Models;

use GlobalCode\LaravelCatalog\Readers\CatData;
use GlobalCode\LaravelCatalog\Readers\Reader;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int $id
 * @property int $parent
 * @property string $name
 */
class AdjacencyCategory extends Category
{
    public function children(): HasMany
    {
        return $this->hasMany(
            static::class,
            'parent_id',
            'id'
        );
    }

    public function parent(): HasOne
    {
        return $this->hasOne(
            static::class,
            'id',
            'parentId'
        );
    }

    public static function root(): Builder
    {
        return static::query()
            ->whereNull('parentId');
    }

    public static function import(Reader $reader, CatData $catData, Category $parent = null): Category
    {
        $category = new static();
        $category->id = $catData->getNumericId();
        $category->name = $catData->getName();
        $category->saveOrFail();
        return $category;
    }
}
