<?php

namespace Results\Persistence;

use Results\ResultCollection;

/**
 * Interface IPersistence
 * @package Results\Persistence
 */
interface IPersistence
{
    /**
     * @param ResultCollection $data
     * @return mixed
     */
    public function persistBatch(ResultCollection $data);

    /**
     * @return mixed
     */
    public function retrieve();
}
