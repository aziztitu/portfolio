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
    <b>Seamless POS</b> is an <b>online Point-of-Sale system</b> that comes with a wide range of built-in features,
    including a
    complete stand-alone POS, Back Office Management, Inventory Tracking & Management, Vendor Catalog Management,
    Lottery Support, Restaurant Support, and Cash Flow Verification. The system is also capable of generating various
    reports including Daily Transaction, Cash Flow, Shrinkage, Forecast, Inventory, Short/Over, Profit & Loss, and
    Duplicate Entries.
</p>
@endslot

@slot('projectDetails')
<ul>
    <li>
        I started working on this app in <b>2017</b> when I joined a team of 3 people who were already working on this
        app for a few years. The app is in testing stage, and should be ready to launch next year.
    </li>
    <li>
        I developed a <b>Browser</b> in C# on top of the <b>CefSharp(Chromium) library</b>, and it is used to launch the
        entire POS web app, and provides a lot of native functionality to the web app, including <b>communication with
            POS devices like Weighing Machine, Scanner,</b> etc.. I also developed a <b>Silent Printer</b> in
        <b>Java</b> that <b>bypasses the default browser print dialog</b>.
        <ul>
            <li>
                <span class="name">Languages Used:</span>
                <span class="value">C#, Java</span>
            </li>
            <li>
                <span class="name">Platforms/Libraries:</span>
                <span class="value">.Net, WPF, OPOS SDK, CefSharp, JavaFX, Git</span>
            </li>
        </ul>
    </li>
    <li>
        I also developed an <b>Android app</b> that allows the business owners to <b>view/manage the entire POS
            system</b> from their phones. It also provides <b>Fingerprint Authentication</b>, and <b>Barcode
            Scanning</b> capabilities.
        <ul>
            <li>
                <span class="name">Languages Used:</span>
                <span class="value">Java, XML</span>
            </li>
            <li>
                <span class="name">Platforms/Libraries:</span>
                <span class="value">Android, Android Studio, Git</span>
            </li>
        </ul>
    </li>
    <li>
        I provided some <b>bug fixes</b> and <b>performance boosts in the back end</b> by implementing
        <b>Asynchronous Requests</b> throughout the web app, and <b>improving the database structure and database
            queries.</b>
        <ul>
            <li>
                <span class="name">Languages Used:</span>
                <span class="value">PHP, JavaScript, MySQL</span>
            </li>
        </ul>
    </li>
</ul>
@endslot

@slot('projectLinks')

@endslot

@endcomponent