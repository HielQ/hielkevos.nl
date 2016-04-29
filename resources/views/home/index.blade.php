@extends('master')

@section('header')
    <img src="/assets/image/headers/home.jpg"/>
    <h1><i class="fa fa-home"></i>Hielkevos.nl</h1>

    @stop

@section('content')

   <div class="text-center">
       <p id="aboutSite">
           {{trans('home.aboutme')}}
       </p>
   </div>

   <div class="row">
       <div class="col-md-6">
               <h3>Hielke Vos {{trans('home.twitter')}}</h3>
               <small>{{trans('home.twitter_text')}}</small><br />
           <a class="twitter-timeline" href="https://twitter.com/hashtag/zoutkamp" data-widget-id="722770176861741056">Tweets over #zoutkamp</a>
           <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>



       </div>
       <div class="col-md-6">
           <div class="music-wrapper">
               <h3>Hielke Vos Music</h3>
               <span id="currentOrRecent"><i class="fa fa-circle-o-notch fa-spin"></i></span><br/>
               <span id="track">{{trans('music.loading')}}</span><br/>
               <span id="artist"></span><br/>
               <span id="album"></span>
               <div id="album-art"></div>
           </div>

       </div>
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
                url: "https://ws.audioscrobbler.com/2.0/?method=user.gettopalbums&user=HielQ&api_key=f75aac90214b47ed5027a78c6947697e&format=json&period=1month&limit=5",
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
                url: "https://ws.audioscrobbler.com/2.0/?method=user.gettoptracks&user=HielQ&api_key=f75aac90214b47ed5027a78c6947697e&format=json&period=1month&limit=5",
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
                url: "https://ws.audioscrobbler.com/2.0/?method=user.getrecenttracks&user=HielQ&api_key=f75aac90214b47ed5027a78c6947697e&format=json&limit=1",
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




