<?php
//start session
session_start();

require __DIR__ . '/../vendor/autoload.php';

$app = new \Slim\App([
	//Turn on errors during production take off when finished.
	'settings' => [
		'displayErrorDetails' => true,
	]

	]);

// creating a route
$app->get('/', function ($request, $response){
	return 'Home';
});

// define which view to render
$container = $app->getContainer();
$container['view'] = function ($container) {
	$view = new \Slim\Views\Twig(__DIR__ . '/../resources/views', [
			// Turn off later
			'cache' => false,

		]);
	$view->addExtension(new \Slim\Views\TwigExtension(
			$container->router,
			$container->request->getUri()
		));
	return $view;
};

// require in routes
require __DIR__ . '/../app/routes.php';