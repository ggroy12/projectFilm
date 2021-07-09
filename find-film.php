<?php

ini_set('display_errors', 'on');

require __DIR__ . '/bootstrap.php';

$dropRecord = $container->getDropRecord();
$filmWrite = $container->getFilmWrite();
$actorWrite = $container->getActorWrite();
$mediatorWrite = $container->getMediatorWrite();

$filmStorage = $container->getFilmStorage();

$actorLoader = $container->getActorStorage();
$actors = $actorLoader->getAllActors();

$mediatorStorage = $container->getMediatorStorage();
$mediators = $mediatorStorage->getAllMediators();

$addOneRecordsToDb = new AddOneRecordToDb($filmWrite, $actorWrite, $mediatorWrite, $filmStorage, $actorLoader);

if(isset($_POST['findBtn'])) {
    $filmName = $_POST['inputName'];
    if ($_POST['list'] == 'film') {
        $filmObject = $filmStorage->findFilmName($_POST['inputName']);
        if (!empty($filmObject)){
            $filmsArr[] = $filmObject;
        } else {
            $filmsArr = null;
        }
    } elseif ($_POST['list'] == 'actor') {
        $nameAndSurnameArr = explode(' ', $_POST['inputName']);
        $actorObject = $actorLoader->findNameActor($nameAndSurnameArr['0'], $nameAndSurnameArr['1']);
        if (isset($actorObject)) {
            $actorId = $actorObject->getActorId();
            foreach ($mediators as $mediator) {
                if ($mediator->getActorId() === $actorId) {
                    $filmsArr[] = $filmStorage->findFilmId($mediator->getFilmId());
                }
            }
        }
    }
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
    <title>Поиск</title>

    <link href="css/style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css"
          rel="stylesheet"
          integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x"
          crossorigin="anonymous">
</head>
<header>
    <div class="header-bg page-header">
        <h1 id="text-header">Поиск фильма</h1>
    </div>
    <div class="btn-top">
        <a href="/index.php" class="link-top disable-carry">На главную</a>
    </div>
</header>
<body>
    <div class="result-box">
        <form action="" method="POST">
            <input type="text" name="inputName" placeholder="Название фильма" class="form-item" required>
            <select name="list" class="select">
                <option value="film">Искать по названию</option>
                <option value="actor">Искать по актеру</option>
            </select></p>
            <input type="submit" value="Поиск" name="findBtn">
        </form>
    </div>
    <div class="container">
        <?php if (isset($filmsArr)): ?>
            <div>
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
                    <?php foreach ($filmsArr as $film): ?>
                        <tr>
                            <td class="left-vertical"><?php echo $film->getName(); ?></td>
                            <td class="item"><?php echo $film->getDateRelease(); ?></td>
                            <td class="item"><?php echo $film->getFormat(); ?></td>
                            <td class="item"><?php foreach ($mediators as $mediator) {
                                    if ($mediator->getFilmId() === $film->getFilmId()) {
                                        foreach ($actors as $actor) {
                                            if ($actor->getActorId() === $mediator->getActorId()): ?>
                                                <?php echo $actor->getName() ?> <?php echo $actor->getSurname(); ?><br>
                                            <?php endif;
                                        }
                                    }
                                };
                                ?></td>
                            <td class="item">
                                <form action="" method="POST">
                                    <input type="hidden" name="dropInput" value="<?php echo $film->getFilmId(); ?>">
                                    <input type="submit" value="Удалить" name="btnDrop">
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
