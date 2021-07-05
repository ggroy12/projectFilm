<?php

declare(strict_types=1);

class Film
{
    private int $filmId;

    private string $name;

    private int $release;

    private string $format;

    private int $actorId;

    public function __construct(
        int $filmId,
        string $name,
        int $release,
        string $format,
        int $actorId,
    ) {
        $this->filmId = $filmId;
        $this->name = $name;
        $this->release = $release;
        $this->format = $format;
        $this->actorId = $actorId;
    }

    public function getFilmId(): int
    {
        return $this->filmId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getRelease(): int
    {
        return $this->release;
    }

    public function getFormat(): string
    {
        return $this->format;
    }

    public function getActorId(): int
    {
        return $this->actorId;
    }
}
