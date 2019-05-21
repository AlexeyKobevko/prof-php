<?php

namespace app\models;
use app\interfaces\IModel;
use app\engine\Db;


abstract class Model implements IModel
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

    public function insert() {
        $arr = json_decode(json_encode($this), true);
//        $str = '';
//        foreach ($arr as $key=>$val) {
//            if (is_null($val)) {
//                continue;
//            } elseif (is_string($val)) {
//                $str .= '"' . $val . '", ';
//            } else {
//                $str .= $val . ', ';
//            }
//        }
//        $str = rtrim($str,', ');
        $tableName = $this->getTableName();
        $sql = "INSERT INTO {$tableName} VALUES (name = :name, description = :description, price = :price, categoryId = :categoryId)";
        $this->db->exec($sql, $arr);
    }

    public function delete() {

    }

    public function update() {

    }

    abstract public function getTableName();
}