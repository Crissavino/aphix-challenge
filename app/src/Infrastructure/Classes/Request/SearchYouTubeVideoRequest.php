<?php

namespace App\src\Infrastructure\Classes\Request;

use Illuminate\Http\Request;

class SearchYouTubeVideoRequest
{
    /**
     * @var Request
     */
    private $request;

    /**
     * SearchYouTubeVideoRequest constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function __invoke()
    {
        $q = $this->request->q;
        if (!$q) {
            return [
                'success' => false,
                'message' => 'Empty query'
            ];
        }

        $maxResults = $this->request->maxResults;
        if (!$maxResults) {
            $maxResults = 10;
        }

        return [
            'success' => true,
            'q' => $q,
            'maxResults' => $maxResults,
        ];
    }
}
