<?php

declare(strict_types=1);

class Film
{
    private int $filmId;

    private string $name;

    private int $dateRelease;

    private string $format;

    public function getFilmId(): int
    {
        return $this->filmId;
    }

    public function setFilmId(?int $filmId): self
    {
        $this->filmId = $filmId;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDateRelease(): int
    {
        return $this->dateRelease;
    }

    public function setDateRelease(?int $dateRelease): self
    {
        $this->dateRelease = $dateRelease;

        return $this;
    }

    public function getFormat(): string
    {
        return $this->format;
    }

    public function setFormat(?string $format): self
    {
        $this->format = $format;

        return $this;
    }
}
