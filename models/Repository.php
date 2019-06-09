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

    public function getOneObj($id) {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = :id";
        return $this->db->queryObject($sql, ['id' => $id], $this->getEntityClass());
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

    public function getOneWhere($field, $value) {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE `$field`=:$field";

        return $this->db->queryObject($sql, ["$field"=>$value], $this->getEntityClass());
    }

    public function getLimit($from, $limit) {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} LIMIT :from, :limit";
        return $this->db->queryAll($sql, [':from' => $from, ':limit' => $limit]);
    }

    protected function insert(DataEntity $entity) {

        $tableName = $this->getTableName();

        $params = [];
        $columns = [];

        foreach ($entity->getProperties() as $key => $value) {

            if ($key == "db" || $key == "id" || $key == "properties") continue;
            $columns[] = "`$key`";
            $params[":{$key}"] = $value;
        }

        $columns = implode(", ", $columns);
        $value = implode(", ", array_keys($params));

        $sql = "INSERT INTO {$tableName} ({$columns}) VALUES ({$value})";

        $this->db->exec($sql, $params);

        $this->id = $this->db->lastInsertId();
    }

    public function delete(DataEntity $entity) {

        $tableName = $this->getTableName();
        $sql = "DELETE FROM {$tableName} WHERE id = :id";

        $this->db->exec($sql, [":id" => $entity->id]);
    }

    protected function update(DataEntity $entity) {

        $tableName = $this->getTableName();
        $flags = $entity->getFlags();

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