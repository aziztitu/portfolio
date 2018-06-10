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
    <b>AZMAP Generator</b> is a small tool that <b>extracts data from KML files</b> which are exported from <b>Google
        Maps</b> and adds extra info such as <b>the name, description, rooms, and images</b> of all the locations and
    <b>exports them all in a single JSON file (with extension .azmap)</b>. This JSON file is then imported into other applications to display
    the data on the map.
</p>
@endslot

@slot('projectDetails')
<ul>
    <li>
        I developed this tool using <b>JavaFX</b> in 2017 while working on the <a
                onclick="showProjectInfo('sau_honors_app')">Honors College App</a> for the University.
    </li>
    <li>
        While working on that app, I needed the map data to include custom data such as building description, room info,
        and custom images. And hence, I ended up writing this tool to embed additional data to the KML data exported
        from Google Maps.
        <ul>
            <li>
                <span class="name">Languages Used:</span>
                <span class="value">Java, CSS</span>
            </li>
            <li>
                <span class="name">Platforms/Libraries:</span>
                <span class="value">JavaFX, Google Maps, Git</span>
            </li>
        </ul>
    </li>
</ul>
@endslot

@slot('projectLinks')
<ul>
    <li>
        GitHub Link: <a href="https://github.com/AzeeSoft/AZMAP-Generator" target="_blank">AZMAP Generator</a>
    </li>
</ul>
@endslot

@endcomponent