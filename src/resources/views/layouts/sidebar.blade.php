<!-- Sidenav -->
<nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
        <!-- Brand -->
        <div class="sidenav-header  align-items-center">
            <a class="navbar-brand" href="{{url(config('dashboard.dashboard_url'))}}">
                <img src="{{asset('vendor/dashboard/img/brand/blue.png')}}" class="navbar-brand-img" alt="...">
            </a>
        </div>
        <div class="navbar-inner">
            <!-- Collapse -->
            <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                <!-- Nav items -->
                <ul class="navbar-nav">

                  @stack('sidebar')

                </ul>
{{--                <!-- Divider -->--}}
{{--                <hr class="my-3">--}}
{{--                <!-- Heading -->--}}
{{--                <h6 class="navbar-heading p-0 text-muted">--}}
{{--                    <span class="docs-normal">Documentation</span>--}}
{{--                </h6>--}}
{{--                <!-- Navigation -->--}}
{{--                <ul class="navbar-nav mb-md-3">--}}
{{--                    <li class="nav-item">--}}
{{--                        <a class="nav-link" href="https://demos.creative-tim.com/argon-dashboard/docs/getting-started/overview.html" target="_blank">--}}
{{--                            <i class="ni ni-spaceship"></i>--}}
{{--                            <span class="nav-link-text">Getting started</span>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item">--}}
{{--                        <a class="nav-link" href="https://demos.creative-tim.com/argon-dashboard/docs/foundation/colors.html" target="_blank">--}}
{{--                            <i class="ni ni-palette"></i>--}}
{{--                            <span class="nav-link-text">Foundation</span>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                </ul>--}}
            </div>
        </div>
    </div>
</nav>
<!-- Main content -->
