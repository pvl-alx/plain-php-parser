<?php

namespace Results;

use Targets\ITargetable;
use Url\Url;

/**
 * Class Result
 * @package Results
 */
class Result
{

    /**
     * @var Url
     */
    private $source;

    /**
     * @var ITargetable
     */
    private $target;

    /**
     * @param Url $source
     * @param ITargetable $target
     * @return Result
     */
    public static function draft(Url $source, ITargetable $target) : Result
    {
        return new self(
            $source,
            $target
        );
    }

    /**
     * @param array $state
     * @return Result
     */
    public static function fromState(array $state) : Result
    {
        return new self(
            Url::fromString($state['source']),
            $state['target']
        );
    }

    /**
     * Result constructor.
     * @param Url $source
     * @param ITargetable $target
     */
    private function __construct(Url $source, ITargetable $target)
    {
        $this->source = $source;
        $this->target = $target;
    }

    /**
     * @return ITargetable
     */
    public function getTarget(): ITargetable
    {
        return $this->target;
    }

    /**
     * @return Url
     */
    public function getSource(): Url
    {
        return $this->source;
    }
}