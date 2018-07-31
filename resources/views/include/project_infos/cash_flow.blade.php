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
    <b>Cash Flow</b> is a <b>2D top down game</b> where <b>the player runs around the city collecting coins and avoiding
        thieves</b>.
</p>
@endslot

@slot('projectDetails')
<ul>
    <li>
        I worked on this game with 3 other people in the Game Development Club at SAU.
    </li>
    <li>
        I worked on <b>AI, Level Design, Lighting, and Camera</b>.
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
        GitHub Link: <a href="https://github.com/AzeeSoft/CashFlow" target="_blank">Cash Flow</a>
    </li>
</ul>
@endslot

@endcomponent