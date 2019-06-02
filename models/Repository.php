<?php


namespace app\models;


use app\engine\Db;
use app\models\entities\DataEntity;
use \DateTime;


abstract class Repository
{

    protected $db;

    public function __construct()
    {
        $this->db = Db::getInstance();
    }

    public function getOne($id) {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = :id";
        return $this->db->queryOne($sql, ['id' => $id]);
    }

    public function getAll() {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName}";
        return $this->db->queryAll($sql);
    }

    public function getCountWhere($field, $value) {
        $tableName = $this->getTableName();
        $sql = "SELECT count(*) as count FROM {$tableName} WHERE `$field` = :$field";
        return $this->db->queryOne($sql, ["$field" => $value])['count'];
    }

    public function getLimit($from, $limit) {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} LIMIT :from, :limit";
        return $this->db->queryAll($sql, [':from' => $from, ':limit' => $limit]);
    }

    protected function insert(DataEntity $entity) {

        $tableName = $this->getTableName();

        $queryParams = [];
        $queryColumns = [];

        foreach ($entity as $key => $val) {

            if (is_null($val)) {
                continue;
            } elseif ($key == "db" || $key == "id" || $key == "properties") {
                continue;
            } else {
                $queryParams[":{$key}"] = $val;
                $queryColumns[] = "`$key`";
            }
        }

        $queryColumns = implode(", ", $queryColumns);
        $queryValues = implode(", ", array_keys($queryParams));

        $sql = "INSERT INTO `{$tableName}` `({$queryColumns})` VALUES ({$queryValues})";

        $this->db->exec($sql, $queryParams);

        $this->id = $this->db->lastInsertId();
    }

    public function delete(DataEntity $entity) {

        $tableName = $this->getTableName();
        $sql = "DELETE FROM {$tableName} WHERE id = :id";

        $this->db->exec($sql, [":id" => $entity->id]);
    }

    protected function update(DataEntity $entity) {

        $tableName = $this->getTableName();
        $flags = $this->getFlags();

        $date = new DateTime();
        $date = $date->format('Y-m-d H:i:s');

        $queryParams = [];
        $querySet = [];

        foreach ($entity as $key => $val) {

            if ($key == 'id' || $key == 'flags') continue;
            if ($entity->flags[$key] == false) continue;
            $entity->flags[$key] = false;
            $queryParams[":{$key}"] = $this->$key;
            $querySet[] = "`$key` = :{$key}";

        }

        $queryParams[':dateChange'] = $date;
        $querySet[] = "`dateChange` = :dateChange";

        $querySet = implode(", ", $querySet);

        $sql = "UPDATE `{$tableName}` SET {$querySet} WHERE id = :id";

        $queryParams[':id'] = $this->id;

        $this->db->exec($sql, $queryParams);
    }

    public function save(DataEntity $entity)
    {

        if (is_null($entity->id))
            $this->insert($entity);
        else
            $this->update($entity);

    }

    abstract public function getTableName();
}