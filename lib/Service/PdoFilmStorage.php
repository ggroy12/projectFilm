<?php

declare(strict_types=1);

class PdoFilmStorage implements \FilmStorageInterface
{
private PDO $pdo;

    public function __construct(
    PDO $pdo
) {
    $this->pdo = $pdo;
}

    /**
     * @return Film[]
     */
    public function getAllFilms(): array
{
    $statement = $this->pdo->prepare('SELECT * FROM film;');
    $statement->execute();
    $dbFilms = $statement->fetchAll(PDO::FETCH_ASSOC);

    $films = [];
    foreach ($dbFilms as $dbFilm) {
        $films[] = $this->transformDataToFilm($dbFilm);
    }

    return $films;
}

    public function getSingleFilm(int $id): ?Film
{
    $statement = $this->pdo->prepare('SELECT * FROM film WHERE film_id = :film_id;');
    $statement->execute(['film_id' => $id]);
    $dbFilm = $statement->fetch(PDO::FETCH_ASSOC);

    if (!$dbFilm) {
        return null;
    }

    return $this->transformDataToFilm($dbFilm);
}

    private function transformDataToFilm(array $data): Film
    {
        return new Film(
            (int) $data['film_id'],
            (string) $data['name'],
            (int) $data['release'],
            (string) $data['format'],
            (int) $data['actor_id'],
        );
    }
}