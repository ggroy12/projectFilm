<?php

declare(strict_types=1);

class CreateMediatorTable implements MediatorWriteInterface
{
    private PDO $pdo;

    public function __construct(
        PDO $pdo
    ) {
        $this->pdo = $pdo;
    }

    public function add(
        $filmId,
        $actorId
    ): void {
        if ($this->checkExistence($filmId, $actorId) === false) {
            $this->pdo->exec(
                "INSERT INTO mediator(
                film_id,
                actor_id
                ) VALUES (
                '{$filmId}',
                '{$actorId}'
                )"
            );
        }
    }

    public function checkExistence($filmId, $actorId): bool
    {
        $findColumnFilmId = $this->pdo->prepare('SELECT * FROM mediator WHERE film_id = :film_id AND actor_id = :actor_id;');
        $findColumnFilmId->execute(['film_id' => $filmId, 'actor_id' => $actorId]);
        $film = $findColumnFilmId->fetch(PDO::FETCH_ASSOC);

        if ($film !== null) {
            return false;
        } else {
            return true;
        }
    }
}