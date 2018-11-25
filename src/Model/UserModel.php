<?php

namespace Prexto\Model;

class UserModel
{
    /**
     * @return array
     */
    public static function all()
    {
        return \paybook\User::get();
    }

    /**
     * @param string $name
     *
     * @return paybook\User
     */
    public static function get($name)
    {
        $users = static::all();

        $user = array_filter($users, function($user) use ($name) {
            return $user->name === $name;
        });

        return end($user);
    }

    /**
     * @param string $name
     *
     * @return paybook\User
     */
    public static function create($name)
    {
        $user = static::get($name);

        if ($user) {
            return $user;
        }

        return new \paybook\User($name);
    }

    /**
     * @param string $name
     *
     * @return paybook\User
     */
    public static function delete($name)
    {
        $user = static::get($name);

        if (!$user) {
            throw new \Exception(sprintf('No existe el usuario "%s"', $name));
        }

        \paybook\User::delete($user->id_user);

        return $user;
    }
}
