<?php

namespace Results\Decorators;

use Results\Result;

/**
 * Class DbPersistenceResponse
 * @package Results\Decorators
 */
class DbPersistenceResponse implements IRenderable
{
    /**
     * @var Result
     */
    private $result;

    /**
     * DbPersistenceResponse constructor.
     * @param Result $result
     */
    public function __construct(Result $result)
    {
        $this->result = $result;
    }

    /**
     * @return array
     */
    public function render()
    {
        return [
            $this->result->getSource()->getUrl(),
            $this->result->getTarget()->getAlias(),
            $this->result->getTarget()->getTargetValue(),
        ];
    }
}