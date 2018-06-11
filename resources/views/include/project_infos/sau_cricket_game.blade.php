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
    This is a <b>Mini Cricket Game</b> that I created for the <b>Southern Arkansas University</b>. The game offers both
    <b>Batting and Bowling Game modes</b>, and a <b>complete Cricket Match</b>.
</p>
@endslot

@slot('projectDetails')
<ul>
    <li>
        I worked on this game in <b>2017</b> during the Summer for an elective.
    </li>
    <li>
        I was the only one working on the game, and I was more <b>focused on the Programming Side of the game</b>, and
        hence the art for the game is unfinished.

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

@endslot

@endcomponent