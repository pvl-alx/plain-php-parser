<?php

namespace Results\Repositories;

use Results\Persistence\IPersistence;
use Results\ResultCollection;

/**
 * Class ResultRepository
 * @package Results\Repositories
 */
class ResultRepository
{
    /**
     * @var IPersistence
     */
    private $persistence;

    /**
     * ResultRepository constructor.
     * @param IPersistence $persistence
     */
    public function __construct(IPersistence $persistence)
    {
        $this->persistence = $persistence;
    }

    /**
     * @return mixed
     */
    public function findBatch()
    {
        return $this->persistence->retrieve();
    }

    /**
     * @param ResultCollection $results
     */
    public function saveBatch(ResultCollection $results)
    {
        $this->persistence->persistBatch($results);
    }
}