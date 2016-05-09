@extends('master')

@section('header')
    <img src="/assets/image/headers/home.jpg"/>
    <h1><i class="fa fa-home"></i>Hielkevos.nl</h1>

    @stop

@section('content')

   <div class="text-center">
       <p id="aboutSite">
           {{trans('home.aboutme')}}
           <br />
           {{trans('home.about_made')}}
       </p>
   </div>

   <div class="row">
       <div class="text-center">
       <div class="col-md-12">
               <h3>Hielke Vos {{trans('home.twitter')}}</h3>
               <small>{{trans('home.twitter_text')}}</small><br />
           <a class="twitter-timeline" href="https://twitter.com/hashtag/zoutkamp" data-widget-id="722770176861741056">Tweets over #zoutkamp</a>
           <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
       </div>
       </div>

   </div>

    @stop
