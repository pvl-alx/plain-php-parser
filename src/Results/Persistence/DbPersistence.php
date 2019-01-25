<?php

namespace Results\Persistence;

use PDO;
use Results\Decorators\DbPersistenceResponse;
use Results\ResultCollection;

/**
 * Class DbPersistence
 * @package Results\Persistence
 */
class DbPersistence implements IPersistence
{
    /**
     * @var PDO
     */
    private $db;

    /**
     * @var bool|\PDOStatement
     */
    private $preparedInsertQuery;

    /**
     * DbPersistence constructor.
     */
    public function __construct()
    {
        $dbName = getenv('MYSQL_DATABASE');
        $user = getenv('MYSQL_USER');
        $pass = getenv('MYSQL_ROOT_PASSWORD');
        $this->db = new PDO("mysql:host=172.20.0.2;dbname={$dbName}", $user, $pass);
        $this->preparedInsertQuery = $this->prepareInsertQuery();
    }

    /**
     * @param ResultCollection $results
     * @return mixed|void
     */
    public function persistBatch(ResultCollection $results)
    {
        foreach ($results as $result) {
            $preparedValue = new DbPersistenceResponse($result);
            $this->preparedInsertQuery->execute($preparedValue->render());
        }
    }

    /**
     * @param int $id
     * @return array
     */
    public function retrieve(): array
    {
        //TODO Db retrieve
    }

    /**
     * @return bool|\PDOStatement
     */
    private function prepareInsertQuery()
    {
        $describeQuery = $this->db->prepare("DESCRIBE results");
        $describeQuery->execute();
        $tableFields = $describeQuery->fetchAll(PDO::FETCH_COLUMN);
        unset($tableFields[0]);

        $args = array_fill(0, count($tableFields), '?');

        $implodeStr = implode(',', $args);
        $tableFields = implode(',', $tableFields);
        $preparedInsertQuery = "INSERT INTO `results`({$tableFields}) VALUES ({$implodeStr})";
        return $this->db->prepare($preparedInsertQuery);
    }
}
