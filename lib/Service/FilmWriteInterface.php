<?php

declare(strict_types=1);

interface FilmWriteInterface
{
    public function add($name, $dateRelease, $format): void;

    public function getFindFilmName($name): ?array;
}