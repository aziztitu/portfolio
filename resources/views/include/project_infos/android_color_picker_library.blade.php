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
    <b>Android Color Picker</b> is an <b>Open Source Library</b> that can be used to show a <b>Photoshop-like Color
        Picker</b> in any android app with just a few lines of code. It allows the user to select any color by dragging
    the Saturation/Value box or Hue/Alpha sliders or editing the numbers directly. It also has the option to remember
    the previously selected color and show the difference while the color is being picked.
</p>
@endslot

@slot('projectDetails')
<ul>
    <li>
        I wrote this Color Picker Library in <b>2016</b> and this was <b>my first Open Source Library</b>.
        <ul>
            <li>
                <span class="name">Languages Used:</span>
                <span class="value">Java, XML</span>
            </li>
            <li>
                <span class="name">Platforms/Libraries:</span>
                <span class="value">Android, Android Studio, BinTray, Git</span>
            </li>
        </ul>
    </li>
</ul>
@endslot

@slot('projectLinks')
<ul>
    <li>
        GitHub Link: <a href="https://github.com/AzeeSoft/AndroidPhotoshopColorPicker" target="_blank">Android Photoshop Color Picker</a>
    </li>
</ul>
@endslot

@endcomponent