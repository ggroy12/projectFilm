<?php

declare(strict_types=1);

class Mediator
{
    private int $mediatorId;

    private int $filmId;

    private int $actorId;

    public function __construct(
        int $mediatorId,
        int $filmId,
        int $actorId,
    ) {
        $this->mediatorId = $mediatorId;
        $this->filmId = $filmId;
        $this->actorId = $actorId;
    }

    public function getMediatorId(): int
    {
        return $this->mediatorId;
    }

    public function getFilmId(): int
    {
        return $this->filmId;
    }

    public function getActorId(): int
    {
        return $this->actorId;
    }
}