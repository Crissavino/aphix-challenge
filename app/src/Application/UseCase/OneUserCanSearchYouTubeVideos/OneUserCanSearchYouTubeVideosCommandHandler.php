<?php


namespace App\src\Application\UseCase\OneUserCanSearchYouTubeVideos;


use Google_Client;
use Google_Service_YouTube;

class OneUserCanSearchYouTubeVideosCommandHandler
{

    /**
     * OneUserCanSearchYouTubeVideosCommandHandler constructor.
     */
    public function __construct()
    {
    }

    public function handler(OneUserCanSearchYouTubeVideosCommand $command): array
    {
        $client = new Google_Client();
        $client->setDeveloperKey(env("YOUTUBE_API_KEY"));

        $youtube = new Google_Service_YouTube($client);

        try {
            $searchResponse = $youtube->search->listSearch('id,snippet', array(
                'q' => $command->getQ(),
                'maxResults' => $command->getMaxResults(),
            ));

            $videos = [];
            $channels = [];
            $playlists = [];

            foreach ($searchResponse['items'] as $searchResult) {
                switch ($searchResult['id']['kind']) {
                    case 'youtube#video':
                        $videos[] = [
                            'title' => $searchResult['snippet']['title'],
                            'videoId' => $searchResult['id']['videoId']
                        ];
                        break;
                    case 'youtube#channel':
                        $channels[] = [
                            'title' => $searchResult['snippet']['title'],
                            'channelId' => $searchResult['id']['channelId']
                        ];
                        break;
                    case 'youtube#playlist':
                        $playlists[] = [
                            'title' => $searchResult['snippet']['title'],
                            'channelId' => $searchResult['id']['playlistId']
                        ];
                        break;
                }
            }
            $collectionOfVideos = collect($videos);
            $collectionOfChannels = collect($channels);
            $collectionOfPlaylists = collect($playlists);

            return [
                'success' => true,
                'message' => 'List of results',
                'collectionOfVideos' => $collectionOfVideos,
                'collectionOfChannels' => $collectionOfChannels,
                'collectionOfPlaylists' => $collectionOfPlaylists,
            ];

        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
    }
}
