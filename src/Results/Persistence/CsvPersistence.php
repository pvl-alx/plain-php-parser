<?php

namespace Results\Persistence;

use LogicException;
use Results\Decorators\CsvPersistenceResponse;
use Results\ResultCollection;
use SplFileObject;
use Url\Url;

/**
 * Class CsvPersistence
 * @package Results\Persistence
 */
class CsvPersistence implements IPersistence
{
    /**
     *
     */
    private const CSV_HEADERS = ['source', 'target', 'result'];

    /**
     *
     */
    const FILE_FORMAT = '.csv';

    /**
     *
     */
    const BASE_DIR = 'uploads/';

    /**
     * @var Url
     */
    private $source;

    /**
     * @var string
     */
    private $fileName;

    /**
     * CsvPersistence constructor.
     * @param Url $source
     * @throws \Exception
     */
    public function __construct(Url $source)
    {
        $this->source = $source;

        $fileName = $this->source->getHost() . self::FILE_FORMAT;
        $this->fileName = self::BASE_DIR . $fileName;
    }

    /**
     * @return array|void
     */
    public function retrieve()
    {
        $fileName = $this->source->getHost() . self::FILE_FORMAT;
        $localFilePath = self::BASE_DIR . $fileName;

        if (! file_exists($localFilePath)) {
            throw new LogicException('Can not find the file of results');
        }

        echo $localFilePath;
    }

    /**
     * @param ResultCollection $results
     * @return void
     */
    public function persistBatch(ResultCollection $results)
    {
        if (! is_dir(self::BASE_DIR)) {
            mkdir(self::BASE_DIR, 0777, true);
        }

        if (! file_exists($this->fileName)) {
            $file = new SplFileObject($this->fileName, 'w');

            $file->fputcsv(self::CSV_HEADERS);
            foreach ($results as $result) {
                $preparedValue = new CsvPersistenceResponse($result);
                $file->fputcsv($preparedValue->render());
            }
        }
    }
}
