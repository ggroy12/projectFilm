<?php

declare(strict_types=1);

namespace Service;

use PDO;

class Container
{
    private array $configuration;

    private ?PDO $pdo = null;

    private ?\FilmStorageInterface $filmStorage = null;

    private ?\ActorStorageInterface $actorStorage = null;

    public function __construct(
        array $configuration,
    ) {
        $this->configuration = $configuration;
    }

    public function getPDO(): PDO
    {
        if ($this->pdo === null) {
            $this->pdo = new PDO(
                $this->configuration['db_dsn'],
                $this->configuration['db_user'],
                $this->configuration['db_password'],
            );
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        return $this->pdo;
    }

//    public function getLocalFileShipsJson(): string
//    {
//        return __DIR__ . $this->configuration['localFileShipsJson'];
//    }

//    public function getShipStorage(): \FilmStorageInterface
//    {
//        if ($this->filmStorage === null) {
//            $this->filmStorage = new PdoFilmStorage($this->getPDO());
//
//        }
//
//        return $this->filmStorage;
//    }

    public function getActorStorage(): \ActorStorageInterface
    {
        if ($this->actorStorage === null) {
            $this->actorStorage = new \PdoActorStorage($this->getPDO());

        }
        return $this->actorStorage;
    }

    public function getFilmStorage(): \FilmStorageInterface
    {
        if ($this->filmStorage === null) {
            $this->filmStorage = new \PdoFilmStorage($this->getPDO());

        }
        return $this->filmStorage;
    }
}