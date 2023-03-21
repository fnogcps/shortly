<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use fnogcps\Shortly\Controllers\LinkController as Shortly;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Slim\Routing\RouteContext;
use Slim\Views\PhpRenderer;

$app = AppFactory::create();

$app->get('/', static function ($req, $res) {
    $renderer = new PhpRenderer('.');
    return $renderer->render($res, 'main.html', []);
});

$app->post('/', static function (Request $req, Response $res) {
    $url = (new Shortly())->createLink($req->getParsedBody()['url']);
    $payload = ['url' => $url];
    $res->getBody()->write(json_encode($payload));
    return $res->withHeader('Content-Type', 'application/json');
});

$app->get('/s/{code}', static function (Request $req): void {
    $routeContext = RouteContext::fromRequest($req);
    $route = $routeContext->getRoute();
    $code = $route->getArgument('code');
    (new Shortly())->getLink($code);
});

$app->run();
