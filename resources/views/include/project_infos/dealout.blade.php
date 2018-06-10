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
    <b>DealOut</b> is a Greek app that shows various offers/deals that are available near the user's location. The user
    is also able to get a limited number of coupon codes per day. The app is only available in Greece.
</p>
@endslot

@slot('projectDetails')
<ul>
    <li>
        I worked on DealOut in <b>2015</b> as a <b>freelancer</b>.
    </li>
    <li>
        I was in a <b>team of 3</b> people and I developed the <b>Android app</b> which allows the users to <b>view the deals near them</b>,
        and <b>get the codes</b>. The app also <b>shows the businesses around the user in a map</b>.
        <ul>
            <li>
                <span class="name">Languages Used:</span>
                <span class="value">Java, XML</span>
            </li>
            <li>
                <span class="name">Platforms/Libraries:</span>
                <span class="value">Android, Android Studio, Google Maps API, Volley, Facebook Login API</span>
            </li>
        </ul>
    </li>
</ul>
@endslot

@slot('projectLinks')
<ul>
    <li>Product Website: <a href="http://dealout.gr/" target="_blank">dealout.gr</a></li>
    <li>Play Store Link: <a href="https://play.google.com/store/apps/details?id=com.mumtaziz.dealout&hl=en" target="_blank">Dealout Android App</a></li>
</ul>
@endslot

@endcomponent