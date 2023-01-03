<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{asset("logo.png")}}"  alt="logo icon" width="36px">
        </div>
        <div>
            <h4 class="logo-text">IdealPhone</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-first-page'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        @php

            $filename = "menu.json";
            if ($guard_web) {
                $filename = "menu_client.json";
            }
               $jsonString = file_get_contents($filename);
               $jsonMenu = json_decode($jsonString, true);
        @endphp
        @foreach($jsonMenu as $menuItem)
            <li>
                <a href="{{ route($menuItem['url']) }}" class="{{sizeof($menuItem["sousmenu"])?'has-arrow':''}}">
                    <div class="parent-icon"><i class='{{$menuItem["icon"]}}'></i>
                    </div>
                    <div class="menu-title">{{ $menuItem["name"] }}</div>
                </a>
                <ul>
                    @foreach($menuItem["sousmenu"] as $subMenuItem)
                        <li><a href="{{$subMenuItem['url']!='#'?route($subMenuItem['url']):'#'}}"><i class="bx bx-right-arrow-alt"></i>{{ $menuItem["name"] }}</a>
                        </li>
                    @endforeach
                </ul>
            </li>

        @endforeach
        @if(Auth::guard('admin')->check() && Auth::user()->super == 1)
            <li>
                <a href="{{ route('users.index') }}" >
                    <div class="parent-icon"><i class='fas fa-users'></i>
                    </div>
                    <div class="menu-title">Utilisateurs</div>
                </a>
            </li>
        @endif

    </ul>


    <!--end navigation-->
</div>
