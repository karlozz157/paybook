<?php

require __DIR__ . '/vendor/autoload.php';

define('API_KEY', '');

paybook\Paybook::init(API_KEY, true, true);

$configuration = [
    'settings' => [
        'displayErrorDetails' => true,
    ],
];

$c   = new \Slim\Container($configuration);
$app = new \Slim\App($c);

// users
$app->get('/users', \Prexto\Controller\UserController::class . ':all');
$app->get('/users/{name}', \Prexto\Controller\UserController::class . ':get');
$app->post('/users', \Prexto\Controller\UserController::class . ':post');
$app->delete('/users/{name}', \Prexto\Controller\UserController::class . ':delete');

// sessions
$app->post('/session', \Prexto\Controller\SessionController::class . ':post');

// credentials
$app->get('/credentials/{name}', \Prexto\Controller\CredentialController::class . ':all');
$app->get('/credentials/{name}/{id_credential}', \Prexto\Controller\CredentialController::class . ':get');

// transactions
$app->get('/transactions/{name}/{id_credential}', \Prexto\Controller\TransactionController::class . ':all');

$app->run();
