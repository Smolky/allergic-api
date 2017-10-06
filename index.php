<?php

/**
 * Allergic API
 *
 * This API endpoint will allow different devices to 
 * post data about allergic molecules
 *
 * @package AllergicAPI
 */ 
 
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \Illuminate\Database\Capsule\Manager as DatabaseManager;

error_reporting(E_ALL); ini_set('display_errors', '1');


// Autoload
require 'vendor/autoload.php';
require 'config.php';
require 'Allergic.php';


// Start application
// ----------------------------------------------------------------------------
$app = new \Slim\App (['settings' => $config]);


// Dependency container
// ----------------------------------------------------------------------------
$container = $app->getContainer();

    
// Service factory for the ORM
$container['db'] = function ($container) {

    $capsule = new DatabaseManager;
    $capsule->addConnection ($container->get('settings')['db']);
    $capsule->setAsGlobal ();
    $capsule->bootEloquent ();

    return $capsule;
};



// Routes
// ----------------------------------------------------------------------------
$app->post ('/allergic-info/new', function (Request $request, Response $response) {
    
    // Get services
    $db = $this->get ('db');
     
     
    // Fetch data
    $data = $request->getParsedBody ();
    
    
    // Sanitize data
    $parsed_data = [];
    $parsed_data['mac'] = filter_var ($data['mac'], FILTER_SANITIZE_STRING);
    $parsed_data['response'] = $data['response'];
    
    
    // Create record
    $record = new Allergic ();
    $record->mac = $parsed_data['mac'];
    $record->response = $parsed_data['response'];
    $record->save ();
    
    
    // Return response
    return $response->withJson (['ok' => $record->id ? true : false, 'id' => $record->id]);

});
$app->run();