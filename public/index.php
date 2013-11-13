<?php

use Slim\Slim;

//Autoloading:: Para generar el autoload de librerias instaladas con composer
require '../vendor/autoload.php';


/**
 * Configuración de slim
 */
    //Inicializar la aplicación
    $app = new \Slim\Slim(array(
        'mode' => 'development',
        'debug' => true,
        'templates.path' => '../templates',
    ));

    // Solo invocado si el modo es "production"
    $app->configureMode('production', function () use ($app) {
        $app->config(array(
            'log.enable' => true,
            'debug' => false
        ));
    });

    // Solo invocado si el modo es  "test"
    $app->configureMode('test', function () use ($app) {
        $app->config(array(
            'log.enable' => test,
            'debug' => true
        ));
    });

    // Solo invocado si el modo es  "development"
    $app->configureMode('development', function () use ($app) {
        $app->config(array(
            'log.enable' => false,
            'debug' => true
        ));
    });


/**
 * Obtener lista de canciones method GET
 */

    //Cuándo escuche la ruta /api/song implementa la function anónima, para poder utilizar app internamente use ($app)
    $app->get('/api/songs', function() use ($app) {
        //define una conexicón a base de datos
        $connection = new PDO(
                'mysql:host=localhost;dbname=slimphp',
                'slimphpuser',
                'sl1mphpus3r!'
            );
        //Definición del query
        $statement = $connection->prepare('SELECT * FROM song');
        $statement->execute();
        //Crear equivalente de un array aosictivo
        $songs = $statement->fetchAll(PDO::FETCH_ASSOC);
        print_r(songs);
        echo json_encode($songs, JSON_PRETTY_PRINT);
    });