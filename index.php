<?php

ini_set('display_errors', 'on');

require __DIR__ . '/bootstrap.php';

$actorLoader = $container->getActorStorage();
$actors = $actorLoader->getAllActors();

$filmStorage = $container->getFilmStorage();
$films = $filmStorage->getAllFilms();

//foreach ($actors as $actor){
//    echo $actor->getActorId();
//    echo $actor->getName();
//    echo $actor->getSurname();
//}

?>

<html lang="ru">
    <head>
        <meta charset="utf-8">
           <meta http-equiv="X-UA-Compatible" content="IE=edge">
           <meta name="viewport" content="width=device-width, initial-scale=1">
           <title>Хранилище</title>

           <link href="css/style.css" rel="stylesheet">
           <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css"
                 rel="stylesheet"
                 integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x"
                 crossorigin="anonymous">
    </head>

    <body>
        <div class="container">
            <div class="page-header">
                <h1>Большое хранилище фильмов</h1>
            </div>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Название фильма</th>
                        <th>Год выпуска</th>
                        <th>Формат фильма</th>
                        <th>Актеры</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($films as $film): ?>
                        <tr>
                            <td><?php echo $film->getName(); ?></td>
                            <td><?php echo $film->getRelease(); ?></td>
                            <td><?php echo $film->getFormat(); ?></td>
                            <td><?php echo $film->getActorId(); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            
            <div class="battle-box center-block border">

            </div>
        </div>
    </body>
</html>
