<?php

namespace Results;

use ArrayObject;

/**
 * Class ResultCollection
 * @package Results
 */
class ResultCollection extends ArrayObject
{
    /**
     * @param Result $result
     */
    public function append($result)
    {
        if (! is_object($result)) {
            throw new \InvalidArgumentException('Appended var must be type of object. ' . gettype($result) . ' given');
        }

        if (! $result instanceof Result) {
            throw new \InvalidArgumentException('Appended object must be instance of ValueObjects\Url. ' . get_class($result) . ' given');
        }

        parent::append($result);
    }
}
