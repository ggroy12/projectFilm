<?php

declare(strict_types=1);

require __DIR__ . '/bootstrap.php';

/*
 sudo mysql
 CREATE USER 'webby_lab'@'localhost' IDENTIFIED BY 'Webby_lab_2021';
 GRANT ALL PRIVILEGES ON *.* TO 'webby_lab'@'localhost';
 FLUSH PRIVILEGES;
 */

$databaseName = 'WebbyLab';
$databaseUser = 'webby_lab';
$databasePassword = 'Webby_lab_2021';

$pdoDatabase = new PDO('mysql:host=localhost', $databaseUser, $databasePassword);
$pdoDatabase->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdoDatabase->exec('CREATE DATABASE IF NOT EXISTS ' . $databaseName);

$pdo = new PDO('mysql:host=localhost;dbname='.$databaseName, $databaseUser, $databasePassword);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$pdo->exec('DROP TABLE IF EXISTS film;');
$pdo->exec("CREATE TABLE `film` (
 `film_id` INT (11) NOT NULL AUTO_INCREMENT,
 `film_name` VARCHAR (255) COLLATE utf8mb4_unicode_ci NOT NULL,
 `date_release` INT(11) NOT NULL,
 `format` VARCHAR(15) COLLATE utf8mb4_unicode_ci NOT NULL,
 PRIMARY KEY (`film_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

$pdo->exec('DROP TABLE IF EXISTS actor;');
$pdo->exec("CREATE TABLE `actor` (
 `actor_id` INT (11) NOT NULL AUTO_INCREMENT,
 `actor_name` VARCHAR (255) COLLATE utf8mb4_unicode_ci NOT NULL,
 `surname` VARCHAR (255) COLLATE utf8mb4_unicode_ci NOT NULL,
 PRIMARY KEY (`actor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

$pdo->exec('DROP TABLE IF EXISTS mediator;');
$pdo->exec("CREATE TABLE `mediator` (
 `mediator_id` INT (11) NOT NULL AUTO_INCREMENT,
 `film_id` INT (11) NOT NULL,
 `actor_id` INT (11) NOT NULL,
 PRIMARY KEY (`mediator_id`),
 FOREIGN KEY (film_id) REFERENCES film (film_id),
 FOREIGN KEY (actor_id) REFERENCES actor (actor_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

echo 'Ding!';
