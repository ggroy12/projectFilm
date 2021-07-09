<?php

declare(strict_types=1);

interface ActorStorageInterface
{
    /**
     * @return Actor[]
     */
    public function getAllActors(): array;

    public function findActorId(int $id): ?Actor;

    public function findNameActor(string $name, string $surname): ?Actor;
}