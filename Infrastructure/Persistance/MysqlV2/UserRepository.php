<?php

namespace Ducnm\Infrastructure\Persistance\MysqlV2;

use Ducnm\app\Models\User;
use Ducnm\Domain\ModelV2\UserInterface;

class UserRepository extends AbstractRepository implements UserInterface
{

    public function getModel()
    {
        return User::class;
    }
}
