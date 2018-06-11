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
    <b>Floating Web Browser</b> is a simple Web Browser built on top of <b>Chromium</b>, which can be <b>minimized
        into a small floating icon</b> on the screen that can be moved around, and upon clicking, it expands into a
    complete web browser. The tool is aimed to <b>improve productivity</b>.
</p>
@endslot

@slot('projectDetails')
<ul>
    <li>
        I developed this app using <b>JavaFX</b> on top of the <b>JCEF (Chromium) library</b> in <b>2016</b>. The biggest
        challenge was to get the chromium working with JavaFX (without crashes!).
        <ul>
            <li>
                <span class="name">Languages Used:</span>
                <span class="value">Java, CSS</span>
            </li>
            <li>
                <span class="name">Platforms/Libraries:</span>
                <span class="value">JavaFX, JCEF, Git</span>
            </li>
        </ul>
    </li>
</ul>
@endslot

@slot('projectLinks')
<ul>
    <li>
        GitHub Link: <a href="https://github.com/AzeeSoft/Floating-Web-Browser" target="_blank">Floating Web Browser</a>
    </li>
</ul>
@endslot

@endcomponent