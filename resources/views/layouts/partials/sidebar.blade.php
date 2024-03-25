<div class="sidebar-wrapper sidebar-theme">

    <nav id="sidebar">

        <ul class="navbar-nav theme-brand flex-row  text-center">
            <li class="nav-item theme-text">
                <a href="{{ route('jobs') }}"
                   class="nav-link"> @if(!empty(get_setting('site_logo')))
                        <img src="{{ asset('storage/upload/'.get_setting('site_logo'))  }}" alt="Logo" width="100">
                    @else
                        {{ get_setting('site_title') }}
                    @endif </a>
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
            <li class="menu {{ request()->routeIs('jobs') ? 'active' : '' }}">
                <a href="{{ route('jobs') }}" class="dropdown-toggle"
                   aria-expanded="{{ request()->routeIs('jobs') ? 'true' : 'false' }}">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-search">
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        </svg>
                        <span>{{ __('Find Jobs') }}</span>
                    </div>
                </a>
            </li>
            <li class="menu {{ request()->routeIs('my-jobs.create') ? 'active' : '' }}">
                <a href="{{ route('my-jobs.create') }}" class="dropdown-toggle"
                   aria-expanded="{{ request()->routeIs('my-jobs.create*') ? 'true' : 'false' }}">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-plus-circle">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="12" y1="8" x2="12" y2="16"></line>
                            <line x1="8" y1="12" x2="16" y2="12"></line>
                        </svg>
                        <span>{{ __('Add New Job') }}</span>
                    </div>
                </a>
            </li>
            <li class="menu {{ request()->routeIs('my-jobs.index') ? 'active' : '' }}">
                <a href="{{ route('my-jobs.index') }}" class="dropdown-toggle"
                   aria-expanded="{{ (request()->routeIs('my-jobs.index') || request()->routeIs('my-jobs.show')) ? 'true' : 'false' }}">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-briefcase">
                            <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
                            <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                        </svg>
                        <span>{{ __('My Jobs') }}</span>
                    </div>
                </a>
            </li>
            <li class="menu {{ request()->routeIs('works.*') ? 'active' : '' }}">
                <a href="{{ route('works.index') }}" class="dropdown-toggle"
                   aria-expanded="{{ request()->routeIs('works.*') ? 'true' : 'false' }}">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-list">
                            <line x1="8" y1="6" x2="21" y2="6"></line>
                            <line x1="8" y1="12" x2="21" y2="12"></line>
                            <line x1="8" y1="18" x2="21" y2="18"></line>
                            <line x1="3" y1="6" x2="3.01" y2="6"></line>
                            <line x1="3" y1="12" x2="3.01" y2="12"></line>
                            <line x1="3" y1="18" x2="3.01" y2="18"></line>
                        </svg>
                        <span>{{ __('My Works') }}</span>
                    </div>
                </a>
            </li>

            <li class="menu {{ request()->routeIs('deposits.*') ? 'active' : '' }}">
                <a href="#deposit-management" data-toggle="collapse"
                   aria-expanded="{{ request()->routeIs('deposits.*') ? 'true' : 'false' }}" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-credit-card">
                            <rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect>
                            <line x1="1" y1="10" x2="23" y2="10"></line>
                        </svg>
                        <span>{{ __('My Deposits') }}</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                             fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                             stroke-linejoin="round" class="feather feather-chevron-right">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </div>
                </a>
                <ul class="collapse submenu recent-submenu mini-recent-submenu list-unstyled {{ request()->routeIs('deposits.*') ? 'show' : '' }}"
                    id="deposit-management"
                    data-parent="#sidebarMenuWrapper">
                    <li class="{{ request()->routeIs('deposits.index') ? 'active' : '' }}">
                        <a href="{{ route('deposits.index') }}">{{ __('Deposits') }}</a>
                    </li>
                    <li class="{{ request()->routeIs('deposits.create') ? 'active' : '' }}">
                        <a href="{{ route('deposits.create') }}">{{ __('New Deposit') }}</a>
                    </li>
                </ul>
            </li>
            <li class="menu {{ request()->routeIs('withdraws.*') ? 'active' : '' }}">
                <a href="#withdraw-management" data-toggle="collapse"
                   aria-expanded="{{ request()->routeIs('withdraws.*') ? 'true' : 'false' }}" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-dollar-sign">
                            <line x1="12" y1="1" x2="12" y2="23"></line>
                            <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                        </svg>
                        <span>{{ __('My Withdraws') }}</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                             fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                             stroke-linejoin="round" class="feather feather-chevron-right">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </div>
                </a>
                <ul class="collapse submenu recent-submenu mini-recent-submenu list-unstyled {{ request()->routeIs('withdraws.*') ? 'show' : '' }}"
                    id="withdraw-management"
                    data-parent="#sidebarMenuWrapper">
                    <li class="{{ request()->routeIs('withdraws.index') ? 'active' : '' }}">
                        <a href="{{ route('withdraws.index') }}">{{ __('Withdraws') }}</a>
                    </li>
                    <li class="{{ request()->routeIs('withdraws.create') ? 'active' : '' }}">
                        <a href="{{ route('withdraws.create') }}">{{ __('New Withdraw') }}</a>
                    </li>
                </ul>
            </li>
            <li class="menu {{ request()->routeIs('notifications.*') ? 'active' : '' }}">
                <a href="{{ route('notifications.index') }}" class="dropdown-toggle"
                   aria-expanded="{{ (request()->routeIs('notifications.*') || request()->routeIs('password.*') ) ? 'true' : 'false' }}">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-bell">
                            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                            <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                        </svg>
                        <span>{{ __('Notifications') }}</span>
                        @if($total_unread_notification > 0)
                            <span class="badge badge-primary text-white">{{ $total_unread_notification }}</span>
                        @endif
                    </div>
                </a>
            </li>
            <li class="menu {{ request()->routeIs('balance.index') ? 'active' : '' }}">
                <a href="{{ route('balance.index') }}" class="dropdown-toggle"
                   aria-expanded="{{ request()->routeIs('balance.index') ? 'true' : 'false' }}">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-inbox">
                            <polyline points="22 12 16 12 14 15 10 15 8 12 2 12"></polyline>
                            <path
                                d="M5.45 5.11L2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z"></path>
                        </svg>
                        <span>{{ __('Balance Details') }}</span>
                    </div>
                </a>
            </li>
            <li class="menu {{ request()->routeIs('profile.*') ? 'active' : '' }}">
                <a href="{{ route('profile.view') }}" class="dropdown-toggle"
                   aria-expanded="{{ (request()->routeIs('profile.*') || request()->routeIs('password.*') ) ? 'true' : 'false' }}">
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
        </ul>

    </nav>

</div>
