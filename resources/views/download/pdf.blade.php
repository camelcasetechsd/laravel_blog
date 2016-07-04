<h1>{{$title}}</h1>
<!-- Author -->
<p class="lead">
    by <a href="javascript:void(0)">{{$author}}</a>
</p>
<hr>

<!-- Date/Time -->
<p><span class="glyphicon glyphicon-time"></span> Posted on {{ date('F d, Y', strtotime($created_at)) }} <br /></p>
<hr>

<!-- Preview Image -->
<img class="img-responsive" width="300px" height="300px" src="{{$image}}" alt="">
<hr>

<!-- Post Content -->
{{$content}}

