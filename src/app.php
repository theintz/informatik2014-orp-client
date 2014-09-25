<?php

use Plista\OrpClient\AppController;
use Plista\OrpClient\ErrorHandler;
use Plista\OrpClient\ErrorNotificationHandler;
use Plista\OrpClient\EventNotificationHandler;
use Plista\OrpClient\ItemUpdateHandler;
use Plista\OrpClient\RecommendationRequestHandler;

require_once __DIR__ . '/../vendor/autoload.php';

// let's first install an error handler
Symfony\Component\Debug\ErrorHandler::register();

// then comes the actual application
$app = new Silex\Application();

// setup controllers
$app['controller.recommendation_request'] = $app->share(function (Silex\Application $app) {
	return new RecommendationRequestHandler();
});

$app['controller.event_notification'] = $app->share(function (Silex\Application $app) {
	return new EventNotificationHandler();
});

$app['controller.item_update'] = $app->share(function (Silex\Application $app) {
	return new ItemUpdateHandler();
});

$app['controller.error_notification'] = $app->share(function (Silex\Application $app) {
	return new ErrorNotificationHandler();
});

$app['controller.app'] = $app->share(function (Silex\Application $app) {
	return new AppController();
});

// set up routes, sadly only one, because we use POST parameters. actual routing is
// done within the AppController
// TODO: check how to attach a handler here
// TODO: either use the "AppController::handle" syntax here or use a closure, make sure to pass the parameters through
$app->post('/', $app['controller.app']);

$app->error([new ErrorHandler(), 'handle']);

return $app;