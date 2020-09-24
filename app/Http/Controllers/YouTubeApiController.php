<?php

namespace App\Http\Controllers;

use App\src\Application\UseCase\OneUserCanSearchYouTubeVideos\OneUserCanSearchYouTubeVideosCommand;
use App\src\Application\UseCase\OneUserCanSearchYouTubeVideos\OneUserCanSearchYouTubeVideosCommandHandler;
use App\src\Application\UseCase\OneUserCanSearchYouTubeVideos\OneUserCanSearchYouTubeVideosResponse;
use App\src\Infrastructure\Classes\Request\SearchYouTubeVideoRequest;
use Illuminate\Http\Request;

class YouTubeApiController extends Controller
{
    public function showIndex()
    {
        return view('index');
    }

    public function searchVideo(Request $request)
    {
        $requestResponse = (new SearchYouTubeVideoRequest($request))->__invoke();
        if (!$requestResponse['success']) {
            return response()->json([
                'success' => $requestResponse['success'],
                'message' => $requestResponse['message'],
            ]);
        }

        $command = new OneUserCanSearchYouTubeVideosCommand($requestResponse['q'], $requestResponse['maxResults']);

        $response = (new OneUserCanSearchYouTubeVideosCommandHandler())->handler($command);
        if (!$response['success']) {
            return response()->json([
                'success' => $response['success'],
                'message' => $response['message'],
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => $response['message'],
            'data'    => (new OneUserCanSearchYouTubeVideosResponse($response['collectionOfVideos'], $response['collectionOfChannels'], $response['collectionOfPlaylists']))->getResponse(),
        ]);
    }
}
