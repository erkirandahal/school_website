<div class="header-bottom-area header-sticky" style="transition: .6s;">
    <div class="row top-menu-wrapper">
        <a href="{{ route('index') }}">
            <img src="{{ asset('uploads/setting/' . $settings['setting']->local_logo) }}" alt="LOGO" class="app-logo">
        </a>
        <div class="main-menu f-right">
            <nav id="mobile-menu" style="display: block;">
                <ul>
                    @foreach ($menu as $key => $item)
                        <li>
                            <a href="{{ $item->children->count() > 0 ? '#' : url($item->url) }}">
                                @if ($key == 0)
                                    <i class="{{ $item->icon || 'fa fa-home' }}"></i>
                                @endif
                                {{ $item->label_nepali }}
                                @if ($item->children->count() > 0)
                                    <i class="fa fa-angle-down ms-1"></i>
                                @endif
                            </a>
                            @if ($item->children->count() > 0)
                                <ul class="submenu">
                                    @foreach ($item->children as $child)
                                        <li>
                                            <a href="{{ url($child->url) }}">{{ $child->label_nepali }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </nav>
        </div>
        <div class="col-12">
            <div class="mobile-menu"></div>
        </div>
    </div>
</div>
