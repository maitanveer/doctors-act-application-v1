<header class="header">

    <div class="topbar">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 col-md-10 col-12">
                    <ul class="top-contact">
                        <li><a href="tel:2818487979"><i class="fa fa-phone"></i>(281) 848-7979</a></li>
                        <li><a href="tel:2819777470"><i class="fa fa-phone"></i>(281) 977-7470 (Behavioral Health)</a>
                        </li>
                        <li><i class="fa fa-envelope"></i><a
                                href="mailto:info@ibnsinafoundation.org">info@ibnsinafoundation.org</a></li>

                        <li><a class="btn btn-info" href="{{ route('application') }}">Apply Now</a></li>
                    </ul>

                </div>
                <div class="col-lg-2 col-md-2 col-12 ">
                    <div id="google_translate_element" class="google_translate_element"></div>

                    <script type="text/javascript" src="js/element.js"></script>
                    <script type="text/javascript">
                        async function parentFunct() {
                            loadScriptFromUrl = await

                            function(url) {
                                return new Promise((resolve, reject) => {
                                    googleTranslateElementInit();
                                })
                            };
                        }

                        function googleTranslateElementInit() {
                            new google.translate.TranslateElement({
                                    pageLanguage: 'en'
                                },
                                'google_translate_element'
                            );
                        }
                        /*setTimeout(function() {
                            googleTranslateElementInit();
                        }, 2000);*/
                    </script>

                </div>

            </div>
        </div>
    </div>
    <!-- End Topbar -->

    <!-- End Middle Header -->
    <div class="header-inner">
        <div class="container">
            <div class="inner">
                <!--Announcements-->
                <div class="row">
                    <div class="col-lg-2 col-md-3 col-12">
                        <!-- Start Logo -->
                        <div class="logo text-center">
                            <a href="{{ route('home') }}">
                                <img style="max-width: 12rem;"
                                    src="{{ asset('images/Avicena Clincas Logo_Transparent.svg') }}"
                                    alt="Avicenna Clinics">
                            </a>
                        </div>
                        <!-- End Logo -->
                        <!-- Mobile Nav -->
                        <div class="mobile-nav"></div>
                        <!-- End Mobile Nav -->
                    </div>
                    <div class="col-lg-8 col-md-9 col-12">
                        <!-- Main Menu -->
                        <div class="main-menu" id="mobileMenu">
                            <nav class="navigation">
                                <ul class="nav menu">
                                    <li><a href="{{ route('home') }}">Home</a></li>
                                    <li><a href="{{ route('doc-act') }}">Doctors Act Pathway</a></li>
                                    <li><a href="{{ route('application') }}">Application</a></li>
                                    @guest
                                        <li><a href="{{ route('login') }}">Sign In</a></li>
                                        <li><a href="{{ route('register') }}">Register</a></li>
                                    @else
                                        @if(auth()->user()->role === 'user')
                                            <li><a href="{{ route('user.dashboard') }}">My Dashboard</a></li>
                                        @elseif(in_array(auth()->user()->role, ['admin', 'superadmin'], true))
                                            <li><a href="{{ route('admin.dashboard') }}">Admin Dashboard</a></li>
                                        @endif
                                        <li>
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <button class="btn btn-link nav-link" type="submit">Sign Out</button>
                                            </form>
                                        </li>
                                    @endguest
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="col-lg-2 col-12">
                        <div class="single-widget button glowing-text">
                            <a href="{{ route('application') }}" class="btn">
                                <span>APPLY</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ End Header Inner -->
</header>
