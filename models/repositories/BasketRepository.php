<?php


namespace app\models\repositories;


use app\models\entities\Basket;
use app\models\Repository;


class BasketRepository extends Repository
{
    public function getBasket($session) {
        $sql = "SELECT p.id id_prod, b.id id_basket, p.name, p.description, p.price 
                FROM basket2 b,products p 
                WHERE b.product_id=p.id 
                AND session_id = :session";
        return $this->db->queryAll($sql, ['session' => $session]);
    }

    public function getCount($session) {
        $sql = "SELECT count(*) as count FROM `basket` WHERE `session` = :session";
        return $this->db->queryOne($sql, ['session' => $session])['count'];
    }

    public function getEntityClass()
    {
        return Basket::class;
    }

    public function getTableName()
    {
        return 'basket2';
    }

}