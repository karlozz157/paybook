<?php

namespace Prexto\Controller;

use Prexto\Model\SessionModel;

class SessionController
{
    /**
     * @param $request
     * @param $response
     * @param $args
     *
     * @return $response
     */
    public function post($request, $response, $args)
    {
        $body    = $request->getParsedBody();
        $session = SessionModel::create($body['name']);

        return $response->withJson(['status' => 'ok', 'session' => $session]);
    }
}
