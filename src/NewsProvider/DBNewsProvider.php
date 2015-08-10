<?php

namespace NewsProvider;

use Components\Constants;
use Exceptions\CanNotDeleteDataException;
use Exceptions\IncorrectInputDataException;

//todo implement try catch blocks for PDOException
class DBNewsProvider implements NewsProviderInterface
{
    protected $connection;

    public function __construct($dbConfig)
    {
        $dsn = 'mysql:dbname=' . $dbConfig['db_name'] . ';host=' . $dbConfig['host'];
        $this->connection = new \PDO($dsn, $dbConfig['user'], $dbConfig['password']);
    }

    public function get($id)
    {
        $sql = 'SELECT * FROM news WHERE id = :id';
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function getFirstBatch()
    {
        $sql = 'SELECT * FROM news
                JOIN (SELECT id FROM news ORDER BY id DESC LIMIT ' . Constants::NEWS_CHUNK_LENGTH. ')
                as lim USING(id)';
        return $this->connection->query($sql)->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getNextBatch($id)
    {
        $sql = 'SELECT * FROM news
                JOIN (SELECT id FROM news WHERE id < :id
                ORDER BY id DESC LIMIT ' . Constants::NEWS_CHUNK_LENGTH. ')
                as lim USING(id)';
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function add($title, $text)
    {
        $createSql = "INSERT INTO news (title, text, created_at, updated_at)
          VALUES (:title, :text, now(), now())";
        $createStmt = $this->connection->prepare($createSql);
        $result =  $createStmt->execute([
            ':title' => $title,
            ':text' => $text
        ]);
        return $result ? $this->connection->lastInsertId() : false;
    }

    public function edit($id, $title, $text)
    {
        $sql = 'SELECT * FROM news WHERE id = :id';
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([
            ':id' => $id
        ]);
        if (!$row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            throw new IncorrectInputDataException();
        }
        $updateSql = "UPDATE news SET title = :title, text = :text, updated_at = now()
                        WHERE id = :id";
        $updateStmt = $this->connection->prepare($updateSql);
        return $updateStmt->execute([
            ':id' => $id,
            ':title' => $title,
            ':text' => $text
        ]);
    }

    /**
     * @param $id
     * @return mixed
     * @throws CanNotDeleteDataException
     */
    public function delete($id)
    {
        $sql = 'DELETE FROM news WHERE id = :id';
        $stmt = $this->connection->prepare($sql);
        return $stmt->execute([
            ':id' => $id
        ]);
    }
}