<div class="header-container fixed-top">
    <header class="header navbar navbar-expand-sm">
        <a href="javascript:void(0);" class="sidebarCollapse" data-placement="bottom">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                 class="feather feather-menu">
                <line x1="3" y1="12" x2="21" y2="12"></line>
                <line x1="3" y1="6" x2="21" y2="6"></line>
                <line x1="3" y1="18" x2="21" y2="18"></line>
            </svg>
        </a>

        <ul class="navbar-item flex-row">

        </ul>
        <ul class="navbar-item flex-row search-ul">
            {{--            <li class="nav-item align-self-center search-animated">--}}
            {{--                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"--}}
            {{--                     stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"--}}
            {{--                     class="feather feather-search toggle-search">--}}
            {{--                    <circle cx="11" cy="11" r="8"></circle>--}}
            {{--                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>--}}
            {{--                </svg>--}}
            {{--                <form class="form-inline search-full form-inline search" role="search">--}}
            {{--                    <div class="search-bar">--}}
            {{--                        <input type="text" class="form-control search-form-control  ml-lg-auto" placeholder="Search...">--}}
            {{--                    </div>--}}
            {{--                </form>--}}
            {{--            </li>--}}
        </ul>


        <ul class="navbar-item flex-row navbar-dropdown">

            <li class="nav-item dropdown message-dropdown">

                <a href="javascript:void(0);" class="nav-link dropdown-toggle"> <p class="m-0">ID: {{ auth()->id() ?? '' }}</p></a>

            </li>

            <li class="nav-item dropdown notification-dropdown">
                <a href="{{ route('balance.index') }}" class="nav-link dropdown-toggle">
                    <button
                        class="btn btn-success p-1 shadow-none">{{ __('Balance: ') }}{{ balanceFormat(auth()->user()->balance ?? 0) }}</button>
                </a>
            </li>

            <li class="nav-item dropdown user-profile-dropdown  order-lg-0 order-1">
                <a href="javascript:void(0);" class="nav-link dropdown-toggle user" id="userProfileDropdown"
                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img
                        src="{{ (auth()->user()->image) ? asset('storage/upload/'.auth()->user()->image) : asset('backend/assets/img/90x90.jpg') }}"
                        alt="avatar">
                </a>
                <div class="dropdown-menu position-absolute" aria-labelledby="userProfileDropdown">
                    <div class="user-profile-section">
                        <div class="media mx-auto">
                            <img
                                src="{{ (auth()->user()->image) ? asset('storage/upload/'.auth()->user()->image) : asset('dashboard/assets/img/90x90.jpg') }}"
                                class="img-fluid mr-2" alt="avatar">
                            <div class="media-body">
                                <h5>{{ auth()->user()->name ?? '' }}</h5>
                                <p>{{__('Balance: ')}} {{ Auth::user()->balance ? balanceFormat(Auth::user()->balance) : balanceFormat() }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="dropdown-item">
                        <a href="{{ route('profile.view') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                 stroke-linejoin="round" class="feather feather-user">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                            <span> Profile</span>
                        </a>
                    </div>
                    <div class="dropdown-item">
                        <a href="{{ route('password.view') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                 stroke-linejoin="round" class="feather feather-lock">
                                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                            </svg>
                            <span>Change Password</span>
                        </a>
                    </div>
                    <div class="dropdown-item">
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                 stroke-linejoin="round" class="feather feather-log-out">
                                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                <polyline points="16 17 21 12 16 7"></polyline>
                                <line x1="21" y1="12" x2="9" y2="12"></line>
                            </svg>
                            <span>Log Out</span>
                        </a>
                        <form action="{{ route('logout') }}" class="display-none" id="logout-form" method="POST">
                            @csrf
                        </form>
                    </div>
                </div>
            </li>
        </ul>
    </header>
</div>
