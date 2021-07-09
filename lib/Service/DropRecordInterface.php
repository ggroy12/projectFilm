<?php

declare(strict_types=1);

interface DropRecordInterface
{
    public function drop(int $dropId): void;
}