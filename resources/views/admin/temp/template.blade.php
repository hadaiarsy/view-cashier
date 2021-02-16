<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>@yield('site-title')</title>
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="This is an example dashboard created using build-in elements and components.">
    <meta name="msapplication-tap-highlight" content="no">
    <!--
    =========================================================
    * ArchitectUI HTML Theme Dashboard - v1.0.0
    =========================================================
    * Product Page: https://dashboardpack.com
    * Copyright 2019 DashboardPack (https://dashboardpack.com)
    * Licensed under MIT (https://github.com/DashboardPack/architectui-html-theme-free/blob/master/LICENSE)
    =========================================================
    * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
    -->
    <link href="{{ asset('assets/vendor/architectui/main.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app-container" class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">

        {{-- navbar --}}
        @include('admin.temp.navbar')

        {{-- setting float button --}}
        @include('admin.temp.setfloat')

        <div class="app-main">

            {{-- sidebar --}}
            @include('admin.temp.sidebar')

            <div class="app-main__outer">

                {{-- main content --}}
                <div class="app-main__inner">
                    @yield('main-contents')
                </div>

                {{-- footer --}}
                <div class="app-wrapper-footer">
                    <div class="app-footer">
                        <div class="app-footer__inner">
                            <div class="app-footer-left">
                            </div>
                            <div class="app-footer-right">
                                <ul class="nav">
                                    <li class="nav-item">
                                        <a href="javascript:void(0);" class="nav-link">
                                            Footer Link 3
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="javascript:void(0);" class="nav-link">
                                            <div class="badge badge-success mr-1 ml-0">
                                                <small>NEW</small>
                                            </div>
                                            Footer Link 4
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
        </div>
    </div>
    <script type="text/javascript" src="{{ asset('assets/vendor/architectui/assets/scripts/main.js') }}"></script>
    <script>
        function currentTime() {
            var date = new Date();
            var day = date.getDay();
            var hour = date.getHours();
            var min = date.getMinutes();
            var sec = date.getSeconds();
            day = updateDay(day);
            hour = updateTime(hour);
            min = updateTime(min);
            sec = updateTime(sec);
            document.getElementById("clockZone").innerText = hour + " : " + min + " : " +
                sec + " - " + day;
            var t = setTimeout(function() {
                currentTime()
            }, 1000);
        }

        function updateTime(k) {
            if (k < 10) {
                return "0" + k;
            } else {
                return k;
            }
        }

        function updateDay(k) {
            let dayName = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
            return dayName[(Number(k) - 1)];
        }

        currentTime();

    </script>
</body>

</html>
