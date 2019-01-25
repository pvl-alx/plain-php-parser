<?php

namespace Results\Decorators;

use Results\Result;

/**
 * Class CsvPersistenceResponse
 * @package Results\Decorators
 */
class CsvPersistenceResponse implements IRenderable
{
    /**
     * @var Result
     */
    private $result;

    /**
     * CsvPersistenceResponse constructor.
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