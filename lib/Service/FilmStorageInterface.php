<?php

declare(strict_types=1);

interface FilmStorageInterface
{
    /**
     * @return Film[]
     */
    public function getAllFilms(): array;

    public function findFilmId(int $id): ?Film;

    public function findFilmName(string $name): ?Film;
}