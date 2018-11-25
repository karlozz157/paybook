<?php

namespace Prexto\Controller;

use Prexto\Model\TransactionModel;

class TransactionController
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
        $transactions = TransactionModel::all($args['name'], $args['id_credential']);

        return $response->withJson(['status' => 'ok', 'transactions' => $transactions]);
    }
}
