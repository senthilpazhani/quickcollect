<nav class="site-navbar navbar navbar-default navbar-fixed-top navbar-mega" role="navigation">
    <div class="navbar-header">
        <button type="button" class="navbar-toggler hamburger hamburger-close navbar-toggler-left hided"
            data-toggle="menubar">
            <span class="sr-only">Toggle navigation</span>
            <span class="hamburger-bar"></span>
        </button>
        <button type="button" class="navbar-toggler collapsed" data-target="#site-navbar-collapse"
            data-toggle="collapse">
            <i class="icon md-more" aria-hidden="true"></i>
        </button>
        <div style="padding-top:5px !important" class="navbar-brand navbar-brand-center site-gridmenu-toggle" data-toggle="gridmenu">
            <img lass="navbar-brand-logo" src="{{URL::asset('/images/logo.png')}}" title="{{ config('app.name') }}">
            <span class="navbar-brand-text idden-xs-down"> <img style="width:180px !important;" src="{{URL::asset('/images/title.png')}}" title="{{ config('app.name') }}"></span>
        </div>
        <button type="button" class="navbar-toggler collapsed" data-target="#site-navbar-search"
            data-toggle="collapse">
            <span class="sr-only">Toggle Search</span>
            <i class="icon md-search" aria-hidden="true"></i>
        </button>
    </div>

    <div class="navbar-container container-fluid">
        <!-- Navbar Collapse -->
        <div class="collapse navbar-collapse navbar-collapse-toolbar" id="site-navbar-collapse">
            <!-- Navbar Toolbar -->
            <ul class="nav navbar-toolbar">
                <li class="nav-item hidden-float" id="toggleMenubar">
                    <a class="nav-link" data-toggle="menubar" href="#" role="button">
                    <i class="icon hamburger hamburger-arrow-left">
                        <span class="sr-only">Toggle menubar</span>
                        <span class="hamburger-bar"></span>
                    </i>
                    </a>
                </li>
                <li class="nav-item hidden-sm-down" id="toggleFullscreen">
                    <a class="nav-link icon icon-fullscreen" data-toggle="fullscreen" href="#" role="button">
                    <span class="sr-only">Toggle fullscreen</span>
                    </a>
                </li>
                <!--<li class="nav-item hidden-float">
                    <a class="nav-link icon md-search" data-toggle="collapse" href="#" data-target="#site-navbar-search"
                    role="button">
                    <span class="sr-only">Toggle Search</span>
                    </a>
                </li>
                <li class="nav-item dropdown dropdown-fw dropdown-mega">
                    <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false" data-animation="fade"
                    role="button">Mega <i class="icon md-chevron-down" aria-hidden="true"></i></a>
                    <div class="dropdown-menu" role="menu">
                    <div class="mega-content">
                        <div class="row">
                        <div class="col-md-4">
                            <h5>UI Kit</h5>
                            <ul class="blocks-2">
                            <li class="mega-menu m-0">
                                <ul class="list-icons">
                                <li><i class="md-chevron-right" aria-hidden="true"></i><a href="../advanced/animation.html">Animation</a></li>
                                <li><i class="md-chevron-right" aria-hidden="true"></i><a href="../uikit/buttons.html">Buttons</a></li>
                                <li><i class="md-chevron-right" aria-hidden="true"></i><a href="../uikit/colors.html">Colors</a></li>
                                <li><i class="md-chevron-right" aria-hidden="true"></i><a href="../uikit/dropdowns.html">Dropdowns</a></li>
                                <li><i class="md-chevron-right" aria-hidden="true"></i><a href="../uikit/icons.html">Icons</a></li>
                                <li><i class="md-chevron-right" aria-hidden="true"></i><a href="../advanced/lightbox.html">Lightbox</a></li>
                                </ul>
                            </li>
                            <li class="mega-menu m-0">
                                <ul class="list-icons">
                                <li><i class="md-chevron-right" aria-hidden="true"></i><a href="../uikit/modals.html">Modals</a></li>
                                <li><i class="md-chevron-right" aria-hidden="true"></i><a href="../uikit/panel-structure.html">Panels</a></li>
                                <li><i class="md-chevron-right" aria-hidden="true"></i><a href="../structure/overlay.html">Overlay</a></li>
                                <li><i class="md-chevron-right" aria-hidden="true"></i><a href="../uikit/tooltip-popover.html ">Tooltips</a></li>
                                <li><i class="md-chevron-right" aria-hidden="true"></i><a href="../advanced/scrollable.html">Scrollable</a></li>
                                <li><i class="md-chevron-right" aria-hidden="true"></i><a href="../uikit/typography.html">Typography</a></li>
                                </ul>
                            </li>
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <h5>Media
                            <span class="badge badge-pill badge-success">4</span>
                            </h5>
                            <ul class="blocks-3">
                            <li>
                                <a class="thumbnail m-0" href="javascript:void(0)">
                                <img class="w-full" src="../../../global/photos/placeholder.png" alt="..." />
                                </a>
                            </li>
                            <li>
                                <a class="thumbnail m-0" href="javascript:void(0)">
                                <img class="w-full" src="../../../global/photos/placeholder.png" alt="..." />
                                </a>
                            </li>
                            <li>
                                <a class="thumbnail m-0" href="javascript:void(0)">
                                <img class="w-full" src="../../../global/photos/placeholder.png" alt="..." />
                                </a>
                            </li>
                            <li>
                                <a class="thumbnail m-0" href="javascript:void(0)">
                                <img class="w-full" src="../../../global/photos/placeholder.png" alt="..." />
                                </a>
                            </li>
                            <li>
                                <a class="thumbnail m-0" href="javascript:void(0)">
                                <img class="w-full" src="../../../global/photos/placeholder.png" alt="..." />
                                </a>
                            </li>
                            <li>
                                <a class="thumbnail m-0" href="javascript:void(0)">
                                <img class="w-full" src="../../../global/photos/placeholder.png" alt="..." />
                                </a>
                            </li>
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <h5 class="mb-0">Accordion</h5>
                            <!-- Accordion -- >
                            <div class="panel-group panel-group-simple" id="siteMegaAccordion" aria-multiselectable="true"
                            role="tablist">
                            <div class="panel">
                                <div class="panel-heading" id="siteMegaAccordionHeadingOne" role="tab">
                                <a class="panel-title" data-toggle="collapse" href="#siteMegaCollapseOne" data-parent="#siteMegaAccordion"
                                    aria-expanded="false" aria-controls="siteMegaCollapseOne">
                                    Collapsible Group Item #1
                                </a>
                                </div>
                                <div class="panel-collapse collapse" id="siteMegaCollapseOne" aria-labelledby="siteMegaAccordionHeadingOne"
                                role="tabpanel">
                                <div class="panel-body">
                                    De moveat laudatur vestra parum doloribus labitur sentire partes, eripuit praesenti
                                    congressus ostendit alienae, voluptati ornateque accusamus
                                    clamat reperietur convicia albucius.
                                </div>
                                </div>
                            </div>
                            <div class="panel">
                                <div class="panel-heading" id="siteMegaAccordionHeadingTwo" role="tab">
                                <a class="panel-title collapsed" data-toggle="collapse" href="#siteMegaCollapseTwo"
                                    data-parent="#siteMegaAccordion" aria-expanded="false"
                                    aria-controls="siteMegaCollapseTwo">
                                    Collapsible Group Item #2
                                </a>
                                </div>
                                <div class="panel-collapse collapse" id="siteMegaCollapseTwo" aria-labelledby="siteMegaAccordionHeadingTwo"
                                role="tabpanel">
                                <div class="panel-body">
                                    Praestabiliorem. Pellat excruciant legantur ullum leniter vacare foris voluptate
                                    loco ignavi, credo videretur multoque choro fatemur mortis
                                    animus adoptionem, bello statuat expediunt naturales.
                                </div>
                                </div>
                            </div>

                            <div class="panel">
                                <div class="panel-heading" id="siteMegaAccordionHeadingThree" role="tab">
                                <a class="panel-title collapsed" data-toggle="collapse" href="#siteMegaCollapseThree"
                                    data-parent="#siteMegaAccordion" aria-expanded="false"
                                    aria-controls="siteMegaCollapseThree">
                                    Collapsible Group Item #3
                                </a>
                                </div>
                                <div class="panel-collapse collapse" id="siteMegaCollapseThree" aria-labelledby="siteMegaAccordionHeadingThree"
                                role="tabpanel">
                                <div class="panel-body">
                                    Horum, antiquitate perciperet d conspectum locus obruamus animumque perspici probabis
                                    suscipere. Desiderat magnum, contenta poena desiderant
                                    concederetur menandri damna disputandum corporum.
                                </div>
                                </div>
                            </div>
                            </div>
                            <!-- End Accordion -- >
                        </div>
                        </div>
                    </div>
                    </div>
                </li>-->
            </ul>
            <!-- End Navbar Toolbar -->

            <!-- Navbar Toolbar Right -->
            <ul class="nav navbar-toolbar navbar-right navbar-toolbar-right">
                <!-- Translation -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="javascript:void(0)" data-animation="scale-up"
                    aria-expanded="false" role="button">
                    <span class="flag-icon flag-icon-@if ( App::getLocale()=='en'){{ 'gb' }}@else{{ App::getLocale() }}@endif"></span>
                    </a>
                    <div class="dropdown-menu" role="menu" class="languageSwitcher">
                    @foreach (Config::get('languages') as $lang => $language)
                        @if ($lang != App::getLocale())
                        <a class="dropdown-item "  role="menuitem" href="{{ route('lang.switch', $language['lang'] ) }}">
                            <span class="flag-icon {{ $language['flag']  }}"></span> {{ $language['language'] }}</a>
                        @endif
                    @endforeach
                    </div>
                </li>
                @if (Route::has('login'))
                    <li class="nav-item dropdown">
                        @auth
                            <a class="nav-link navbar-avatar" data-toggle="dropdown" href="#" aria-expanded="false"
                            data-animation="scale-up" role="button">
                            <span class="avatar avatar-online">
                                <img src="../../../global/portraits/5.jpg" alt="...">
                                <i></i>
                            </span>
                            </a>
                            <div class="dropdown-menu" role="menu">
                                <a class="dropdown-item" href="javascript:void(0)" role="menuitem"><i class="icon md-account" aria-hidden="true"></i> Profile</a>
                                <a class="dropdown-item" href="javascript:void(0)" role="menuitem"><i class="icon md-card" aria-hidden="true"></i> Billing</a>
                                <a class="dropdown-item" href="javascript:void(0)" role="menuitem"><i class="icon md-settings" aria-hidden="true"></i> Settings</a>
                                <div class="dropdown-divider" role="presentation"></div>
                                <a class="dropdown-item" role="menuitem" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                    <i class="icon md-power" aria-hidden="true"></i> {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        @else
                            <a href="{{ route('login') }}">Login</a>
                            <a href="{{ route('register') }}">Register</a>
                        @endauth
                    </li>
                @endif
                <!-- <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="javascript:void(0)" title="Notifications"
                    aria-expanded="false" data-animation="scale-up" role="button">
                    <i class="icon md-notifications" aria-hidden="true"></i>
                    <span class="badge badge-pill badge-danger up">5</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-media" role="menu">
                    <div class="dropdown-menu-header">
                        <h5>NOTIFICATIONS</h5>
                        <span class="badge badge-round badge-danger">New 5</span>
                    </div>

                    <div class="list-group">
                        <div data-role="container">
                            <div data-role="content">
                                <a class="list-group-item dropdown-item" href="javascript:void(0)" role="menuitem">
                                <div class="media">
                                    <div class="pr-10">
                                    <i class="icon md-receipt bg-red-600 white icon-circle" aria-hidden="true"></i>
                                    </div>
                                    <div class="media-body">
                                    <h6 class="media-heading">A new order has been placed</h6>
                                    <time class="media-meta" datetime="2017-06-12T20:50:48+08:00">5 hours ago</time>
                                    </div>
                                </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="dropdown-menu-footer">
                        <a class="dropdown-menu-footer-btn" href="javascript:void(0)" role="button">
                        <i class="icon md-settings" aria-hidden="true"></i>
                        </a>
                        <a class="dropdown-item" href="javascript:void(0)" role="menuitem">
                        All notifications
                        </a>
                    </div>
                    </div>
                </li> -->
                <li class="nav-item" id="toggleChat">
                    <a class="nav-link" data-toggle="site-sidebar" href="javascript:void(0)" title="Chat"
                    data-url="{{ url('URLHere') }}">
                    <i class="icon md-comment" aria-hidden="true"></i>
                    </a>
                </li>
            </ul>
            <!-- End Navbar Toolbar Right -->
        </div>
        <!-- End Navbar Collapse -->

        <!-- Site Navbar Seach -->
        <div class="collapse navbar-search-overlap" id="site-navbar-search">
            <form role="search">
                <div class="form-group">
                    <div class="input-search">
                    <i class="input-search-icon md-search" aria-hidden="true"></i>
                    <input type="text" class="form-control" name="site-search" placeholder="Search...">
                    <button type="button" class="input-search-close icon md-close" data-target="#site-navbar-search"
                        data-toggle="collapse" aria-label="Close"></button>
                    </div>
                </div>
            </form>
        </div>
        <!-- End Site Navbar Seach -->
    </div>
</nav>
