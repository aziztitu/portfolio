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
    <b>Seamless VNC</b> is a <b>VNC Client</b> that is integrated with <b>Tight VNC</b> and provides <b>multiple server
        management</b>. The user can <b>define and store multiple VNC Server configurations</b> and can connect to them
    as and when needed with just a click. It also adds a <b>few custom features on top of Tight VNC</b>.
</p>
@endslot

@slot('projectDetails')
<ul>
    <li>
        I developed this tool in <b>2017</b> using <b>JavaFX</b> to enable remote desktop management in <a
                onclick="showProjectInfo('seamless_pos')">Seamless POS</a>.
        <ul>
            <li>
                <span class="name">Languages Used:</span>
                <span class="value">Java, CSS</span>
            </li>
            <li>
                <span class="name">Platforms/Libraries:</span>
                <span class="value">JavaFX, Tight VNC, Git</span>
            </li>
        </ul>
    </li>
</ul>
@endslot

@slot('projectLinks')

@endslot

@endcomponent