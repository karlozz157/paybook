<?php

namespace Prexto\Controller;

use Prexto\Model\CredentialModel;

class CredentialController
{
    /**
     * @param $request
     * @param $response
     * @param $args
     *
     * @return $response
     */
    public function all($request, $response, $args)
    {
        $credentials = CredentialModel::all($args['name']);

        return $response->withJson(['status' => 'ok', 'credentials' => $credentials]);
    } 

    /**
     * @param $request
     * @param $response
     * @param $args
     *
     * @return $response
     */
    public function get($request, $response, $args)
    {
        $credential = CredentialModel::get($args['name'], $args['id_credential']);

        return $response->withJson(['status' => 'ok', 'credential' => $credential]);
    }
}
