<?php

namespace app\engine;

use app\traits\Tsinglton;
use \PDO;

class Db
{
    use Tsinglton;

    private $config = [
        'driver' => 'mysql',
        'host' => 'localhost:3307',
        'login' => 'root',
        'password' => '',
        'database' => 'php-prof',
        'charset' => 'utf8'
    ];

    private $opt = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ];

    private $connection = null;

    private function getConnection() {
        if (is_null($this->connection)) {
            $this->connection = new PDO($this->prepareDsnString(),
                $this->config['login'],
                $this->config['password'],
                $this->opt
            );
        }

        return $this->connection;
    }

    private function prepareDsnString() {
        return sprintf("%s:host=%s;dbname=%s;charset=%s",
            $this->config['driver'],
            $this->config['host'],
            $this->config['database'],
            $this->config['charset']
        );
    }

    private function query ($sql, $params) {
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }

    public function queryObject($sql, $params, $class) {
        $stmt = $this->query($sql, $params);
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $class);
        return $stmt->fetch();
    }

    public function queryOne($sql, $params) {
        return $this->query($sql, $params)->fetchAll()[0];
    }

    public function queryAll($sql, $params = []) {
        return $this->query($sql, $params)->fetchAll();
    }

    public function exec($sql, $params) {
        $this->query($sql, $params);
        return true;
    }

    public function lastInsertId() {
        return $this->connection->lastInsertId();
    }

}