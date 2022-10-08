
<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.inc.head')
</head>

<body class="sidebar-mini layout-fixed" style="height: auto;">
<div class="wrapper">
    @include('admin.inc.main_header')
    @include('admin.inc.sidebar')

    <div class="content-wrapper">

        {{--        @yield('before_breadcrumbs_widgets')--}}

        {{--        @includeWhen(isset($breadcrumbs), 'admin.includes.breadcrumbs')--}}

        {{--        @yield('after_breadcrumbs_widgets')--}}

        <section class="content-header">
            @yield('header')
        </section>

        <section class="content">
            <div class="container-fluid">

                @yield('before_content_widgets')

                @yield('content')

                @yield('after_content_widgets')

            </div>
        </section>
    </div>
</div>

@include('admin.inc.footer')

@include('admin.inc.scripts')
</body>
</html>
