<?php

namespace Prexto\Controller;

use Prexto\Model\UserModel;

class UserController
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
        $users = UserModel::all();

        return $response->withJson(['status' => 'ok', 'users' => $users]);
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
        $user = UserModel::get($args['name']);

        return $response->withJson(['status' => 'ok', 'user' => $user]);
    }

    /**
     * @param $request
     * @param $response
     * @param $args
     *
     * @return $response
     */
    public function post($request, $response, $args)
    {
        $body = $request->getParsedBody();
        $user = UserModel::create($body['name']);

        return $response->withJson(['status' => 'ok', 'user' => $user]);
    }

    /**
     * @param $request
     * @param $response
     * @param $args
     *
     * @return $response
     */
    public function delete($request, $response, $args)
    {
        $user = UserModel::delete($args['name']);

        return $response->withJson(['status' => 'ok', 'user' => $user]);
    }
}
