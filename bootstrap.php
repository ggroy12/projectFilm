<?php

ini_set('display_errors', 'on');
error_reporting(E_ALL);

$configuration = [
    'db_dsn' => 'mysql:host=localhost;dbname=WebbyLab',
    'db_user' => 'webby_lab',
    'db_password' => 'Webby_lab_2021'
];

require __DIR__ . '/lib/Service/Container.php';
require __DIR__ . '/lib/Service/FilmStorageInterface.php';
require __DIR__ . '/lib/Service/ActorStorageInterface.php';
require __DIR__ . '/lib/Model/Film.php';
require __DIR__ . '/lib/Model/Actor.php';
require __DIR__ . '/lib/Service/PdoFilmStorage.php';
require __DIR__ . '/lib/Service/PdoActorStorage.php';

$container = new \Service\Container($configuration);
