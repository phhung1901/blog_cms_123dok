
<!DOCTYPE html>
<html lang="en">

@include('admin.layout.header')

<body class="hold-transition sidebar-mini">
<div class="wrapper">

    @include("admin.layout.main_header")


    @include("admin.layout.sidebar")

    @yield("admin.content")

    <footer class="main-footer">
        <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 3.2.0
        </div>
    </footer>

</div>

@include('admin.layout.footer')

</body>
</html>
