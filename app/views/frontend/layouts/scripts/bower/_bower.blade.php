{{-- includes scripts appropriate to the environment --}}
@if( is_local() )
    @include('layouts.scripts.bower._local')
@else
    @include('layouts.scripts.bower._release')
@endif
