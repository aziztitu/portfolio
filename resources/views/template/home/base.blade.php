@extends('template.common.root')

@section('title')
@endsection

@section('head')
    @parent
    <link rel="stylesheet" href="/css/home/base.css">
@endsection

@section('body')

    {{--Mobile Nav--}}
    <div class="navbar-fixed mobile-nav hide-on-large-only">
        <a href="#" data-activates="nav-mobile" class="button-collapse" style="padding-top:10px">
            <i class="material-icons white-text">menu</i>
        </a>
    </div>

    <ul id="nav-mobile" class="cyan darken-1 side-nav">
        <li>
            <div class="logo_wrapper">
                <img class="logo" src="/images/common/pics/logo.png"/>
            </div>
        </li>
        @isset($sections)
        @foreach($sections as $section)
            <li class="waves-effect waves-light no-padding section_tab mobile" sectionId="{{$section->id}}"
                style="width: 100%">
                <a class="section_item" style="color:#FFF">
                    <i style="float:left;"
                       class="tiny material-icons white-text">{{$section->icon_name}}</i>
                    {{$section->name}}
                </a>
            </li>
        @endforeach
        @endisset
    </ul>

    {{--Root Cover--}}
    <div class="root_cover row">
        <div class="background_layer">
            @isset($sections)
            @foreach($sections as $section)
                <div class="background_object" sectionId="{{$section->id}}"
                     style="background-image: url({{$section->bg_path}});">

                </div>
            @endforeach
            @endisset
        </div>
        <div class="foreground_layer">
            {{--Left Pane--}}
            <div class="pane extra col s0 l2 hide-on-med-and-down">

            </div>

            {{--Middle Pane--}}
            <div class="pane content col s12 l8">
                @isset($sections)
                @foreach($sections as $section)
                    <div class="content_object" sectionId="{{$section->id}}">
                        @yield("content_object_".$section->id)
                    </div>
                @endforeach
                @endisset
            </div>

            {{--Right Pane--}}
            <div class="pane sections col s0 l2 valign-wrapper hide-on-med-and-down">
                <div class="valign content_wrapper">
                    <div class="row logo_wrapper">
                        <img class="logo" src="/images/common/pics/logo.png"/>
                    </div>
                    <div class="row">
                        <ul class="section_list">
                            @isset($sections)
                            @foreach($sections as $section)
                                <li class="section_tab" sectionId="{{$section->id}}">
                                    <a class="section_item">
                                        <i style="float:left;"
                                           class="tiny material-icons">{{$section->icon_name}}</i>
                                        {{$section->name}}
                                    </a>
                                </li>
                            @endforeach
                            @endisset
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{--Scripts--}}
    <script type="text/javascript" src="/js/home/base.js"></script>
@endsection

