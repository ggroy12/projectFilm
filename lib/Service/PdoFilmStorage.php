<?php

declare(strict_types=1);

class PdoFilmStorage implements FilmStorageInterface
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
        $statement = $this->pdo->prepare('SELECT * FROM film ORDER BY film_name;');
        $statement->execute();
        $dbFilms = $statement->fetchAll(PDO::FETCH_ASSOC);

        $films = [];
        foreach ($dbFilms as $dbFilm) {
            $films[] = $this->transformDataToFilm($dbFilm);
        }

        return $films;
    }

    public function findFilmId(int $id): ?Film
    {
        $statement = $this->pdo->prepare('SELECT * FROM film WHERE film_id = :film_id;');
        $statement->execute(['film_id' => $id]);
        $dbFilm = $statement->fetch(PDO::FETCH_ASSOC);

        if (!$dbFilm) {
            return null;
        }

        return $this->transformDataToFilm($dbFilm);
    }

    public function findFilmName(string $name): ?Film
    {
        $statement = $this->pdo->prepare('SELECT * FROM film WHERE film_name = :film_name;');
        $statement->execute(['film_name' => $name]);
        $dbFilm = $statement->fetch(PDO::FETCH_ASSOC);

        if (!$dbFilm) {
            return null;
        }

        return $this->transformDataToFilm($dbFilm);
    }

    private function transformDataToFilm(array $data): Film
    {
        $film = new Film();
            $film->setFilmId((int) $data['film_id'])
                ->setName((string) $data['film_name'])
                ->setDateRelease((int) $data['date_release'])
                ->setFormat((string) $data['format'])
            ;
        return $film;
    }
}