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
    Project info will be added soon
</p>
@endslot

@slot('projectDetails')

@endslot

@slot('projectLinks')

@endslot

@endcomponent