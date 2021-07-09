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
require __DIR__ . '/lib/Service/MediatorStorageInterface.php';
require __DIR__ . '/lib/Service/ActorWriteInterface.php';
require __DIR__ . '/lib/Service/FilmWriteInterface.php';
require __DIR__ . '/lib/Service/MediatorWriteInterface.php';
require __DIR__ . '/lib/Service/DropRecordInterface.php';
require __DIR__ . '/lib/Model/Film.php';
require __DIR__ . '/lib/Model/Actor.php';
require __DIR__ . '/lib/Model/Mediator.php';
require __DIR__ . '/lib/Service/CreateFilmTable.php';
require __DIR__ . '/lib/Service/CreateActorTable.php';
require __DIR__ . '/lib/Service/CreateMediatorTable.php';
require __DIR__ . '/lib/Service/PdoFilmStorage.php';
require __DIR__ . '/lib/Service/PdoActorStorage.php';
require __DIR__ . '/lib/Service/PdoMediatorStorage.php';
require __DIR__ . '/lib/Service/TransformTextFile.php';
require __DIR__ . '/lib/Service/AddOneRecordToDb.php';
require __DIR__ . '/lib/Service/DropRecord.php';

$container = new \Service\Container($configuration);
