<?php

namespace NewsProvider;

use Components\Constants;

class DBNewsProvider implements NewsProviderInterface
{
    protected $connection;

    public function __construct($dbConfig)
    {
        $dsn = 'mysql:dbname=' . $dbConfig['db_name'] . ';host=' . $dbConfig['host'];
        $this->connection = new \PDO($dsn, $dbConfig['user'], $dbConfig['password']);
    }

    public function getFirstBunch()
    {
        $sql = 'SELECT * FROM news
                JOIN (SELECT id FROM news ORDER BY id DESC LIMIT ' . Constants::NEWS_CHUNK_LENGTH. ')
                as lim USING(id)';
        return $this->connection->query($sql)->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getNextBunch($id)
    {
        $sql = 'SELECT * FROM news
                JOIN (SELECT id FROM news WHERE id < :id
                ORDER BY id DESC LIMIT ' . Constants::NEWS_CHUNK_LENGTH. ')
                as lim USING(id)';
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function add()
    {
        // TODO: Implement add() method.
    }

    public function edit()
    {
        // TODO: Implement edit() method.
    }

    public function delete()
    {
        // TODO: Implement delete() method.
    }
}