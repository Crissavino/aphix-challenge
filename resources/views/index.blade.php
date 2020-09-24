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
        <h1 class="display-4">Search any YouTube Video</h1>
        <p class="lead">This is a challenge of Aphix Software, I'm using the YouTube API for search videos</p>
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
            <div class="col-md-4">
{{--                <h2>'.$video->videoTitle.'</h2>--}}
{{--                <iframe width="100%" height="500" src="https://www.youtube.com/embed/'.$video->id->videoId.'" frameborder="0" allowfullscreen></iframe>--}}
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
                .then(data => {
                    if (data.success)
                });
        }
    </script>

</body>
</html>
