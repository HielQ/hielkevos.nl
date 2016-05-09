<!DOCTYPE HTML>
<html lang="{{app()->getLocale() }}">

 <head>
     <title> Hielke Vos @if(Request::path() !== '/') | {{ucfirst(Request::path())}} @endif</title>
     <meta charset="UTF-8">
     <meta name="description" content="A websita about myself and other stuff">
     <meta name="keywords" content="C++,Java,PHP,C#,HielQ Hielke,Vos,Vosje91,F1">
     <meta name="author" content="Hielke Vos">

     <link rel="stylesheet" href="{{ elixir('css/app.css')}}">



     <script>
         (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                     (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                 m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
         })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

         ga('create', 'UA-76154135-1', 'auto');
         ga('send', 'pageview');

     </script>

     @yield('extraCSS')

 </head>

  <body>
  <nav class="navbar navbar-luna header navbar-static-top">
      <div class="container">
      <div class="navbar-header">
          <button type="button" class="navbar-toggle collapse" data-toggle="collapse" data-target="#headerNav">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
          </button>
          <a href="{{URL::to('/')}}" class="navbar-brand">
          <img class="img responsive img-circle" src="assets/image/brand/Rainbow_Dash_chillin'_S02E03.png">
          </a>
          </div>

          <!-- Collect the nav links, forms, and other content for toggeling -->
          <div class="collapse navbar-collapse" id="headerNav">
              <ul class="nav navbar-nav">
               {{--   <li @if(Request::path() === '/') class="active" @endif><a href="/"><i class="fa fa-home"></i>{{trans('navbar.home')}}</a></li> --}}
                {{--  <li @if(Request::path() === 'about') class="active" @endif><a href="/about"><i class="fa fa-user"></i>{{trans('navbar.about')}}</a></li> --}}
                  <li @if(Request::path() === 'music') class="active" @endif> <a href="/music"> <i class="fa fa-music"></i>{{trans('navbar.music')}}</a></li>
              {{--  <li @if(Request::path() === 'games') class="active" @endif><a href="/games"><i class="fa fa-gamepad"></i>{{trans('navbar.games')}}</a></li>  --}}
                  <li @if(Request::path() === 'projects') class="active" @endif><a href="/projects"> <i class="fa fa-folder"></i>{{trans('navbar.projects')}}</a></li>
                  <li @if(Request::Path() === 'licenses') class="active" @endif><a href="/licenses"> <i class="fa fa-gavel"></i>{{trans('navbar.licenses')}}</a></li>
              </ul>

              <ul class="nav navbar-nav header-social pull-right hidden-sm hidden-xs">
                  <li><a href="https://github.com/HielQ" target="_blank" data-toggle="tooltip" data-placement="bottom" title="Github"> <i class="fa fa-github"></i></a> </li>
                  <li><a href="https://steamcommunity.com/id/HielQ" target="_blank" data-toggle="tooltip" data-placement="bottom" title="Steam"><i class="fa fa-steam"></i></a></li>
                  <li><a href="https://facebook.com/hielke.vos" target="_blank" data-toggle="tooltip" data-placement="bottom" title="Facebook"><i class="fa fa-facebook"></i></a></li>
                  <li><a href="https://www.last.fm/user/HielQ" target="_blank" data-toggle="tooltip" data-placement="bottom" title="Lastfm"><i class="fa fa-lastfm"></i></a></li>
                  <li class="dropdown">
                      <a class="{{ isset($button) ? 'btn btn-default' : '' }} dropdown-toggle" href="#" id="language-dropdown" data-toggle='dropdown' aria-expanded='false' aria-haspopup='true'>
                          {{ App\Helpers\LocaleHelper::localeToString(App::getLocale()) }}
                          <span class="caret"></span>
                      </a>
                      <ul class="dropdown-menu" role="menu" aria-labelledby="language-dropdown">
                          <li>
                              <a role="menuitem" href="{{ url('language/en') }}">
                                  <img class="flag" src="{{ asset('assets/images/flags/en.png') }}"/>{{ trans('language.English') }}
                              </a>
                          </li>
                          <li>
                              <a role="menuitem" href="{{ url('language/nl') }}">
                                  <img class="flag" src="{{ asset('assets/images/flags/nl.png') }}"/>{{ trans('language.Dutch') }}
                              </a>
                          </li>
                          <li>
                              <a role="menuitem" href="{{ url('language/nl') }}">
                                  <img class="flag" src="{{ asset('assets/images/flags/nl.png') }}"/>{{ trans('language.Dutch') }}
                              </a>
                          </li>

                  </li>
                          </ul>
              </ul>


          </div>
      </div>
  </nav>

  <div class="header-image">
      @yield('header')
  </div>

  <div class="container content">
      <div class="row">
          <div class="col-md-9">
              <br />

              @if(Session::has('message'))
                  <div class="alert alert - {{ Session::get('type') }}"> {{Session::get('message')}}</div>
                  @endif

              @yield('content')

              <br />
          </div>
          <div class="col-md-3">
              <nav class="sidebar hidden-print hidden-xs hidden-sm">
                  <ul class="nav sidenav">
                     {{--} <li @if (Request::path() === 'about') class="active" @endif><a href="/about"><i class="fa fa-user"></i>{{trans('navbar.about')}}</a></li> --}
                    {{--  <li @if( Request::path()=== '/') class="active" @endif><a href="/"><i class="fa fa-home"></i>{{trans('navbar.home')}}</a></li> --}}
                      <li @if( Request::path()=== 'music') class="active" @endif><a href="/music"><i class="fa fa-music"></i>{{trans('navbar.music')}}</a></li>
                    {{-- <li @if( Request::path()=== 'games') class="active" @endif><a href="/games"><i class="fa fa-gamepad"></i>{{trans('navbar.games')}}</a></li> --}}
                      <li @if( Request::path()=== 'projects') class="active"@endif><a href="/projects"><i class="fa fa-folder"></i>{{trans('navbar.projects')}}</a></li>
                      <li @if( Request::path() === 'licenses') class="active"@endif><a href="/licenses"><i class="fa fa-gavel">{{trans('navbar.licenses')}}</i></a> </li>
                      <li @if( Request::path() === 'clock') class="active"@endif><a href="/clock"><i class="fa fa-clock-o">{{trans('navbar.clock')}}</i></a></li>

                      <br />

                      @if(Auth::check())
                          <li @if( Request::path() === 'upload' ) class="active" @endif><a href="/upload"><i class="fa fa-upload"></i> Upload</a></li>
                          <br />
                          <li @if( Request::path() === 's/list' ) class="active" @endif><a href="/s/list"><i class="fa fa-list"></i> Image list</a></li>
                          <li @if( Request::path() === 's/overview' ) class="active" @endif><a href="/s/overview"><i class="fa fa-th"></i> Image overview</a></li>
                          <br />
                          <li @if( Request::path() === 'f/list' ) class="active" @endif><a href="/f/list"><i class="fa fa-list"></i> File list</a></li>
                          <br />
                          <li><a href="/logout"><i class="fa fa-user"></i> Logout</a></li>
                      @else
                    {{--  <li @if(Request::path() === 'login') class="active" @endif><a href="/login"><i class="fa fa-user"></i>{{trans('navbar.login')}}</a></li> --}}

                          @endif

                  </ul>
              </nav>
          </div>

      </div>

      <footer class="container footer">
          <hr />

          <div class="row">
              <div class="col-md-4 col-xs-6">
                  <p class="lead"><i class="fa fa-copyright"></i>{{trans('footer.copyright')}}</p>
                  2016 Hielke Vos
              </div>
              <div class="col-md-4 hidden-sm hidden-xs">
                  <p class="lead"><i class="fa fa-power-off"></i>{{trans('footer.powerdby')}}</p>
                  <ul class="list-unstyled">
                      <li><a href="http://getbootstrap.com">Twitter Bootstrap</a></li>
                      <li><a href="http://laravel.com">Laravel Framework</a></li>
                      <li><a href="http://jquery.com">jQuery</a></li>
                      <li><a href="http://fontawesome.io/">Font Awesome</a></li>
                  </ul>
              </div>
              <div class="col-md-4 col-xs-6">
                  <p class="lead"><i class="fa fa-gavel"></i> {{trans('footer.licenses')}}</p>
                  This website is licensed under the <a href="https://github.com/HielQ/hielkevos.nl/blob/master/LICENSE">MIT License</a><br />
                  The other licenses can be found <a href="/licenses">here</a>
              </div>
          </div>
      </footer>

      </div>



  <script   src="https://code.jquery.com/jquery-2.2.3.js"   integrity="sha256-laXWtGydpwqJ8JA+X9x2miwmaiKhn8tVmOVEigRNtP4="   crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

  @yield('extraJS')

  </body>

</html>