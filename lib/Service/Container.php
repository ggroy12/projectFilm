<?php

declare(strict_types=1);

namespace Service;

use PDO;

class Container
{
    private array $configuration;

    private ?PDO $pdo = null;

    private ?\FilmWriteInterface $filmWrite = null;

    private ?\ActorWriteInterface $actorWrite = null;

    private ?\MediatorWriteInterface $mediatorWrite = null;

    private ?\FilmStorageInterface $filmStorage = null;

    private ?\ActorStorageInterface $actorStorage = null;

    private ?\MediatorStorageInterface $mediatorStorage = null;

    private ?\DropRecordInterface $dropRecord = null;

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

    public function getMediatorStorage(): \MediatorStorageInterface
    {
        if ($this->mediatorStorage === null) {
            $this->mediatorStorage = new \PdoMediatorStorage($this->getPDO());

        }
        return $this->mediatorStorage;
    }

    public function getFilmWrite(): \FilmWriteInterface
    {
        if ($this->filmWrite === null) {
            $this->filmWrite = new \CreateFilmTable($this->getPDO());

        }
        return $this->filmWrite;
    }

    public function getActorWrite(): \ActorWriteInterface
    {
        if ($this->actorWrite === null) {
            $this->actorWrite = new \CreateActorTable($this->getPDO());

        }
        return $this->actorWrite;
    }

    public function getMediatorWrite(): \MediatorWriteInterface
    {
        if ($this->mediatorWrite === null) {
            $this->mediatorWrite = new \CreateMediatorTable($this->getPDO());

        }
        return $this->mediatorWrite;
    }

    public function getDropRecord(): \DropRecordInterface
    {
        if ($this->dropRecord === null) {
            $this->dropRecord = new \DropRecord($this->getPDO());

        }
        return $this->dropRecord;
    }
}