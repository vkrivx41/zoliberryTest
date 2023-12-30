<?php

namespace App\Attributes;

use Attribute;

// the target flag is a bitmask value (can be passed as int also)
// they determine the type of content the Attribute will target

#[Attribute(Attribute::TARGET_METHOD|Attribute::IS_REPEATABLE)]
class Get extends Route
{
    public function __construct(public string $path)
    {
        parent::__construct(strtolower($path), 'get');
    }
}