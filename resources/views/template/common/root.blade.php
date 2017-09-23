<?php
/**
 * Created by PhpStorm.
 * User: azizt
 * Date: 8/25/2017
 * Time: 9:48 PM
 */
?>
        <!doctype html>
<html>
<head>
    @section('head')
        @include('include.common.metadata')
        @include('include.common.fonts')
        @include('include.common.stylesheets')
        @include('include.common.jsbinder')
        @include('include.common.scripts')
    @show

    <title>@yield('title')</title>
</head>
<body class="materialize">
@yield('body')
</body>
</html>
