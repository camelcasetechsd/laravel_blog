
<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li>
                    <a href="{{URL::to('/')}}">Posts</a>
                </li>
                <li>
                    <a href="{{route('show-users')}}">Users</a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @if(Auth::check())
                <li>
                    <a href="{{route('post-create')}}">Add Post</a>
                </li>
                <li>
                    <a href="{{route('my-profile')}}">profile</a>
                </li>
                @else
                <li>
                    <a href="{{URL::to('register')}}">Sign up</a>
                </li>
                <li>
                    <a href="{{URL::to('login')}}">login</a>
                </li>
                @endif

            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>
