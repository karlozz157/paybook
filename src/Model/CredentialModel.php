<?php

namespace Prexto\Model;

class CredentialModel
{
    /**
     * @return array
     */
    public static function all($name)
    {
        /** @user \paybook\User **/
        $user    = UserModel::get($name);
        $session = new \paybook\Session($user);

        return \paybook\Credentials::get($session);
    }

    /**
     * @param string $idCredential
     *
     * @return paybook\Credentials
     */
    public static function get($name, $idCredential)
    {
        $credentials = static::all($name);

        $credential = array_filter($credentials, function($credential) use ($idCredential) {
            return $credential->id_credential === $idCredential;
        });

        return end($credential);
    }
}
