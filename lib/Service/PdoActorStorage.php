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

    public function findActorId(int $id): ?Actor
    {
        $statement = $this->pdo->prepare('SELECT * FROM actor WHERE actor_id = :actor_id;');
        $statement->execute(['actor_id' => $id]);
        $dbActor = $statement->fetch(PDO::FETCH_ASSOC);

        if ($dbActor === null) {
            return null;
        }

        return $this->transformDataToActor($dbActor);
    }

    public function findNameActor(string $name, string $surname): ?Actor
    {
        $statement = $this->pdo->prepare('SELECT * FROM actor WHERE actor_name = :actor_name AND surname = :surname;');
        $statement->execute(['actor_name' => $name, 'surname' => $surname]);
        $dbActor = $statement->fetch(PDO::FETCH_ASSOC);

        if (empty($dbActor)) {
            return null;
        }
        return $this->transformDataToActor($dbActor);
    }

    private function transformDataToActor(array $data): Actor
    {
        $actor = new Actor();
        $actor->setActorId((int) $data['actor_id'])
            ->setName((string) $data['actor_name'])
            ->setSurname((string) $data['surname'])
        ;
        return $actor;
    }
}