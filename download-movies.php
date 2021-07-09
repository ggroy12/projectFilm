<?php

ini_set('display_errors', 'on');

require __DIR__ . '/bootstrap.php';

$filmWrite = $container->getFilmWrite();
$actorWrite = $container->getActorWrite();
$mediatorWrite = $container->getMediatorWrite();
$filmStorage = $container->getFilmStorage();
$actorStorage = $container->getActorStorage();
$addOneRecordsToDb = new AddOneRecordToDb($filmWrite, $actorWrite, $mediatorWrite, $filmStorage, $actorStorage);

if(isset($_POST['upBtn'])) {
    $filmName = $_POST['filmName'];
    $releaseYear = $_POST['releaseYear'];
    $format = $_POST['format'];
    $stars = $_POST['stars'];
    if (
        isset($filmName) &&
        isset($releaseYear) &&
        isset($format) &&
        isset($stars)
    ) {
        $addOneRecordsToDb->add(
            $filmName,
            $releaseYear,
            $format,
            $stars
        );
    }
}
?>

<html lang="ru">
    <head>
        <meta charset="utf-8">
           <meta http-equiv="X-UA-Compatible" content="IE=edge">
           <meta name="viewport" content="width=device-width, initial-scale=1">
           <title>Загрузка</title>

           <link href="css/style.css" rel="stylesheet">
           <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css"
                 rel="stylesheet"
                 integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x"
                 crossorigin="anonymous">
    </head>
    <header>
        <div class="header-bg page-header">
            <h1 id="text-header">Загрузка фильмов</h1>
        </div>
        <div class="btn-top">
            <a href="/index.php" class="link-top disable-carry">На главную</a>
        </div>
    </header>
    <body>
    <div class="result-box">
        <div class="border">Загрузка файла с фильмами
            <form action="/index.php" method="POST" enctype="multipart/form-data">
                <input type="file" accept="text/*" name="uploadedFile">
                <input type="submit" value="Загрузить" name="uploadedBtn">
            </form>
        </div>
        <form action="" method="POST">
            <input type="text" name="filmName" placeholder="Название фильма" class="form-item" required>
            <input type="text" name="releaseYear" placeholder="Год выхода" class="form-item" required>
            <input type="text" name="format" placeholder="Формат фильма" class="form-item" required>
            <textarea name="stars" cols="55px" rows="5px" class="form-item" required
                      placeholder="Перечень актеров игравших фильме (перечислять через кому ',')"
            ></textarea>
            <input type="submit" value="Загрузить" name="upBtn">
        </form>
    </div>
    </body>
</html>
