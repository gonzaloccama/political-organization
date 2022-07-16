<div class="iq-sidebar">
    <?php
    $menus = \App\Models\SystemMenu::where('type', 'user')
        ->orderBy('order', 'asc')
        ->get();
    ?>
    <style>
        .iq-sidebar-menu ul .active a{
            background-color: var(--iq-primary) !important;
            color: #fff !important;
            font-weight: 700 !important;
            box-shadow: 0 0 1px 0 var(--iq-primary) !important;
        }
    </style>
    <div id="sidebar-scrollbar">
        {{--        {{ auth()->user()->user_group }}--}}
        <nav class="iq-sidebar-menu">
            <ul id="iq-sidebar-toggle" class="iq-menu rounded-0" >
                {{--                @foreach($menus as $menu)--}}
                {{--                    @if($menu->route != 'admin.dashboard' || in_array(auth()->user()->user_group, [1, 2]))--}}
                {{--                        <li class="{{ request()->route()->getName() == $menu->route ? 'active' : '' }}">--}}
                {{--                            <a href="{{ route($menu->route) }}" class="iq-waves-effect">--}}
                {{--                                <i class="{{ $menu->icon }}"></i>--}}
                {{--                                <span> {{ $menu->name }}</span>--}}
                {{--                            </a>--}}
                {{--                        </li>--}}
                {{--                    @endif--}}
                {{--                @endforeach--}}
                @foreach($menus as $menu)
                    <?php
                    if (!(int)$menu->is_route) {
                        $idName = str_replace('.', '-', $menu->route);
                    }
                    ?>
                    @if($menu->route != 'admin.dashboard' || in_array(auth()->user()->user_group, [1, 2]))
                        <li class="{{ request()->route()->getName() == $menu->route ? 'active' : '' }}">
                            <a href="{{ (int)$menu->is_route ? route($menu->route) : '#' . $idName }}"
                               class="iq-waves-effect rounded-0"
                               @if($menu->children->count()) data-toggle="collapse" aria-expanded="false" @endif>
                                <i class="{{ $menu->icon }}"></i>
                                <span>{{ $menu->name }}</span>
                                @if($menu->children->count())
                                    <i class="ri-add-line iq-arrow-right"></i>
                                @endif
                            </a>
                            @if($menu->children->count())
                                <ul id="{{ $idName }}" class="iq-submenu collapse"
                                    style="background: linear-gradient(90deg,rgba(1,70,210,0.001) 0%,rgba(1,70,210,0.07) 50%, rgba(1,70,210,0.001) 100%);"
                                    data-parent="#iq-sidebar-toggle">
                                    @foreach($menu->children as $smenu)
                                        <li>
                                            <a href="{{ route($smenu->route) }}">
                                                <i class="iconsminds-voice"></i>{{ $smenu->name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endif
                @endforeach
            </ul>


        </nav>
        <div class="p-3"></div>
    </div>
</div>
