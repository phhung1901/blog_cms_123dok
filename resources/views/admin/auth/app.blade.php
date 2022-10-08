<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <link rel="stylesheet" href="{{asset('assets_admin/plugins/fontawesome-free/css/all.min.css')}}">

    <link rel="stylesheet" href="{{asset('assets_admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">

    <link rel="stylesheet" href="{{asset('assets_admin/css/adminlte.min.css')}}">
<body class="hold-transition login-page">

@yield('content')

<script src="{{asset("assets_admin/plugins/jquery/jquery.min.js")}}"></script>
<script src="{{asset("assets_admin/plugins/bootstrap/js/bootstrap.bundle.min.js")}}"></script>
<script src="{{asset('assets_admin/js/adminlte.min.js')}}"></script>
</body>
</html>