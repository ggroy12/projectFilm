<?php

declare(strict_types=1);

class DropRecord implements DropRecordInterface
{
    public function __construct(
        PDO $pdo
    ) {
        $this->pdo = $pdo;
    }

    public function drop(int $dropId): void
    {
        $this->dropMediator($dropId);
        $this->dropFilm($dropId);
    }

    public function dropFilm(int $filmId): void
    {
        $findColumnFilmId = $this->pdo->prepare('DELETE FROM film WHERE film_id = :film_id;');
        $findColumnFilmId->execute(['film_id' => $filmId]);
    }

    public function dropActor(int $dropId): void
    {
        /*Method for the future*/
    }

    public function dropMediator(int $filmId): void
    {
        $findColumnFilmId = $this->pdo->prepare('DELETE FROM mediator WHERE film_id = :film_id;');
        $findColumnFilmId->execute(['film_id' => $filmId]);
    }
}