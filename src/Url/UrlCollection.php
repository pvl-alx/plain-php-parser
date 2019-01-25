<?php

namespace Url;

use ArrayObject;

/**
 * Class UrlCollection
 * @package Collections
 */
class UrlCollection extends ArrayObject
{
    /**
     * @param Url $url
     */
    public function append($url) : void
    {
        if (! is_object($url)) {
            throw new \InvalidArgumentException('Appended var must be type of object. ' . gettype($url) . ' given');
        }

        if (! $url instanceof Url) {
            throw new \InvalidArgumentException('Appended object must be instance of ValueObjects\Url. ' . get_class($url) . ' given');
        }

        parent::append($url);
    }

    /**
     * @return UrlCollection
     */
    public function unique()
    {
        $uniqueArray = array_unique($this->getArrayCopy());

        return new self($uniqueArray);
    }

    /**
     * @return UrlCollection
     */
    public function filterEmpty()
    {
        $notEmptyArray = array_filter($this->getArrayCopy());

        return new self($notEmptyArray);
    }
}
