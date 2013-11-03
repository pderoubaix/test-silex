<?php

include __DIR__ . '/vendor/autoload.php';

use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class MyKernel implements HttpKernelInterface
{
    public function handle(Request $request, $type = HttpKernelInterface::MASTER_REQUEST, $catch = true)
    {
        return new Response("Hello");
    }
}

$app = (new Stack\Builder())
    ->push('Stack\UrlMap', [
        "/blog" => include __DIR__ . '/app/blog.php',
        "/api" => include __DIR__ . '/app/api.php'
    ])->resolve(new MyKernel());

$request = Request::createFromGlobals();

$response = $app->handle($request);
$response->send();

$app->terminate($request, $response);