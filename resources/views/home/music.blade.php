
@extends('master')

@section('header')
    <img src="/assets/image/headers/music.jpg"/>

    <h1><i class="fa fa-music"></i>{{trans('header.music')}}</h1>
@stop

@section('content')
    <div class="text-center">
        <div class="music-wrapper">
            <span id="currentOrRecent"><i class="fa fa-circle-o-notch fa-spin"></i></span><br/>
            <span id="track">{{trans('music.loading')}}</span><br/>
            <span id="artist"></span><br/>
            <span id="album"></span>
            <div id="album-art"></div>
        </div>


        <hr/>

        <table class="font-light" id="topAlbumsTable">
            <caption>
                <h3 class="font-light">Top 5 Albums ({{ $month }})</h3>
            </caption>

            <thead>
            <tr>
                <th class="font-medium">
                    Artist
                </th>
                <th class="font-medium">
                    Album
                </th>
            </tr>
            </thead>

            <tbody id="topAlbums"></tbody>
        </table>

        <table class="font-light" id="topTrackTable">
            <caption>
                <h3 class="font-light">Top 5 Tracks ({{ $month }})<h3>
            </caption>

            <thead>
            <tr>
                <th class="font-medium">
                    Artist
                </th>
                <th class="font-medium">
                    Track
                </th>
            </tr>
            </thead>

            <tbody id="topTracks"></tbody>
        </table>
    </div>
@stop

@section('extraCSS')
    <style type="text/css">
        table {
            border-collapse: collapse;
            width: 100%;
            margin: 20px 0;
            border: 1px solid #bbb;
        }
        caption {
            border-bottom: 0px;
            text-align: center;
            border: 1px solid #bbb;
            border-top-left-radius: 5px;
            border-top-right-radius: 5px;
        }
        th {
            padding: 10px 0px;
            text-align: center;
        }
        td {
            padding: 10px;
            border-top: 1px solid #bbb;
        }
        td:nth-child(1) {
            width: 30%;
        }
        tbody tr:hover {
            background-color: #607D8B;
            color: white;
        }
        tbody tr:hover a {
            color: white;
            text-decoration: underline;
        }
        .font-light {
            font-weight: 300;
        }
        .music-wrapper {
            min-height: 275px;
        }
        #currentOrRecent {
            font-weight: 300;
            font-size: 25px;
            letter-spacing: -2px;
        }
        #track {
            font-weight: 600;
            font-size: 35px;
            letter-spacing: -2px;
        }
        #track::after {
            content: "by";
            display: block;
            height: 0px;
            margin-bottom: -10px;
            font-size: 30px;
            font-weight: 200;
            font-style: italic;
        }
        #artist {
            font-weight: 400;
            font-size: 30px;
        }
        #album {
            font-weight: 200;
            font-size: 30px;
            letter-spacing: -2px;
        }
        #album-art {
            width: 300px;
            height: 300px;
            position: absolute;
            top: 0;
            opacity: 0.05;
            text-align: center;
            left: 50%;
            margin-left: -150px;
        }
    </style>
@stop

@section('extraJS')
    <script type="text/javascript">
        $(window).load(function () {
            getMusicData();
            setInterval(function () {
                getMusicData();
            }, 5000);
        });
        function getMusicData() {
            //Get the top 5 albums
            $.ajax({
                url: "https://ws.audioscrobbler.com/2.0/?method=user.gettopalbums&user=duckthom&api_key=4540282aa7e002408e12ad79f027d8b9&format=json&period=1month&limit=5",
                dataType: "json",
                method: "GET",
                async: true,
                success: function (data) {
                    var text = '';
                    for (var i = 0; i < 5; i++) {
                        var album = data.topalbums.album[i];
                        var albumName = album.name;
                        var albumLink = album.url;
                        var playcount = album.playcount;
                        var artistName = album.artist.name;
                        var artistLink = album.artist.url;
                        text += "<tr><td><a href='" +
                                artistLink +
                                "'>" +
                                artistName +
                                "</a></td><td><a href='" +
                                albumLink +
                                "'>" +
                                albumName +
                                "</a> (" +
                                playcount +
                                (playcount === "1" ? " play" : " plays") +
                                ")</td></tr>";
                    }
                    $("#topAlbums").html(text);
                },
                failure: function () {
                    $("#topAlbums").append("<tr><td class='error'>Couldn\'t fetch top 5 albums, please refresh the page.</td></tr>");
                }
            });
            // Get the top 5 tracks of the past month
            $.ajax({
                url: "https://ws.audioscrobbler.com/2.0/?method=user.gettoptracks&user=duckthom&api_key=4540282aa7e002408e12ad79f027d8b9&format=json&period=1month&limit=5",
                dataType: "json",
                method: "GET",
                async: true,
                success: function (data) {
                    var text = '';
                    for (var i = 0; i < 5; i++) {
                        var track = data.toptracks.track[i];
                        var trackName = track.name;
                        var trackLink = track.url;
                        var playcount = track.playcount;
                        var artistName = track.artist.name;
                        var artistLink = track.artist.url;
                        text += "<tr><td><a href='" +
                                artistLink +
                                "'>" +
                                artistName +
                                "</a></td><td><a href='" +
                                trackLink +
                                "'>" +
                                trackName +
                                "</a> (" +
                                playcount +
                                (playcount === "1" ? " play" : " plays") +
                                ")</td></tr>";
                    }
                    $("#topTracks").html(text);
                },
                failure: function () {
                    $("#topTracks").append("<tr><td class='error'>Couldn\'t fetch top 5 albums, please refresh the page.</td></tr>");
                }
            });
            // Get the current track
            $.ajax({
                url: "https://ws.audioscrobbler.com/2.0/?method=user.getrecenttracks&user=DuckThom&api_key=4540282aa7e002408e12ad79f027d8b9&format=json&limit=1",
                dataType: "json",
                method: "GET",
                async: true,
                success: function (data) {
                    var track = data.recenttracks.track[0];
                    if (typeof track['@attr'] != "undefined") {
                        // This code will be used if the user is currenly listening to something
                        var prefix = "<div class='sp sp-wave'></div> &nbsp; Now playing";
                    } else {
                        // If the user is not listening to anything, show the latest track that they listened to
                        var prefix = "<i class='fa fa-pause'></i> &nbsp; Recently played";
                    }
                    var trackName = track.name;
                    var artistName = track.artist['#text'];
                    var albumName = (track.album['#text'] != '' ? "[" + track.album['#text'] + "]" : "");
                    var albumArt = track.image[3]['#text'];
                    $("#currentOrRecent").html(prefix);
                    if ($("#track").html() != trackName) {
                        $("#track").html(trackName);
                        $("#artist").html(artistName);
                        $("#album").html(albumName);
                        $("#album-art").css('background-image', "url(" + albumArt + ")");
                    }
                },
                error: function (xhr, textStatus, errorThrown) {
                    $("#track").html("Couldn\'t fetch the recent track. Reloading...");
                }
            });
        }
    </script>
@stop

