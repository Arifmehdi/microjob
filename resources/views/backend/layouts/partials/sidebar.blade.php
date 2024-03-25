<div class="sidebar-wrapper sidebar-theme">

    <nav id="sidebar">

        <ul class="navbar-nav theme-brand flex-row  text-center">
            <li class="nav-item theme-text">
                <a href="{{ route('admin.dashboard') }}"
                   class="nav-link">
                    @if(!empty(get_setting('site_logo')))
                        <img src="{{ asset('storage/upload/'.get_setting('site_logo'))  }}" alt="Logo" width="100">
                    @else
                        {{ get_setting('site_title') }}
                    @endif
                </a>
            </li>
            <li class="nav-item toggle-sidebar">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                     class="feather sidebarCollapse feather-chevrons-left">
                    <polyline points="11 17 6 12 11 7"></polyline>
                    <polyline points="18 17 13 12 18 7"></polyline>
                </svg>
            </li>
        </ul>
        {{--        <div class="shadow-bottom"></div>--}}
        <ul class="list-unstyled menu-categories" id="sidebarMenuWrapper">
            <li class="menu {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard') }}" class="dropdown-toggle"
                   aria-expanded="{{ request()->routeIs('admin.dashboard') ? 'true' : 'false' }}">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                             fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                             stroke-linejoin="round" class="feather feather-home">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                            <polyline points="9 22 9 12 15 12 15 22"></polyline>
                        </svg>
                        <span>{{ __('Dashboard') }}</span>
                    </div>
                </a>
            </li>
            <li class="menu {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                <a href="#category-management" data-toggle="collapse"
                   aria-expanded="{{ request()->routeIs('admin.categories.*') ? 'true' : 'false' }}"
                   class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-box">
                            <path
                                d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                            <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                            <line x1="12" y1="22.08" x2="12" y2="12"></line>
                        </svg>
                        <span>{{ __('Category Management') }}</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                             fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                             stroke-linejoin="round" class="feather feather-chevron-right">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </div>
                </a>
                <ul class="collapse submenu recent-submenu mini-recent-submenu list-unstyled {{ request()->routeIs('admin.categories.*') ? 'show' : '' }}"
                    id="category-management"
                    data-parent="#sidebarMenuWrapper">
                    <li class="{{ request()->routeIs('admin.categories.index') ? 'active' : '' }}">
                        <a href="{{ route('admin.categories.index') }}">{{ __('Categories') }}</a>
                    </li>
                    <li class="{{ request()->routeIs('admin.categories.create') ? 'active' : '' }}">
                        <a href="{{ route('admin.categories.create') }}">{{ __('Add New') }}</a>
                    </li>
                </ul>
            </li>

            <li class="menu {{ request()->routeIs('admin.jobs.*') ? 'active' : '' }}">
                <a href="#job-management" data-toggle="collapse"
                   aria-expanded="{{ request()->routeIs('admin.jobs.*') ? 'true' : 'false' }}"
                   class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-briefcase">
                            <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
                            <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                        </svg>
                        <span>{{ __('Job Management') }}</span>
                        @if($pending_jobs_count_sidebar > 0)
                            <span class="badge badge-primary text-white">{{ $pending_jobs_count_sidebar }}</span>
                        @endif
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                             fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                             stroke-linejoin="round" class="feather feather-chevron-right">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </div>
                </a>
                <ul class="collapse submenu recent-submenu mini-recent-submenu list-unstyled {{ request()->routeIs('admin.jobs.*') ? 'show' : '' }}"
                    id="job-management"
                    data-parent="#sidebarMenuWrapper">
                    <li class="{{ (request()->routeIs('admin.jobs.index') && !request()->has('status')) ? 'active' : '' }}">
                        <a href="{{ route('admin.jobs.index') }}">{{ __('All Jobs') }}</a>
                    </li>
                    <li class="{{ request()->routeIs('admin.jobs.create') ? 'active' : '' }}">
                        <a href="{{ route('admin.jobs.create') }}">{{ __('Add New') }}</a>
                    </li>
                    <li class="{{ (request()->routeIs('admin.jobs.index') && request()->has('status') && request()->query('status') === 'approved') ? 'active' : '' }}">
                        <a href="{{ route('admin.jobs.index',['status'=>'approved']) }}">{{ __('Approved Jobs') }}</a>
                    </li>
                    <li class="{{ (request()->routeIs('admin.jobs.index') && request()->has('status') && request()->query('status') === 'pending') ? 'active' : '' }}">
                        <a href="{{ route('admin.jobs.index',['status'=>'pending']) }}">{{ __('Pending Jobs') }}</a>
                    </li>
                    <li class="{{ (request()->routeIs('admin.jobs.index') && request()->has('status') && request()->query('status') === 'rejected') ? 'active' : '' }}">
                        <a href="{{ route('admin.jobs.index',['status'=>'rejected']) }}">{{ __('Rejected Jobs') }}</a>
                    </li>
                </ul>
            </li>

            <li class="menu {{ request()->routeIs('admin.deposits.*') ? 'active' : '' }}">
                <a href="{{ route('admin.deposits.index') }}" class="dropdown-toggle"
                   aria-expanded="{{ request()->routeIs('admin.deposits.*') ? 'true' : 'false' }}">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-credit-card">
                            <rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect>
                            <line x1="1" y1="10" x2="23" y2="10"></line>
                        </svg>
                        <span>{{ __('Deposits') }}</span>
                        @if($pending_deposits_count > 0)
                            <span class="badge badge-primary text-white">{{ $pending_deposits_count }}</span>
                        @endif
                    </div>
                </a>
            </li>
            <li class="menu {{ request()->routeIs('admin.withdraws.*') ? 'active' : '' }}">
                <a href="{{ route('admin.withdraws.index') }}" class="dropdown-toggle"
                   aria-expanded="{{ request()->routeIs('admin.withdraws.*') ? 'true' : 'false' }}">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-dollar-sign">
                            <line x1="12" y1="1" x2="12" y2="23"></line>
                            <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                        </svg>
                        <span>{{ __('Withdraws') }}</span>
                        @if($pending_withdraws_count > 0)
                            <span class="badge badge-primary text-white">{{ $pending_withdraws_count }}</span>
                        @endif
                    </div>
                </a>
            </li>

            <li class="menu {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}">
                <a href="#report-management" data-toggle="collapse"
                   aria-expanded="{{ request()->routeIs('admin.reports.*') ? 'true' : 'false' }}"
                   class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                             fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-users">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                        <span>{{ __('Reports') }}</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                             fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                             stroke-linejoin="round" class="feather feather-chevron-right">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </div>
                </a>
                <ul class="collapse submenu recent-submenu mini-recent-submenu list-unstyled {{ request()->routeIs('admin.reports.*') ? 'show' : '' }}"
                    id="report-management"
                    data-parent="#sidebarMenuWrapper">
                    <li class="{{ (request()->routeIs('admin.reports.proves.index') && !request()->has('status')) ? 'active' : '' }}">
                        <a href="{{ route('admin.reports.proves.index') }}">{{ __('Proves') }}</a>
                    </li>
                    <li class="{{ (request()->routeIs('admin.reports.proves.index') && request()->has('status') && request()->query('status') === 'completed') ? 'active' : '' }}">
                        <a href="{{ route('admin.reports.proves.index',['status'=>'completed']) }}">{{ __('Reviewed Proves') }}</a>
                    </li>
                    <li class="{{ (request()->routeIs('admin.reports.proves.index') && request()->has('status') && request()->query('status') === 'pending') ? 'active' : '' }}">
                        <a href="{{ route('admin.reports.proves.index',['status'=>'pending']) }}">{{ __('Not Reviewed Proves') }}</a>
                    </li>
                </ul>
            </li>

            <li class="menu {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                <a href="#user-management" data-toggle="collapse"
                   aria-expanded="{{ request()->routeIs('admin.users.*') ? 'true' : 'false' }}" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                             fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-users">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                        <span>{{ __('User Management') }}</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                             fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                             stroke-linejoin="round" class="feather feather-chevron-right">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </div>
                </a>
                <ul class="collapse submenu recent-submenu mini-recent-submenu list-unstyled {{ request()->routeIs('admin.users.*') ? 'show' : '' }}"
                    id="user-management"
                    data-parent="#sidebarMenuWrapper">
                    <li class="{{ request()->routeIs('admin.users.index') ? 'active' : '' }}">
                        <a href="{{ route('admin.users.index') }}">{{ __('Users') }}</a>
                    </li>
                    <li class="{{ request()->routeIs('admin.users.create') ? 'active' : '' }}">
                        <a href="{{ route('admin.users.create') }}">{{ __('Add New') }}</a>
                    </li>
                </ul>
            </li>

            <li class="menu {{ request()->routeIs('admin.profile.*') ? 'active' : '' }}">
                <a href="{{ route('admin.profile.view') }}" class="dropdown-toggle"
                   aria-expanded="{{ (request()->routeIs('admin.profile.*') || request()->routeIs('admin.password.*') ) ? 'true' : 'false' }}">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-user">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                        <span>{{ __('Profile') }}</span>
                    </div>
                </a>
            </li>
            <li class="menu {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                <a href="{{ route('admin.settings.view') }}" class="dropdown-toggle"
                   aria-expanded="{{ request()->routeIs('admin.settings.*') ? 'true' : 'false' }}">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-settings">
                            <circle cx="12" cy="12" r="3"></circle>
                            <path
                                d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path>
                        </svg>
                        <span>{{ __('Settings') }}</span>
                    </div>
                </a>
            </li>
        </ul>

    </nav>

</div>
