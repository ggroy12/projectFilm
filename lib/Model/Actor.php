<?php

declare(strict_types=1);

class Actor
{
    private int $actorId;

    private string $name;

    private string $surname;

    public function __construct(
        int $actorId,
        string $name,
        string $surname,
    ) {
        $this->actorId = $actorId;
        $this->name = $name;
        $this->surname = $surname;
    }

    public function getActorId(): int
    {
        return $this->actorId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSurname(): string
    {
        return $this->surname;
    }
}