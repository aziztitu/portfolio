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
    <b>Repulse</b> is a <b>2D side scroller game</b> where the player uses <b>brain waves and telekinetic abilities</b>
    to <b>control objects and overcome the obstacles</b> in the way. The <b>goal is to get to the teleportation pad</b>
    as fast as possible and you WIN.. Watch out for the spikes!!!
</p>
@endslot

@slot('projectDetails')
<ul>
    <li>
        I worked on this game with 8 other people for 3 days during the <b>Global Game Jam 2017</b>. It was my first
        ever Game Jam.
    </li>
    <li>
        I was the <b>Lead Programmer</b> for the game, and I worked on <b>Player Mechanics, AI and Environment
            Interactions</b>.
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
        GitHub Link: <a href="https://github.com/AzeeSoft/Repulse-GGJ17" target="_blank">Repulse-GGJ17</a>
    </li>
    <li>
        Global Game Jam Link: <a href="https://globalgamejam.org/2017/games/repulse" target="_blank">Repulse</a>
    </li>
</ul>
@endslot

@endcomponent