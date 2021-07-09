<?php

declare(strict_types=1);

class PdoMediatorStorage implements \MediatorStorageInterface
{
    private PDO $pdo;

    public function __construct(
        PDO $pdo
    ) {
        $this->pdo = $pdo;
    }

    /**
     * @return Mediator[]
     */
    public function getAllMediators(): array
    {
        $statement = $this->pdo->prepare('SELECT * FROM mediator;');
        $statement->execute();
        $dbMediators = $statement->fetchAll(PDO::FETCH_ASSOC);

        $mediators = [];
        foreach ($dbMediators as $dbMediator) {
            $mediators[] = $this->transformDataToMediator($dbMediator);
        }

        return $mediators;
    }

    public function getFindMediatorId(int $id): ?Mediator
    {
        $statement = $this->pdo->prepare('SELECT * FROM mediator WHERE mediator_id = :mediator_id;');
        $statement->execute(['mediator_id' => $id]);
        $dbMediator = $statement->fetch(PDO::FETCH_ASSOC);

        if (!$dbMediator) {
            return null;
        }

        return $this->transformDataToMediator($dbMediator);
    }

    public function getFindFilmActorId(int $filmId, int $actorId): ?Mediator
    {
        $statement = $this->pdo->prepare('SELECT * FROM mediator WHERE film_id = :film_id AND actor_id = :actor_id;');
        $statement->execute(['film_id' => $filmId, 'actor_id' => $actorId]);
        $dbMediator = $statement->fetch(PDO::FETCH_ASSOC);

        if (empty($dbMediator)) {
            return null;
        }

        return $this->transformDataToMediator($dbMediator);
    }

    private function transformDataToMediator(array $data): Mediator
    {
        return new Mediator(
            (int) $data['mediator_id'],
            (int) $data['film_id'],
            (int) $data['actor_id'],
        );
    }
}