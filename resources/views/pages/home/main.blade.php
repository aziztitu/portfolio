@php
    /**
     * Created by PhpStorm.
     * User: azizt
     * Date: 8/26/2017
     * Time: 2:07 PM
     */
@endphp

@extends('template.home.base', ['sections' => $sectionData])

@section('title')
    {{$title}}
@endsection

@section('head')
    @parent
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700" type="text/css" rel="stylesheet"/>
    {{--<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">--}}
    <link rel="stylesheet" href="https://cdn.rawgit.com/konpa/devicon/df6431e323547add1b4cf45992913f15286456d3/devicon.min.css">

    <link rel="stylesheet" href="/css/home/main.css">
    <link rel="stylesheet" href="/css/font-mfizz/font-mfizz.css">
    <link type="text/css" rel="stylesheet" href="css/lightslider.css"/>
    <link type="text/css" rel="stylesheet" href="css/lightgallery.css"/>

    <script type="text/javascript" src="/js/common/typed.min.js"></script>
    <script type="text/javascript" src="/js/common/particles.min.js"></script>
    <script type="text/javascript" src="/js/home/hammer.min.js"></script>

    <script src="js/lightslider.min.js"></script>
    <script src="js/lightgallery.min.js"></script>
    <script src="js/lg-fullscreen.min.js"></script>
    <script src="js/lg-hash.min.js"></script>
    <script src="js/lg-pager.min.js"></script>
    <script src="js/lg-share.min.js"></script>
    <script src="js/lg-thumbnail.min.js"></script>
    <script src="js/lg-video.min.js"></script>
    <script src="js/lg-zoom.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-mousewheel/3.1.13/jquery.mousewheel.min.js"></script>

    <script type="text/javascript" src="/js/home/main.js"></script>
@endsection

@section("content_object_".$sectionData['welcome']->id)
    <div class="section_data valign-wrapper">
        <div class="row">
            <div class="row center-align">
                <span class="title welcome">Welcome to the portfolio of</span>
            </div>
            <div class="row center-align">
                <span class="title name"><span class="nickname">Az</span>iztitu Murugan</span>
            </div>
        </div>
        <div class="footer center-align">
            @component('components.downarrows')
            @endcomponent
        </div>
    </div>
@endsection

@section("content_object_".$sectionData['about_me']->id)
    <div class="section_data">
        <div class="row">
            <div class="col s12">
                <div class="subtitle_wrapper">
                    <span class="subtitle">About Me</span>
                </div>
            </div>
        </div>
        {{--<div class="divider"></div>--}}
        <div class="about_me_table_wrapper valign-wrapper">
            <div class="row expand">
                <table class="about_me_table valign">
                    @foreach($sectionData['about_me']->section_data as $fieldValuePairs)
                        <tr>
                            <td class="field right-align">{{$fieldValuePairs->field}}</td>
                            <td class="value"><span class="content"
                                                    id="aboutMeTypeData_{{$loop->index}}">{{$fieldValuePairs->value}}</span>
                            </td>
                        </tr>
                    @endforeach
                </table>
                <div class="row more_details_wrapper right-align hide">
                    <a class="more_details">More Details...</a>
                </div>
            </div>
        </div>
        <div class="footer center-align">
            @component('components.mouseyscroller')
            @endcomponent
        </div>
    </div>
@endsection

@section("content_object_".$sectionData['skills']->id)
    <div class="section_data">
        <div class="row">
            <div class="col s12">
                <div class="subtitle_wrapper">
                    <span class="subtitle">Skills</span>
                </div>
            </div>
        </div>
        {{--<div class="divider"></div>--}}
        @foreach($sectionData['skills']->section_data as $skillSet)
            <div class="skills_wrapper valign-wrapper">
                <div class="row expand">
                    <div class="col s12 skillset-name-wrapper">
                        <span class="skillset-name">
                            {{$skillSet->name}}
                        </span>
                    </div>
                    @foreach($skillSet->skills as $skill)
                        <div class="skill col s12 m12 l6">
                            <div class="row">
                                <div class="row">
                                    <div class="col s8 valign-wrapper">
                                        <i class="{{$skill->icon_class}} skill_icon">{{$skill->icon_content}}</i>
                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                        <span class="skill_name">{{$skill->name}}</span>
                                    </div>
                                    <div class="col s4 right-align">
                                    <span class="skill_experience waves-effect">{{$skill->experience}}
                                        @if($skill->experience<=1)
                                            year
                                        @else
                                            years
                                        @endif
                                    </span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col s12">
                                        <div class="progress skill_level_wrapper">
                                            <div class="determinate skill_level" style="width: {{$skill->level}}%"
                                                 skill-level="{{$skill->level}}%"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
        <div class="footer center-align">
            @component('components.mouseyscroller')
            @endcomponent
        </div>
    </div>
@endsection

@section("content_object_".$sectionData['projects']->id)
    <div class="section_data">
        <div class="row">
            <div class="col s12">
                <div class="subtitle_wrapper">
                    <span class="subtitle">Projects</span>
                </div>
            </div>
        </div>
        <div class="row filter_wrapper">
            <span class="filter active" projecttype="all" onclick="filterProjects('all')">All</span>
            @foreach($sectionData['projects']->section_data[0]->projectTypes as $projectType)
                <span class="filter" projecttype="{{$projectType->type}}"
                      onclick="filterProjects('{{$projectType->type}}')">{{$projectType->name}}</span>
            @endforeach
        </div>
        {{--<div class="divider"></div>--}}
        <div class="projects_wrapper">
            <div class="row expand expand_vertical valign">
                {{--<div class="carousel expand_vertical">--}}
                <div class="row">
                    @foreach($sectionData['projects']->section_data[0]->projects as $project)
                        <div class="project_item col s12 m6 l4 @foreach($project->types as $projectType)type_{{$projectType->type}} @endforeach"
                             projectid="{{$project->id}}" onclick="showProjectInfo('{{$project->id}}')">
                            <div class="project">
                                <div class="project_image_wrapper row center-align">
                                    <div class="project_image" style="background-image: url('{{$project->img_path}}')">
                                    </div>
                                    <div class="project_types_container">
                                        @foreach($project->types as $projectType)
                                            <i class="material-icons tooltipped" data-position="below"
                                               data-tooltip="{{$projectType->name}}">{{$projectType->icon}}</i>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="row project_title_wrapper">
                                    <span class="project_title">{{$project->title}}</span>
                                </div>
                                <div class="row project_description_wrapper hide">
                                    <span class="project_description">{{$project->description}}</span>
                                </div>
                                <div class="row more_details_wrapper right-align hide">
                                    <span class="more_details">More Details...</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{--<div class="row more_details_wrapper right-align">
                    <a class="more_details">More Details...</a>
                </div>--}}
            </div>

            {{--Project Infos--}}
            <div id="project_infos_container" class="project_infos_container">
                @foreach($sectionData['projects']->section_data[0]->projects as $project)
                    <div class="project_info_wrapper" projectid="{{$project->id}}">
                        <h4>{{$project->title}}</h4>
                        @if(View::exists('include.project_infos.'.$project->id))
                            @include('include.project_infos.'.$project->id, ['project' => $project])
                        @else
                            @include('include.project_infos.dummy', ['project' => $project])
                        @endif
                    </div>
                @endforeach
            </div>

            <div id="project-viewer-modal" class="modal">
                <div class="modal-content">

                </div>
                <div class="modal-footer">
                    <a href="#!" class="modal-action modal-close waves-effect waves-red btn-flat red-text">Close</a>
                </div>
            </div>

        </div>
        <div class="footer center-align">
            @component('components.mouseyscroller')
            @endcomponent
        </div>
    </div>
@endsection

@section("content_object_".$sectionData['contact_me']->id)
    <div class="section_data">
        <div class="row">
            <div class="col s12">
                <div class="subtitle_wrapper">
                    <span class="subtitle">Contact Me</span>
                </div>
            </div>
        </div>
        {{--<div class="divider"></div>--}}
        <div class="contact_me_wrapper">
            <div class="row">
                <div class="contact_items_wrapper expand">
                    <a href="https://www.linkedin.com/in/aziztitu-murugan/" target="_blank"
                       class="contact_item social_media">
                        <span class="mdi mdi-linkedin mdi-36px"></span>
                    </a>
                    <a href="https://www.facebook.com/aziz.titu.5" target="_blank" class="contact_item social_media">
                        <span class="mdi mdi-facebook mdi-36px"></span>
                    </a>
                    <a href="https://github.com/AzeeSoft" target="_blank" class="contact_item social_media">
                        <span class="mdi mdi-github-circle mdi-36px"></span>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="contact_items_wrapper expand">
                    <div class="contact_item">
                        <span><i class="material-icons left">phone</i>{{$sectionData['contact_me']->section_data->phone}}</span>
                    </div>
                    <div class="contact_item">
                        <span><i class="material-icons left">email</i>{{$sectionData['contact_me']->section_data->email}}</span>
                    </div>
                    {{--<div class="contact_item">
                        <span><i class="material-icons left">location_on</i>{{$sectionData['contact_me']->section_data->address}}</span>
                    </div>--}}
                </div>
            </div>

            <div class="row">
                <div class="send_message_wrapper expand">
                    <div class="row title">
                        Leave me a message
                    </div>
                    <div class="row send_message_content">
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="name" type="text" name="name" class="validate">
                                <label for="name">Name</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="email" type="email" name="email" class="validate">
                                <label for="email">Email</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="subject" type="text" name="subject" class="validate">
                                <label for="subject">Subject</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <textarea id="message" name="message" class="materialize-textarea"></textarea>
                                <label for="message">Message</label>
                            </div>
                        </div>
                        <div class="row center-align">
                            <button class="btn send_msg_btn white-text waves-effect" onclick="sendMessage()">Send
                                Message
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer center-align">
            @component('components.mouseyscroller')
            @endcomponent
        </div>
    </div>
@endsection

@section("content_object_".$sectionData['resume']->id)
    <div class="section_data valign-wrapper">
        <div class="row resume_wrapper expand">
            <div class="expand center-align">
                <a href="{{$sectionData['resume']->section_data->resumeURL}}" target="_blank"
                   class="btn waves-effect view_download">View / Download
                    Resume</a>
            </div>
        </div>
        <div class="footer center-align">
            <div class="info">
                <span id="designed_by" class="designed_by">Designed by Azee</span>
            </div>
        </div>
    </div>
@endsection

@section("project_infos")
    @foreach($sectionData['projects']->section_data[0]->projects as $project)

    @endforeach
@endsection