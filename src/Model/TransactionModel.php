<?php

namespace Prexto\Model;

class TransactionModel
{
    /**
     * @param string $name
     * @param string $credentialId
     *
     * @return array
     */
    public static function all($name, $credentialId)
    {
        /** @user \paybook\User **/
        $user    = UserModel::get($name);
        $session = new \paybook\Session($user);
        /** @credential \paybook\Credential **/
        $credential = CredentialModel::get($name, $credentialId);

        if (!$credential) {
            throw new \Exception(sprintf('La credencial "%s" no existe!', $credentialId));
        }

        return \paybook\Transaction::get($session, null, [
            'id_credential' => $credential->id_credential
        ]);
    }
}
