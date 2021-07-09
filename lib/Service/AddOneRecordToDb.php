<?php

declare(strict_types=1);

class AddOneRecordToDb
{
    public function __construct(
      private CreateFilmTable $createFilmTable,
      private CreateActorTable $createActorTable,
      private CreateMediatorTable $createMediatorTable,
      private PdoFilmStorage $filmStorage,
      private PdoActorStorage $actorStorage,
    ) {
    }

    public function add(string $filmName, int $releaseYear, string $format, string $stars): void
    {
        $this->createFilmTable->add($filmName, $releaseYear, $format);
        $filmId = $this->filmStorage->findFilmName($filmName)->getFilmId();

        $starsArray = $this->transformStarsToArray($stars);
        foreach ($starsArray as $star) {
            $this->createActorTable->add(
                $star->getName(),
                $star->getSurname()
            );
            $actorId = $this->actorStorage->findNameActor($star->getName(), $star->getSurname())->getActorId();
            $this->createMediatorTable->add($filmId, $actorId);
        }
    }

    public function transformStarsToArray(string $stars): array
    {
        $arrMergedNameAndSurname = explode(', ', $stars);
        $starsArray = [];
        foreach ($arrMergedNameAndSurname as $StringNameAndSurname) {
            $ArrNameAndSurname = explode(' ', $StringNameAndSurname);
            $actor = new Actor();
            $starsArray[] = $actor
                ->setName($ArrNameAndSurname['0'])
                ->setSurname($ArrNameAndSurname['1'])
            ;
        }
        return $starsArray;
    }
}