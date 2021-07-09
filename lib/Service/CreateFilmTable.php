<?php

declare(strict_types=1);

class CreateFilmTable implements FilmWriteInterface
{
    private PDO $pdo;

    public function __construct(
        PDO $pdo
    ) {
        $this->pdo = $pdo;
    }

    public function add(
        $name,
        $dateRelease,
        $format
    ): void {
        if ($this->getFindFilmName($name) === null) {
            $this->pdo->exec(
                "INSERT INTO film(
                film_name,
                date_release,
                format
                ) VALUES (
                '{$name}',
                '{$dateRelease}',
                '{$format}'
                )"
            );
        }
    }

    public function getFindFilmName($name): ?array
    {
        $dbName = $this->pdo->prepare('SELECT * FROM film WHERE film_name = :film_name;');
        $dbName->execute(['film_name' => $name]);
        $actorName = $dbName->fetch(PDO::FETCH_ASSOC);

        if (empty($actorName)) {
            return null;
        } else {
            return $actorName;
        }
    }
}