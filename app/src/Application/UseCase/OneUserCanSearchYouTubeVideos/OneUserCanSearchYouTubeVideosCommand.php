<?php


namespace App\src\Application\UseCase\OneUserCanSearchYouTubeVideos;


class OneUserCanSearchYouTubeVideosCommand
{
    /**
     * @var string
     */
    private $q;
    /**
     * @var int
     */
    private $maxResults;

    /**
     * OneUserCanSearchYouTubeVideosCommand constructor.
     * @param string $q
     * @param int $maxResults
     */
    public function __construct(string $q, int $maxResults)
    {
        $this->q = $q;
        $this->maxResults = $maxResults;
    }

    /**
     * @return string
     */
    public function getQ(): string
    {
        return $this->q;
    }

    /**
     * @return int
     */
    public function getMaxResults(): int
    {
        return $this->maxResults;
    }
}
