@extends('master')

@section('header')

    <img src="/assets/image/headers/project.jpg"/>

    <h1>{{trans('header.project')}}</h1>

    @stop

@section('content')

    <div class="text-center">
        @if(count($github_projects) > 0)
            @foreach($github_projects as $project)
                <?php
                $created_at = new \DateTime($project->created_at);
                $updated_at = new \DateTime($project->pushed_at);
                ?>


                <div class="panel panel-default">
                <div class="panel-body">
                    <div class="project-header">
                        <h3><i class="fa {{$project->fork ? 'fa-code-fork' : 'fa-github'}}"></i> {{$project->name}} <small>(<a href="{{$project->html_url}}" target="_blank">source</a>)</small></h3>
                    </div>

                    <div class="row text-left">
                        <div class="col-md-5">
                            <table class="table table-condensed">
                                <tr>
                                    <td><strong><i class="fa fa-file-code-o"></i> Language </strong></td>
                                    <td>{{$project->language}}</td>
                                </tr>
                                <tr>
                                    <td><strong><i class="fa fa-clock-o"></i>Created</strong></td>
                                    <td>{{ $created_at->format('Y-m-d H:i:s') }}</td>
                                </tr>
                                <tr>
                                    <td><strong><i class="fa fa-clock-o"></i>Updated </strong></td>
                                    <td>{{ $updated_at->format('Y-m-d H:i:s' ) }}</td>
                                </tr>
                            </table>

                        </div>
                        <div class="col-sm-7">
                            <p class="lead">
                                {{ $project->description }}
                            </p>

                        </div>
                    </div>
                </div>

            </div>
            @endforeach

            @else
                    <div class="alert alert-warning">{{trans('error.gitfailed')}} <i class="fa fa-frown-o fa-2px"></i></div>
            @endif
    </div>

@stop

@section('extraCSS')
    <style type="text/css">
        @media (min-width: 768px) {
            .table {
                border-right: 1px solid #bbb;
            }
        }
        .table > tbody > tr > td {
            border-top: none;
        }
        .project-header {
            margin: 20px 0;
        }
    </style>
@stop
