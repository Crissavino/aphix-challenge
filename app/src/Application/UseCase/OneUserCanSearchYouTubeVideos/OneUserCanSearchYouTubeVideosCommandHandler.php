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
        // This is my apikey, it is in my .env
        // YOUTUBE_API_KEY=AIzaSyA1PxZJR0nx0uYhTiGANkgqoC9WpBYkHcE
        // But I put it here as the default value
        $client = new Google_Client();
        $client->setDeveloperKey(env("YOUTUBE_API_KEY", "AIzaSyA1PxZJR0nx0uYhTiGANkgqoC9WpBYkHcE"));

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

                        $videoHtml = '<div class="col-md-4" id="videos"><h2>'.$searchResult['snippet']['title'].'</h2><iframe width="100%" height="500" src="https://www.youtube.com/embed/'.$searchResult['id']['videoId'].'" frameborder="0" allowfullscreen></iframe></div>';
                        $videos[] = [
                            'title' => $searchResult['snippet']['title'],
                            'videoId' => $searchResult['id']['videoId'],
                            'html' => $videoHtml
                        ];
                        break;
                    case 'youtube#channel':
                        $channelHtml = '<div class="col-md-4"><div class="card"><div class="card-body"><h5 class="card-title">'.$searchResult['snippet']['title'].'</h5><p class="card-text">'.$searchResult['snippet']['description'].'</p><a href="https://www.youtube.com/channel/'.$searchResult['id']['channelId'].'" target="_blank" class="btn btn-primary">Go to channel</a></div></div></div>';
                        $channels[] = [
                            'title' => $searchResult['snippet']['title'],
                            'description' => $searchResult['snippet']['description'],
                            'channelId' => $searchResult['id']['channelId'],
                            'html' => $channelHtml
                        ];
                        break;
                    case 'youtube#playlist':
                        $playlistHtml = '<div class="col-md-4" id="videos"><h2>'.$searchResult['snippet']['title'].'</h2><iframe width="100%" height="500" src="https://www.youtube.com/embed/videoseries?list='.$searchResult['id']['playlistId'].'" frameborder="0" allowfullscreen></iframe></div>';
                        $playlists[] = [
                            'title' => $searchResult['snippet']['title'],
                            'channelId' => $searchResult['id']['playlistId'],
                            'html' => $playlistHtml
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
