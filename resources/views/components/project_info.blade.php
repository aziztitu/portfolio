@php
    /**
     * Created by PhpStorm.
     * User: azizt
     * Date: 6/8/2018
     * Time: 5:07 PM
     */
@endphp

<div class="project-info">
    <div class="row">
        <div class="col s12 project-description">
            @if(isset($projectDescription))
                {{$projectDescription}}
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col s12 project-media-container">
            @if(isset($project))
                <ul class="media-slider cS-hidden">
                    @foreach($project->infoVideos as $infoVideo)
                        <li class="media-item" data-src="{{$infoVideo['link']}}"
                            data-thumb="{{$infoVideo['thumbPath']}}">
                            <a>
                                <div class="thumb-holder valign-wrapper video"
                                     style='background-image: url("{{$infoVideo['thumbPath']}}")'
                                     data-ratio="{{$infoVideo['ratio']}}">
                                    <div class="play-icon-wrapper">
                                        <img class="valign center" src="img/play-button.png"/>
                                    </div>
                                </div>
                            </a>
                        </li>
                    @endforeach

                    @foreach($project->infoImages as $infoImage)
                        <li class="media-item" data-src="{{$infoImage['path']}}"
                            data-thumb="{{$infoImage['thumbPath']}}">
                            <a>
                                <div class="thumb-holder" style='background-image: url("{{$infoImage['thumbPath']}}")'
                                     data-ratio="{{$infoImage['ratio']}}"></div>
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col s12 project-details">
            @if(isset($projectDetails))
                {{$projectDetails}}
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col s12 project-links">
            @if(isset($projectLinks))
                {{$projectLinks}}
            @endif
        </div>
    </div>
</div>