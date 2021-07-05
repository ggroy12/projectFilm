<?php

declare(strict_types=1);

interface FilmStorageInterface
{
    /**
     * @return Film[]
     */
    public function getAllFilms(): array;

    public function getSingleFilm(int $id): ?Film;
}