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
    <b>Chit Chat</b> is a <b>P2P chat application</b> with <b>AES encrypted messages</b> that works <b>on a local
        network</b>. It also <b>supports group
        chat</b>.
</p>
@endslot

@slot('projectDetails')
<ul>
    <li>
        I worked on this app in <b>2016</b> to practice my skills on Network Programming.
    </li>
    <li>
        I wrote the application in <b>Java</b> and <b>used Sockets</b> to communicate between devices.
    </li>
    <li>
        I also used <b>AES</b> to <b>encrypt the messages</b> sent from one device to another.
        <ul>
            <li>
                <span class="name">Languages Used:</span>
                <span class="value">Java, CSS</span>
            </li>
            <li>
                <span class="name">Platforms/Libraries:</span>
                <span class="value">JavaFX, Git</span>
            </li>
        </ul>
    </li>
</ul>
@endslot

@slot('projectLinks')
<ul>
    <li>
        GitHub Link: <a href="https://github.com/AzeeSoft/ChitChat" target="_blank">Chit Chat</a>
    </li>
</ul>
@endslot

@endcomponent