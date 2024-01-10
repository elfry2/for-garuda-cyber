@if(Route::has($resource . '.create'))
<a href="{{ route($resource . '.create') }}" class="btn ms-2 hide-on-small-screens" title="Create new {{ $resource }}"><i class="bi-plus-lg"></i><span
    class="ms-2">New</span></a>
<a href="{{ route($resource . '.create') }}" class="border bg-{{ preference('theme', 'light') }} text-{{ preference('theme', 'light') == 'light' ? 'dark' : 'light' }} shadow hide-on-big-screens d-flex align-items-center justify-content-center" style="width: 4em; height: 4em; border-radius: 4em; position: fixed; right: 1em; bottom: 1em; z-index: 1" title="Create new {{ $resource }}"><i class="bi-plus-lg"></i></a>
@endif
