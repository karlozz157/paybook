<?php

namespace Prexto\Model;

class SessionModel
{
    /**
     * @param string $name
     *
     * @return \paybook\Session
     */
    public static function create($name)
    {
        /** @user \paybook\User **/
        $user = UserModel::get($name);

        if (!$user) {
            throw new \Exception('El usuaio no existe!');
        }

        return new \paybook\Session($user);
    }
}
