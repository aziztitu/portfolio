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
    The <b>Mini Robot</b> can be controlled via a the <b>Mini Robot App</b> on a phone or on a computer. The Mini Robot
    can also <b>stream live video, play songs/videos, talk in different languages</b>, and more..
</p>
@endslot

@slot('projectDetails')
<ul>
    <li>
        I created the <b>Mini Robot</b> during my summer vacation in <b>2017</b> using an <b>Arduino Board</b>.
    </li>
    <li>
        This was my <b>first time working with Arduino</b> and I found it very challenging.
        <ul>
            <li>
                For Battery, I <b>started off with a portable phone battery</b>, but later <b>moved on to a 6V Alkaline
                    Battery</b> for better performance of the motors.
            </li>
            <li>
                For Communication, I used a <b>Bluetooth Module HC-05</b>, but once <b>I placed an old phone on the
                    robot</b>, I wrote a small app that also allowed me to <b>control the robot via WiFi using
                    Sockets</b>.
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
        </ul>
    </li>
    <li>
        I placed an old <b>Android phone</b> on the robot, and <b>connected it to the Arduino board</b>. I wrote an app
        which <b>allowed the phone to stream live video</b> to the user, <b>play different types of media</b>, <b>talk
            different languages</b>, <b>take pictures</b>, <b>record audio</b>, etc..
        <ul>
            <li>
                <span class="name">Languages Used:</span>
                <span class="value">Java, CSS</span>
            </li>
            <li>
                <span class="name">Platforms/Libraries:</span>
                <span class="value">Android, Android Studio, LibStreaming, </span>
            </li>
        </ul>
    </li>
    <li>
        I wrote the <b>Android & Desktop apps</b> which could be used to <b>drive the robot around via
            Bluetooth/WiFi</b>. The app also <b>displays the live stream</b> from the robot, and has <b>options to
            perform various actions on the robot</b>.
        <ul>
            <li>
                <span class="name">Languages Used:</span>
                <span class="value">Java, CSS</span>
            </li>
            <li>
                <span class="name">Platforms/Libraries:</span>
                <span class="value">Android, Android Studio</span>
            </li>
        </ul>
    </li>
</ul>
@endslot

@slot('projectLinks')

@endslot

@endcomponent