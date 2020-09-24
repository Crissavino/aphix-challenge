<?php


namespace App\src\Application\UseCase\OneUserCanSearchYouTubeVideos;


use Illuminate\Support\Collection;

class OneUserCanSearchYouTubeVideosResponse
{
    /**
     * @var Collection|null
     */
    private $collectionOfVideos;
    /**
     * @var Collection|null
     */
    private $collectionOfChannels;
    /**
     * @var Collection|null
     */
    private $collectionOfPlaylists;

    /**
     * OneUserCanSearchYouTubeVideosResponse constructor.
     * @param Collection|null $collectionOfVideos
     * @param Collection|null $collectionOfChannels
     * @param Collection|null $collectionOfPlaylists
     */
    public function __construct(?Collection $collectionOfVideos, ?Collection $collectionOfChannels, ?Collection $collectionOfPlaylists)
    {
        $this->collectionOfVideos = $collectionOfVideos;
        $this->collectionOfChannels = $collectionOfChannels;
        $this->collectionOfPlaylists = $collectionOfPlaylists;
    }

    /**
     * @return Collection|null
     */
    public function getCollectionOfVideos(): ?Collection
    {
        return $this->collectionOfVideos;
    }

    /**
     * @return Collection|null
     */
    public function getCollectionOfChannels(): ?Collection
    {
        return $this->collectionOfChannels;
    }

    /**
     * @return Collection|null
     */
    public function getCollectionOfPlaylists(): ?Collection
    {
        return $this->collectionOfPlaylists;
    }

    public function getResponse()
    {
        return [
            'collectionOfVideos' => $this->getCollectionOfVideos(),
            'collectionOfChannels' => $this->getCollectionOfChannels(),
            'collectionOfPlaylists' => $this->getCollectionOfPlaylists()
        ];
    }
}
