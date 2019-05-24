<?php


namespace app\models;


class Categories extends DbModel
{
    protected $id;
    protected $name;
    protected $parentId;

    protected $flags = [
        'id' => false,
        'name' => false,
        'parentId' => false,
    ];

    public function __construct($name, $parentId)
    {
        parent::__construct();
        $this->name = $name;
        $this->parentId = $parentId;
    }

    public static function getTableName()
    {
        return 'categories';
    }

    public function getProps()
    {
        return $arrProps = [
            "id" => $this->id,
            "name" => $this->name,
            'parentId' => $this->parentId,
        ];
    }
}