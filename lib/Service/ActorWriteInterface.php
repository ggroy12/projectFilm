<?php

declare(strict_types=1);

interface ActorWriteInterface
{
    public function add($name, $surname): void;

    public function getFindActor($name, $surname): ?array;
}