<?php

namespace app\models;
use app\interfaces\IModel;
use app\engine\Db;
use \DateTime;


abstract class DbModel extends Model implements IModel
{
    protected $db;

    public function __construct()
    {
        $this->db = Db::getInstance();
    }

    public static function getOne($id) {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = :id";
        return Db::getInstance()->queryObject($sql, ['id' => $id], static::class);
    }

    public static function getAll() {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName}";
        return Db::getInstance()->queryAll($sql);
    }

    public function getLimit($from, $limit) {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName} LIMIT :from, :limit";
        return Db::getInstance()->queryAll($sql, [':from' => $from, ':limit' => $limit]);
    }

    protected function insert() {

        $tableName = static::getTableName();

        $queryParams = [];
        $queryColumns = [];

        foreach ($this as $key => $val) {

            if (is_null($val)) {
                continue;
            } elseif ($key == "db" || $key == "flags") {
                continue;
            } else {
                $queryParams[":{$key}"] = $val;
                $queryColumns[] = "`$key`";
            }
        }

        $queryColumns = implode(", ", $queryColumns);
        $queryValues = implode(", ", array_keys($queryParams));

        $sql = "INSERT INTO `{$tableName}` `({$queryColumns})` VALUES ({$queryValues})";

        Db::getInstance()->exec($sql, $queryParams);

        $this->id = Db::getInstance()->lastInsertId();
    }

    public function delete() {
        $tableName = static::getTableName();
        $sql = "DELETE FROM {$tableName} WHERE id = :id";

        Db::getInstance()->exec($sql, ["id" => $this->id]);
    }

    protected function update() {

        $tableName = static::getTableName();
        $flags = $this->getFlags();

        $date = new DateTime();
        $date = $date->format('Y-m-d H:i:s');

        $queryParams = [];
        $querySet = [];

        foreach ($flags as $key => $val) {

            if ($val) {
                $queryParams[":{$key}"] = $this->$key;
                $querySet[] = "`$key` = :{$key}";
            }
        }

        $queryParams[':dateChange'] = $date;
        $querySet[] = "`dateChange` = :dateChange";

        $querySet = implode(", ", $querySet);

        $sql = "UPDATE `{$tableName}` SET {$querySet} WHERE id = :id";

        $queryParams[':id'] = $this->id;

        Db::getInstance()->exec($sql, $queryParams);
    }

    public function save()
    {

        if (is_null($this->id)) {
            $this->insert();
        } else {
            $this->update();
        }

    }

    public function __set($field, $value)
    {
        $this->$field = $value;
        $this->flags["{$field}"] = true;
    }

    public function getFlags()
    {
        return $this->flags; //TODO придумать проверку на наличие св-ва
    }

    public function __get($name)
    {
        return $this->$name;
    }

    abstract public static function getTableName();
    abstract public function getProps();

}