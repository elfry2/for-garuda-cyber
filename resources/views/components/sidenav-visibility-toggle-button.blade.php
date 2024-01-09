<form action="{{ route('preference.store') }}" method="post">
    @csrf
    {{-- <input type="hidden" name="redirectTo" value="{{ url()->current() }}"> --}}
    <input type="hidden" name="key" value="sidenav.display">
    <button id="sidenavVisibilityToggleButton" type="submit" name="value"
        value="{{ preference('sidenav.display', 'block') == 'block' ? 'none' : 'block' }}" class="btn" title="Toggle sidenav visibility"><i
            class="bi-list"></i></button>
</form>