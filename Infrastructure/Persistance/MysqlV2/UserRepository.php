<?php

namespace MovieChill\Infrastructure\Persistance\MysqlV2;

use MovieChill\app\Models\User;
use MovieChill\Domain\ModelV2\UserInterface;

class UserRepository extends AbstractRepository implements UserInterface
{

    public function getModel()
    {
        return User::class;
    }
}
