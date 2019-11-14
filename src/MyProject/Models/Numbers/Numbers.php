<?php

namespace MyProject\Models\Numbers;

use MyProject\Models\ActiveRecordEntity\ActiveRecordEntity;
use MyProject\Services\Db\Db;


class Numbers extends ActiveRecordEntity
{
    /** @var int */
    protected $usersId;
    /** @var int */
    protected $number = 0;

    protected static function getTableName(): string
    {
        return 'numbers';
    }

    public function getNumber()
    {
        return $this->number;
    }

    public function setUsersId($usersId)
    {
        $this->usersId = $usersId;
    }

    public function plusOneNumber()
    {
        $this->number++;
    }

    public static function getUserId(int $id): self
    {
        $db = Db::getInstance();
        $entities = $db->query(
            'SELECT * FROM `' . static::getTableName() . '` WHERE users_id=:id;',
            [':id' => $id],
            static::class
        );
        return $entities ? $entities[0] : null;
    }
}