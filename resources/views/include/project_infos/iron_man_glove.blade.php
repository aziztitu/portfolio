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
    <b>Iron Man Glove</b> is basically a <b>Glove that has a lot of Motion Sensors</b> attached to it. When the user
    moves the hand/fingers, the data from the motion sensors is used to detect those movements.
</p>
@endslot

@slot('projectDetails')
<ul>
    <li>
        I worked on this project in the summer of <b>2017</b> after finishing the <a
                onclick="showProjectInfo('mini_robot')">Mini Robot</a> project.
    </li>
    <li>
        I used an <b>Arduino</b> board and attached a <b>6-axis motion sensor on each finger segment</b> on the glove.

        <ul>
            <li>
                <span class="name">Languages Used:</span>
                <span class="value">C++</span>
            </li>
            <li>
                <span class="name">Platforms/Libraries:</span>
                <span class="value">Arduino</span>
            </li>
        </ul>
    </li>
    <li>
        I wrote a small <b>Simulator in Unity</b> that <b>displays the motion of the hand and each finger segment</b> in
        real time. I plan to add gesture detection in the future.

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