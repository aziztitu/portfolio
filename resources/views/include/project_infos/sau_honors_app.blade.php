@php
    /**
     * Created by PhpStorm.
     * User: azizt
     * Date: 9/20/2017
     * Time: 10:40 AM
     */
@endphp

@component('components.project_info', ['project' => $project])

@slot('projectDescription')
<p>
    <b>SAU Honors College App</b> is a simple application that allows the user to <b>discover more about Southern
        Arkansas University and it's Honors Program</b> in particular. It also <b>includes a Map of the University</b>
    that displays information about all the locations on campus.
</p>
@endslot

@slot('projectDetails')
<ul>
    <li>
        I worked on the <b>Android</b> version of this app in <b>2017</b> with another team member who developed an iOS
        version for it. I also developed the <a onclick="showProjectInfo('azmap_generator')">AZMAP Generator</a> which converts KML files from Google Maps into AZMAP
        files which contain custom data including images.
        <ul>
            <li>
                <span class="name">Languages Used:</span>
                <span class="value">Java, XML</span>
            </li>
            <li>
                <span class="name">Platforms/Libraries:</span>
                <span class="value">Android, Android Studio, Google Maps API, Git</span>
            </li>
        </ul>
    </li>
</ul>
@endslot

@slot('projectLinks')

@endslot

@endcomponent