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
    <b>DDNS Updater</b> is a tool that <b>updates a record of the public ip</b> of the device periodically, which in
    turn is used to <b>redirect requests to the right ip address on the internet</b>. This is useful for a server which
    doesn't have a static ip.
</p>
@endslot

@slot('projectDetails')
<ul>
    <li>
        I worked on this tool in <b>2017</b> while working on <a onclick="showProjectInfo('seamless_pos')">Seamless
            POS</a>.
    </li>
    <li>
        I developed <b>Android & Desktop apps</b> using <b>Android SDK & JavaFX</b> which sent the public ip of the
        device along with a device id periodically to an online server.
        <ul>
            <li>
                <span class="name">Languages Used:</span>
                <span class="value">Java, CSS, XML</span>
            </li>
            <li>
                <span class="name">Platforms/Libraries:</span>
                <span class="value">Android, Android Studio, JavaFX, Git</span>
            </li>
        </ul>
    </li>
    <li>
        I also wrote the <b>backend scripts</b> in <b>PHP</b> to accept the requests from the clients and <b>update
            the public ip record of each device</b> in the database, and to <b>redirect the requests to the right public
            ip based on a device id</b>.
        <ul>
            <li>
                <span class="name">Languages Used:</span>
                <span class="value">PHP</span>
            </li>
            <li>
                <span class="name">Platforms/Libraries:</span>
                <span class="value">Apache, cURL, MySQL</span>
            </li>
        </ul>
    </li>
</ul>
@endslot

@slot('projectLinks')

@endslot

@endcomponent