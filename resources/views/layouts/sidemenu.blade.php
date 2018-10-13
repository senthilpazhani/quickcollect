<div class="site-menubar">
    <div class="site-menubar-body">
        <div>
            <div>
                <ul class="site-menu" data-plugin="menu">
                    <li class="site-menu-item active open">
                        <a class="animsition-link" href="{{ route('dashboard') }}">
                                <i class="site-menu-icon md-view-dashboard" aria-hidden="true"></i>
                                <span class="site-menu-title"> Dashboard</span>
                            </a>
                    </li>
                    <li class="site-menu-item">
                        <a class="animsition-link" href="{{ route('user') }}">
                                <i class="site-menu-icon md-view-dashboard" aria-hidden="true"></i>
                                <span class="site-menu-title">Users</span>
                            </a>
                    </li>
                    <li class="site-menu-item">
                        <a class="animsition-link" href="{{ route('followup') }}">
                                <i class="site-menu-icon md-view-dashboard" aria-hidden="true"></i>
                                <span class="site-menu-title">Payment Follow</span>
                            </a>
                    </li>
                    <li class="site-menu-item">
                        <a class="animsition-link" href="{{ route('receipt') }}">
                                <i class="site-menu-icon md-view-dashboard" aria-hidden="true"></i>
                                <span class="site-menu-title">Add Receipt</span>
                            </a>
                    </li>
                    <li class="site-menu-item has-sub">
                        <a href="javascript:void(0)">
                                <i class="site-menu-icon md-view-compact" aria-hidden="true"></i>
                                <span class="site-menu-title">Settings</span>
                                        <span class="site-menu-arrow"></span>
                            </a>
                        <ul class="site-menu-sub">
                            <li class="site-menu-item">
                                <a class="animsition-link" href="{{ route('emailtemplate') }}">
                                <span class="site-menu-title">EMail Template</span>
                                </a>
                            </li>
                            <li class="site-menu-item">
                                <a class="animsition-link" href="{{ route('smtp') }}">
                                <span class="site-menu-title">SMPT Setting</span>
                                </a>
                            </li>
                            <li class="site-menu-item active">
                                <a class="animsition-link" href="{{ route('smstemplate') }}">
                                <span class="site-menu-title">SMS</span>
                                </a>
                            </li>
                            <li class="site-menu-item">
                                <a class="animsition-link" href="{{ route('tag') }}">
                                <span class="site-menu-title">Tags</span>
                                </a>
                            </li>
                            <li class="site-menu-item">
                                <a class="animsition-link" href="{{ route('customfield') }}">
                                <span class="site-menu-title">Custom Field</span>
                                </a>
                            </li>
                            <li class="site-menu-item">
                                <a class="animsition-link" href="{{ route('systemsetting') }}">
                                <span class="site-menu-title">System Setting</span>
                                </a>
                            </li>
                            <li class="site-menu-item">
                                <a class="animsition-link" href="../layouts/panel-transition.html">
                                <span class="site-menu-title">Export Followup</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="site-menu-item">
                        <a class="animsition-link"  href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                <i class="site-menu-icon md-view-dashboard" aria-hidden="true"></i>
                                <span class="site-menu-title">Logout</span>
                            </a>
                    </li>
                </ul>
                <!-- <div class="site-menubar-section">
                    <h5>
                        Milestone
                        <span class="float-right">30%</span>
                    </h5>
                    <div class="progress progress-xs">
                        <div class="progress-bar active" style="width: 30%;" role="progressbar"></div>
                    </div>
                    <h5>
                        Release
                        <span class="float-right">60%</span>
                    </h5>
                    <div class="progress progress-xs">
                    <div class="progress-bar progress-bar-warning" style="width: 60%;" role="progressbar"></div>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
<!--<div class="site-menubar-footer">
        <a href="javascript: void(0);" class="fold-show" data-placement="top" data-toggle="tooltip"
            data-original-title="Settings">
            <span class="icon md-settings" aria-hidden="true"></span>
        </a>
        <a href="javascript: void(0);" data-placement="top" data-toggle="tooltip" data-original-title="Lock">
            <span class="icon md-eye-off" aria-hidden="true"></span>
        </a>
        <a href="javascript: void(0);" data-placement="top" data-toggle="tooltip" data-original-title="Logout">
            <span class="icon md-power" aria-hidden="true"></span>
        </a>
    </div> -->
</div>
<!-- <div class="site-gridmenu">
    <div>
        <div>
            <ul>
                <li>
                <a href="../apps/mailbox/mailbox.html">
                    <i class="icon md-email"></i>
                    <span>Mailbox</span>
                </a>
                </li>
                <li>
                <a href="../apps/calendar/calendar.html">
                    <i class="icon md-calendar"></i>
                    <span>Calendar</span>
                </a>
                </li>
                <li>
                <a href="../apps/contacts/contacts.html">
                    <i class="icon md-account"></i>
                    <span>Contacts</span>
                </a>
                </li>
                <li>
                <a href="../apps/media/overview.html">
                    <i class="icon md-videocam"></i>
                    <span>Media</span>
                </a>
                </li>
                <li>
                <a href="../apps/documents/categories.html">
                    <i class="icon md-receipt"></i>
                    <span>Documents</span>
                </a>
                </li>
                <li>
                <a href="../apps/projects/projects.html">
                    <i class="icon md-image"></i>
                    <span>Project</span>
                </a>
                </li>
                <li>
                <a href="../apps/forum/forum.html">
                    <i class="icon md-comments"></i>
                    <span>Forum</span>
                </a>
                </li>
                <li>
                <a href="../index.html">
                    <i class="icon md-view-dashboard"></i>
                    <span>Dashboard</span>
                </a>
                </li>
            </ul>
        </div>
    </div>
</div>-->
