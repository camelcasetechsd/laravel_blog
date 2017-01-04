@include('layouts.header')
@include('layouts.navigation')
<div class="container">

    <div class="row">
        @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @if(Session::has('message'))
        {!!Session::get('message')!!}
        @endif

        @yield('content')   
    </div>

</div>
@include('layouts.footer')

