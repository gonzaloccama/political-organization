<div class="iq-sidebar">
    <?php
    $menus = \App\Models\SystemMenu::where('type', 'user')
        ->orderBy('order', 'asc')
        ->get();
    ?>
    <div id="sidebar-scrollbar">
        {{--        {{ auth()->user()->user_group }}--}}
        <nav class="iq-sidebar-menu">
            <ul id="iq-sidebar-toggle" class="iq-menu">
                @foreach($menus as $menu)
                    @if($menu->route != 'admin.dashboard' || in_array(auth()->user()->user_group, [1, 2]))
                        <li class="{{ request()->route()->getName() == $menu->route ? 'active' : '' }}">
                            <a href="{{ route($menu->route) }}" class="iq-waves-effect">
                                <i class="{{ $menu->icon }}"></i>
                                <span> {{ $menu->name }}</span>
                            </a>
                        </li>
                    @endif
                @endforeach
            </ul>
        </nav>
        <div class="p-3"></div>
    </div>
</div>
