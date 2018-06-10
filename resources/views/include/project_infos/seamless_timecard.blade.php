@php
    /**
     * Created by PhpStorm.
     * User: azizt
     * Date: 9/20/2017
     * Time: 9:20 AM
     */
@endphp

@component('components.project_info', ['project' => $project])

@slot('projectDescription')
<p>
    <b>Seamless Timecard</b> is a cloud based employee time tracking & management system. It helps employers to
    create schedules in minutes, track employee work hours in real-time,
    and generate the payroll in an instant. It also allows the employees to clock in/out using their fingerprints
    and apply for leave right from the app. It basically makes employee management a breeze.
</p>
@endslot

@slot('projectDetails')
<ul>
    <li>
        I started working on this app in my free time in late <b>2015</b>, and we now have a few clients using our
        product, and we are planning on expanding the app further soon.
    </li>
    <li>
        I developed the <b>Web App</b> which includes the <b>Product Pages, Employer/Manager Dashboard, Admin Panel and
            an internal API.</b>
        <ul>
            <li>
                <span class="name">Languages Used:</span>
                <span class="value">PHP, JavaScript (TypeScript), MySQL, HTML, SCSS</span>
            </li>
            <li>
                <span class="name">Platforms/Libraries:</span>
                <span class="value">Apache, Laravel, npm, Webpack, Amazon Lightsail, Git</span>
            </li>
        </ul>
    </li>
    <li>
        I also developed the <b>Android & Windows apps</b> which are used as <b>Kiosk devices</b> for the employees to
        clock in/out, apply for leave, apply for time correction, and more.
        <ul>
            <li>
                <span class="name">Languages Used:</span>
                <span class="value">Java, CSS, XML</span>
            </li>
            <li>
                <span class="name">Platforms/Libraries:</span>
                <span class="value">Android, Android Studio, JavaFX, DigitalPersona SDK, Git</span>
            </li>
        </ul>
    </li>
</ul>
@endslot

@slot('projectLinks')
<ul>
    <li>
        Product Website: <a href="https://seamlesstimecard.com" target="_blank">seamlesstimecard.com</a>
    </li>
</ul>
@endslot

@endcomponent