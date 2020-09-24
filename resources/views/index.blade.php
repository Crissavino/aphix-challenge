<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <title>Aphix Challenge</title>
</head>
<body>

    <div class="jumbotron">
        <h1 class="display-4">Search any YouTube Video, Channel or Playlist</h1>
        <p class="lead">This is a challenge of Aphix Software, I'm using the YouTube API for search videos, channels or playlists</p>
        <hr class="my-4">

        <div class="row">
                <label for="searchBox">What are you searching?</label>
                <input type="text" class="form-control" name="q" id="searchBox" placeholder="Term to search..." aria-label="Search">

                <label for="maxResults" class="mt-3">How many videos do you want to get?</label>
                <input type="number" class="form-control" id="maxResults" name="maxResults" min="1" max="50" step="1" value="10">

            <div class="col-10 m-auto">
                <button id="searchButton" class="btn btn-block btn-primary mt-5">Search</button>
            </div>
        </div>
    </div>
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="list-group list-group-horizontal-md" id="list-tab" role="tablist">
                    <a class="list-group-item list-group-item-action active" id="list-videos-list" data-toggle="list" href="#list-videos" role="tab" aria-controls="home">Videos</a>
                    <a class="list-group-item list-group-item-action" id="list-channels-list" data-toggle="list" href="#list-channels" role="tab" aria-controls="profile">Channels</a>
                    <a class="list-group-item list-group-item-action" id="list-playlists-list" data-toggle="list" href="#list-playlists" role="tab" aria-controls="messages">Playlists</a>
                </div>
            </div>
            <div class="col-12">
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active mt-5 mb-5" id="list-videos" role="tabpanel" aria-labelledby="list-videos-list">
                        <div class="text-center">
                            <div class="spinner-border m-5 d-none" id="spinnerVideoElement" role="status"><span class="sr-only">Loading...</span></div>
                            <div class="row" id="videoResults"></div>
                        </div>
                    </div>
                    <div class="tab-pane fade mt-5 mb-5" id="list-channels" role="tabpanel" aria-labelledby="list-channels-list">
                        <div class="text-center">
                            <div class="spinner-border m-5 d-none" id="spinnerChannelElement" role="status"><span class="sr-only">Loading...</span></div>
                            <div class="row" id="channelResults"></div>
                        </div>
                    </div>
                    <div class="tab-pane fade mt-5 mb-5" id="list-playlists" role="tabpanel" aria-labelledby="list-playlists-list">
                        <div class="text-center">
                            <div class="spinner-border m-5 d-none" id="spinnerPlaylistElement" role="status"><span class="sr-only">Loading...</span></div>
                            <div class="row" id="playlistResults"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

    <script>
        const searchButton = document.getElementById('searchButton');

        searchButton.addEventListener('click', getYouTubeApiResults)

        function getYouTubeApiResults() {
            const searchBox = document.getElementById('searchBox').value;
            const maxResults = document.getElementById('maxResults').value;
            const url = `/getYouTubeApiResults?q=${searchBox}&maxResults=${maxResults}`;

            fetch(url)
                .then(response => response.json())
                .then(resp => {
                    if (resp.success) {
                        let divVideoResults = document.getElementById('videoResults');
                        divVideoResults.setAttribute('style', 'visibility: hidden;');
                        divVideoResults.innerHTML = '';
                        let spinnerVideoElement = document.getElementById('spinnerVideoElement');
                        if (resp.data.collectionOfVideos.length > 0) {
                            spinnerVideoElement.classList.remove('d-none')
                            resp.data.collectionOfVideos.forEach( (video) => {
                                divVideoResults.innerHTML += video.html;
                            });

                            setTimeout( () => {
                                spinnerVideoElement.classList.add('d-none')
                                divVideoResults.removeAttribute('style');
                            }, 5000)
                        } else {
                            spinnerVideoElement.classList.add('d-none')
                            divVideoResults.removeAttribute('style');
                            divVideoResults.innerHTML = '<div class="m-auto"><h1>No results</h1></div>'
                        }

                        let divChannelResults = document.getElementById('channelResults');
                        divChannelResults.setAttribute('style', 'visibility: hidden;');
                        divChannelResults.innerHTML = '';
                        let spinnerChannelElement = document.getElementById('spinnerChannelElement');
                        if (resp.data.collectionOfChannels.length > 0) {
                            spinnerChannelElement.classList.remove('d-none')
                            resp.data.collectionOfChannels.forEach( (channel) => {
                                divChannelResults.innerHTML += channel.html;
                            });

                            setTimeout( () => {
                                spinnerChannelElement.classList.add('d-none')
                                divChannelResults.removeAttribute('style');
                            }, 5000)
                        } else {
                            spinnerChannelElement.classList.add('d-none')
                            divChannelResults.removeAttribute('style');
                            divChannelResults.innerHTML = '<div class="m-auto"><h1>No results</h1></div>'
                        }

                        let divPlaylistResults = document.getElementById('playlistResults');
                        divPlaylistResults.setAttribute('style', 'visibility: hidden;');
                        divPlaylistResults.innerHTML = '';
                        let spinnerPlaylistElement = document.getElementById('spinnerPlaylistElement');
                        if (resp.data.collectionOfPlaylists.length > 0) {
                            spinnerPlaylistElement.classList.remove('d-none')
                            resp.data.collectionOfPlaylists.forEach( (channel) => {
                                divPlaylistResults.innerHTML += channel.html;
                            });

                            setTimeout( () => {
                                spinnerPlaylistElement.classList.add('d-none')
                                divPlaylistResults.removeAttribute('style');
                            }, 5000)
                        } else {
                            spinnerPlaylistElement.classList.add('d-none')
                            divPlaylistResults.removeAttribute('style');
                            divPlaylistResults.innerHTML = '<div class="m-auto"><h1>No results</h1></div>'
                        }


                    } else {
                        alert(resp.message)
                    }
                });
        }
    </script>

</body>
</html>
