<?php

use Symfony\Component\Debug\Debug;
use Symfony\Component\HttpFoundation\Request;

/**
 * @var Composer\Autoload\ClassLoader
 */
$loader = require __DIR__.'/../app/autoload.php';
include_once __DIR__.'/../var/bootstrap.php.cache';

$env = getenv('SYMFONY_ENV') ?: 'prod';
$debug = ($env === 'dev');

if ($debug) {
    Debug::enable();
}

$kernel = new AppKernel($env, $debug);
$kernel->loadClassCache();

$request = Request::createFromGlobals();

$response = $kernel->handle($request);
$response->send();

$kernel->terminate($request, $response);
