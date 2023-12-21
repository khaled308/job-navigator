<?php

namespace Framework;

class Database
{
    private $connection;
    private static $instance;

    private function __construct()
    {
        $dsn = 'mysql:host=' . Config::DB_HOST . ';port=' . Config::DB_PORT . ';dbname=' . Config::DB_NAME;
        $options = [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
        ];

        try {
            $this->connection = new \PDO($dsn, Config::DB_USER, Config::DB_PASSWORD, $options);
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            $instance = new Database();
        }

        return $instance;
    }

    public function query(string $sql, array $params = [])
    {
        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->execute($params);
            return $stmt;
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public function insert(string $table, array $data) {
        $fields = array_keys($data);
        $values = ":" . implode(",:", $fields);
        $fields = implode(",", $fields);

        $sql = "INSERT INTO $table ($fields) VALUES ($values)";
        self::getInstance()->query($sql, $data);
    }
}