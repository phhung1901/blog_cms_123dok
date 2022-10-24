<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.inc.head')
</head>

<body class="hold-transition sidebar-mini">
<div class="wrapper">

    @include("admin.inc.main_header")


    @include("admin.inc.sidebar")

    @yield("admin.content")

    @include("admin.inc.footer")


</div>

@include('admin.inc.script')

</body>
</html>
