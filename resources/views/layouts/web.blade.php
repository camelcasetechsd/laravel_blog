@include('layouts.header')
@include('layouts.navigation')
<div class="container">

    <div class="row">
        @yield('content')   
    </div>

</div>
@include('layouts.footer')

