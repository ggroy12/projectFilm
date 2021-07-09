<?php

ini_set('display_errors', 'on');

require __DIR__ . '/bootstrap.php';

$transformArray = new TransformTextFile();
$dropRecord = $container->getDropRecord();
$filmWrite = $container->getFilmWrite();
$actorWrite = $container->getActorWrite();
$mediatorWrite = $container->getMediatorWrite();

$actorLoader = $container->getActorStorage();
$actors = $actorLoader->getAllActors();

$filmStorage = $container->getFilmStorage();
$films = $filmStorage->getAllFilms();

$mediatorStorage = $container->getMediatorStorage();
$mediators = $mediatorStorage->getAllMediators();

if(isset($_POST['uploadedBtn'])) {
    $path = "resources/" . $_FILES["uploadedFile"]["name"];
    move_uploaded_file($_FILES["uploadedFile"]["tmp_name"], $path);
    $arrStrings = file("$path", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $arrObjectFilms = $transformArray->transform($arrStrings, true);
    $arrObjectActors = $transformArray->transform($arrStrings);

    foreach ($arrObjectFilms as $film){
        $filmWrite->add(
            $film->getName(),
            (int) $film->getDateRelease(),
            $film->getFormat()
        );
    }

    foreach ($arrObjectActors as $objectActor){
        foreach ($objectActor as $actor) {
            $actorWrite->add(
                $actor->getName(),
                $actor->getSurname(),
            );
        }
    }

    foreach ($arrObjectActors as $filmName => $objectActor) {
        foreach ($objectActor as $actor) {

            $filmId = $filmStorage->findFilmName($filmName)->getFilmId();
            $actorObject = $actorLoader->findNameActor($actor->getName(), $actor->getSurname());

            if ($filmId !== null && $actorObject !== null) {
                $checkExistence = $container->getMediatorStorage()->getFindFilmActorId($filmId, $actorObject->getActorId());

                if ($checkExistence === null) {
                    $mediatorWrite->add($filmId, $actorObject->getActorId());
                }
            }
        }
    }
    unlink($path);
}

if(isset($_POST['btnDrop'])) {
    $dropRecord->drop($_POST['dropInput']);
}

$films = $filmStorage->getAllFilms();
$actors = $actorLoader->getAllActors();
$mediators = $mediatorStorage->getAllMediators();
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
    <header>
        <div class="header-bg page-header">
            <h1 id="text-header">Большое хранилище фильмов</h1>
        </div>
        <div class="btn-top">
            <a href="/download-movies.php" class="link-top">Загрузить еще</a> |
            <a href="/find-film.php" class="link-top">Поиск фильма</a>
        </div>
    </header>
    <body>
        <div class="container">
            <table class="table table-hover table-block">
                <thead>
                    <tr>
                        <th class="left-vertical">Название фильма</th>
                        <th class="item">Год выпуска</th>
                        <th class="item">Формат фильма</th>
                        <th class="item">Актеры</th>
                        <th class="item"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($films as $film): ?>
                        <tr>
                            <td class="left-vertical"><?php echo $film->getName(); ?></td>
                            <td class="item"><?php echo $film->getDateRelease(); ?></td>
                            <td class="item"><?php echo $film->getFormat(); ?></td>
                            <td class="item"><?php foreach ($mediators as $mediator) {
                                if ($mediator->getFilmId() === $film->getFilmId()) {
                                    foreach ($actors as $actor) {
                                        if ($actor->getActorId() === $mediator->getActorId()) {
                                            echo $actor->getName() . ' ' . $actor->getSurname() . '<br>';
                                        }
                                    }
                                }
                            };
                            ?></td>
                            <td class="item">
                                    <form action="" method="POST">
                                    <input type="hidden" name="dropInput" value="<?php echo $film->getFilmId(); ?>">
                                    <input type="submit" value="Удалить" name="btnDrop">
                            </form></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </body>
</html>
