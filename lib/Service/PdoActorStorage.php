<?php

declare(strict_types=1);

class PdoActorStorage implements \ActorStorageInterface
{
    private PDO $pdo;

    public function __construct(
        PDO $pdo
    ) {
        $this->pdo = $pdo;
    }

    /**
     * @return Actor[]
     */
    public function getAllActors(): array
    {
        $statement = $this->pdo->prepare('SELECT * FROM actor;');
        $statement->execute();
        $dbActors = $statement->fetchAll(PDO::FETCH_ASSOC);

        $actors = [];
        foreach ($dbActors as $dbActor) {
            $actors[] = $this->transformDataToActor($dbActor);
        }

        return $actors;
    }

    public function getSingleActor(int $id): ?Actor
    {
        $statement = $this->pdo->prepare('SELECT * FROM actor WHERE actor_id = :actor_id;');
        $statement->execute(['actor_id' => $id]);
        $dbActor = $statement->fetch(PDO::FETCH_ASSOC);

        if (!$dbActor) {
            return null;
        }

        return $this->transformDataToActor($dbActor);
    }

    private function transformDataToActor(array $data): Actor
    {
        return new Actor(
            (int) $data['actor_id'],
            (string) $data['name'],
            (string) $data['surname'],
        );
    }
}