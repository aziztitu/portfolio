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
    <b>Pecky the Woodpecker</b> is a <b>2D Mario-styled side-scrolling game</b> where the player is a Woodpecker.
</p>
@endslot

@slot('projectDetails')
<ul>
    <li>
        I worked on this game with 2 other people during a <b>Game Jam at Bossier in 2017</b>.
    </li>
    <li>
        I worked on <b>Player Controller, AI, Level Design, and Game States</b>.
        <ul>
            <li>
                <span class="name">Languages Used:</span>
                <span class="value">C#</span>
            </li>
            <li>
                <span class="name">Platforms/Libraries:</span>
                <span class="value">Unity</span>
            </li>
        </ul>
    </li>
</ul>
@endslot

@slot('projectLinks')
<ul>
    <li>
        GitHub Link: <a href="https://github.com/AzeeSoft/gamejam-bossier-2k17" target="_blank">Pecky The Woodpecker</a>
    </li>
</ul>
@endslot

@endcomponent