<?php

declare(strict_types=1);

class TransformTextFile
{
    public const TITLE = 'Title:';

    public const FORMAT = 'Format:';

    public const RELEASE_YEAR = 'Release Year:';

    public const STARS = 'Stars:';

    private int $recordId = 1;

    private ?string $title;

    private ?string $releaseYear;

    private ?string $format;

    private array $stars = [];

    /**
     * @array class Actor and Film
     */
    public function transform(array $arrayStrings, bool $filmOrActor = false ): array
    {
        $arrayResult = [];
        foreach ($arrayStrings as $string) {
            if ($this->transformDataToClass($string) === true) {
                $film = new Film();
                if ($filmOrActor === true){
                    $arrayResult[] = $film->setFilmId($this->recordId)
                        ->setName($this->title)
                        ->setDateRelease((int) $this->releaseYear)
                        ->setFormat($this->format)
                    ;
                } elseif ($filmOrActor == false) {
                    $arrayResult[$this->title] = $this->stars;
                }
                $this->recordId++;
            }
        }
        return $arrayResult;
    }

    private function toConvert(string $string, $search): ?string
    {
        return trim(str_replace("$search", '', strstr($string, "$search")));
    }

    /**
     * @array class Film
     */
    private function transformDataToClass(string $string): ?bool
    {
        if(strstr($string, self::TITLE) == true) {
            $this->title = $this->toConvert($string, self::TITLE);
            return null;
        } elseif (strstr($string, self::RELEASE_YEAR) == true) {
            $this->releaseYear = $this->toConvert($string, self::RELEASE_YEAR);
            return null;
        } elseif (strstr($string, self::FORMAT) == true) {
            $this->format = $this->toConvert($string, self::FORMAT);
            return null;
        } elseif (strstr($string, self::STARS) == true) {
            $this->splitNameAndSurname($this->toConvert($string, self::STARS));
            return true;
        } else {
            return null;
        }
    }

    /**
     * @array class Actor
     */
    private function splitNameAndSurname(string $string): void
    {
        $arrMergedNameAndSurname = explode(', ', $string);
        $this->stars = [];
        foreach ($arrMergedNameAndSurname as $StringNameAndSurname) {
            $ArrNameAndSurname = explode(' ', $StringNameAndSurname);
            $actor = new Actor();
            $this->stars[] = $actor->setActorId($this->recordId)
                ->setName($ArrNameAndSurname['0'])
                ->setSurname($ArrNameAndSurname['1'])
            ;
        }
    }
}