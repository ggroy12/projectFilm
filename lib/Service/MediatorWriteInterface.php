<?php

declare(strict_types=1);

interface MediatorWriteInterface
{
    public function add($filmId, $actorId): void;

    public function checkExistence($filmId, $actorId): bool;
}