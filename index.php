<?php

include __DIR__ . '/vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;

$app = new Silex\Application();


$request = Request::createFromGlobals();
$whiteList = array(
    '127.0.0.1',
    '198.168.0.*',
    '192.168.50.1',
);

$blackList = array(
    '192.168.50.*',
);
$app = (new Stack\Builder())
    ->push('Pderoubaix\Stack\Firewall',$whiteList,$blackList,$request->getClientIp())
    ->push('Stack\UrlMap', [
        "/admin" => include __DIR__ . '/app/admin.php',
        "/dashboard" => include __DIR__ . '/app/dashboard.php'])
    ->resolve($app);

$response = $app->handle($request);

$response->send();

$app->terminate($request, $response);