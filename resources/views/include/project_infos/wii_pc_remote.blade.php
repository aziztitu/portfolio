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
    <b>Wii PC Remote</b> is a <b>Desktop App</b> that allows the user to control the computer using a Wii Remote.
</p>
@endslot

@slot('projectDetails')
<ul>
    <li>
        I started working on this app as an experiment in <b>2015</b> using <b>Java</b>.
    </li>
    <li>
        I used <b>Bluetooth</b> to receive signals from the Wii Remote, and I decoded those signals to perform various
        actions such as <b>moving the mouse cursor, emulate mouse clicks, emulate keyboard shortcuts</b>, etc..

        <ul>
            <li>
                <span class="name">Languages Used:</span>
                <span class="value">Java</span>
            </li>
            <li>
                <span class="name">Platforms/Libraries:</span>
                <span class="value">WiiUseJ Library</span>
            </li>
        </ul>
    </li>
</ul>
@endslot

@slot('projectLinks')

@endslot

@endcomponent