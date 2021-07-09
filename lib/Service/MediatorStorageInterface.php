<?php

declare(strict_types=1);

interface MediatorStorageInterface
{
    /**
     * @return Mediator[]
     */
    public function getAllMediators(): array;

    public function getFindMediatorId(int $id): ?Mediator;

    public function getFindFilmActorId(int $filmId, int $actorId): ?Mediator;
}