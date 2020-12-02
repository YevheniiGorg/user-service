<?php

namespace Test\user;

/**
 * model for working with user roles
 */
class Role
{
    const ADMIN = 1;
    const MODERATOR = 2;
    const USER = 3;

    /**
     * @return array statuses list
     */
    public static function statuses()
    {
        return [
            self::ADMIN => 'admin',
            self::MODERATOR => 'moderator',
            self::USER => 'user',
        ];
    }

}