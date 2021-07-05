<?php

declare(strict_types=1);

interface ActorStorageInterface
{
    /**
     * @return Actor[]
     */
    public function getAllActors(): array;

    public function getSingleActor(int $id): ?Actor;
}