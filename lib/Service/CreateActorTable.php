<?php

declare(strict_types=1);

class CreateActorTable implements ActorWriteInterface
{
    private PDO $pdo;

    public function __construct(
        PDO $pdo
    ) {
        $this->pdo = $pdo;
    }

    public function add(
        $name,
        $surname,
    ): void {
        if ($this->getFindActor($name, $surname) === null) {
            $this->pdo->exec(
                "INSERT INTO actor(
                actor_name,
                surname
                ) VALUES (
                '{$name}', 
                '{$surname}'
                )"
            );
        }
    }

    public function getFindActor($name, $surname): ?array
    {
        $findColumnName = $this->pdo->prepare('SELECT * FROM actor WHERE actor_name = :actor_name AND surname = :surname;');
        $findColumnName->execute(['actor_name' => $name, 'surname' => $surname]);
        $actor = $findColumnName->fetch(PDO::FETCH_ASSOC);

        if (empty($actor)) {
            return null;
        } else {
            return $actor;
        }
    }
}