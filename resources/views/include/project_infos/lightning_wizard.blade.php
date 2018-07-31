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
    <b>Lightning Wizard</b> is a <b>3D third person action game</b> where the player is a <b>Mage</b> and <b>uses
        lightning powers to teleport to places and attack enemies.</b> The <b>goal is to destroy the enemies and escape
        the temple.</b>
</p>
@endslot

@slot('projectDetails')
<ul>
    <li>
        I worked on this game with 7 other people for 3 days during the <b>Global Game Jam 2018</b>.
    </li>
    <li>
        I worked on <b>AI, Lightning teleportation, and Cameras</b>.
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
        GitHub Link: <a href="https://github.com/AzeeSoft/TheLightningWizard-GGJ2K18" target="_blank">TheLightningWizard-GGJ2K18</a>
    </li>
    <li>
        Global Game Jam Link: <a href="https://globalgamejam.org/2018/games/lightning-wizard" target="_blank">Lightning Wizard</a>
    </li>
</ul>
@endslot

@endcomponent