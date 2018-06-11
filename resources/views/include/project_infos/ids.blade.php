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
    <b>Intrusion Detection System</b> is a <b>security tool</b> which <b>captures all the packets on a given network
        adapter</b> and <b>looks for any intrusion</b> and reports to the user. The tool also <b>dumps the captured
        packets</b> to a separate file so it can be reviewed later if needed.
</p>
@endslot

@slot('projectDetails')
<ul>
    <li>
        I wrote this tool for a <b>College Project</b> in <b>2017</b> in <b>Java</b> using the <b>JNetPCap Library</b>.
    </li>
    <li>
        As of now, this tool <b>detects SSL Stripping</b> from well known IPs, but I plan to add more detection features
        in the future.
        <ul>
            <li>
                <span class="name">Languages Used:</span>
                <span class="value">Java, CSS</span>
            </li>
            <li>
                <span class="name">Platforms/Libraries:</span>
                <span class="value">JavaFX, JNetPCap Library, Git</span>
            </li>
        </ul>
    </li>
</ul>
@endslot

@slot('projectLinks')
<ul>
    <li>
        GitHub Link: <a href="https://github.com/AzeeSoft/Intrusion-Detection-System" target="_blank">Intrusion
            Detection System</a>
    </li>
</ul>
@endslot

@endcomponent