<?php

namespace MyProject\Models\User;

use MyProject\Models\ActiveRecordEntity\ActiveRecordEntity;
use MyProject\Models\Numbers\Numbers;
use MyProject\Exceptions\InvalidArgumentException;


class User extends ActiveRecordEntity
{
    /** @var string */
    protected $date;

    /** @var string */
    protected $nickname;

    /** @var string */
    protected $passwordHash;

    /** @var string */
    protected $authToken;


    public function getNickname()
    {
        return $this->nickname;
    }

    public function refreshAuthToken()
    {
        $this->authToken = sha1(random_bytes(100)) . sha1(random_bytes(100));
    }

    protected static function getTableName(): string
    {
        return 'user';
    }

    public function getPasswordHash(): string
    {
        return $this->passwordHash;
    }

    public function getAuthToken()
    {
        return $this->authToken;
    }

    public static function signUp(array $userData)
    {
        if (empty($userData['login'])) {
            throw new InvalidArgumentException('Не передан login');
        }

        if (!preg_match('/[a-zA-Z0-9]+/', $userData['login'])) {
            throw new InvalidArgumentException('Login может состоять только из символов латинского алфавита и цифр');
        }

        if (empty($userData['password'])) {
            throw new InvalidArgumentException('Не передан password');
        }

        if (mb_strlen($userData['password']) < 8) {
            throw new InvalidArgumentException('Пароль должен быть не менее 8 символов');
        }
        if (static::findOneByColumn('nickname', $userData['login']) !== null) {
            throw new InvalidArgumentException('Пользователь с таким nickname уже существует');
        }
        if (self::timeDifference($userData['date']) > 150) {
            throw new InvalidArgumentException('Too Old');
        }
        if (self::timeDifference($userData['date']) < 5) {
            throw new InvalidArgumentException('Too young');
        }


        $user = new User();
        $user->nickname = $userData['login'];
        $user->date = $userData['date'];
        $user->passwordHash = password_hash($userData['password'], PASSWORD_DEFAULT);
        $user->authToken = sha1(random_bytes(100)) . sha1(random_bytes(100));
        $user->save();
        $numbers = new Numbers();
        $numbers->setUsersId($user->getId());
        $numbers->save();
        return $user;
    }

    public static function timeDifference($date)
    {
        $dateTime = new \DateTime();
        $now = new \DateTime($date);
        $interval = $dateTime->diff($now);
        return $interval->y;
    }

    public static function login(array $loginData): User
    {
        if (empty($loginData['login'])) {
            throw new InvalidArgumentException('Не передан login');
        }

        if (empty($loginData['password'])) {
            throw new InvalidArgumentException('Не передан password');
        }

        $user = User::findOneByColumn('nickname', $loginData['login']);
        if ($user === null) {
            throw new InvalidArgumentException('Нет пользователя с таким email');
        }

        if (!password_verify($loginData['password'], $user->getPasswordHash())) {
            throw new InvalidArgumentException('Неправильный пароль');
        }

        $user->refreshAuthToken();
        $user->save();
        return $user;
    }


}
