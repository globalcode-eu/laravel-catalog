<?php

namespace GlobalCode\LaravelCatalog\Readers;

class JsonReader extends Reader
{
    protected function readData(string $file): array
    {
        return json_decode(file_get_contents($file), true);
    }
}
