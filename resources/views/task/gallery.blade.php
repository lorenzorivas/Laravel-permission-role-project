<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Responsive css-grid masonry gallery with lightbox</title>
  <link rel="stylesheet" href="{{ asset('/css/gallery.style.css') }}">
</head>
<body>
<body>
  <a href="#" class="prev">&lt;</a>
	<a href="#" class="next">&gt;</a>
	<a class="navbar-brand" href="{{ url('gallery') }}">
        {{ config('app.name', 'Laravel') }}
    </a>
  {{-- {!! Form::open(['route' => 'gallery.store']) !!} --}}
  <form class="form-inline" action="{{ route('gallery.store') }}">
  @csrf
  <input type="text" name="picture" class="form-control">
  <button class="btn btn-info" type="submit">Agregar</button>
  {!! Form::close() !!}
	<main class="container">
		@foreach($galleries as $gallery)
		<div class="badge"><img src="{{ $gallery->picture }}" alt=""></div>
		@endforeach
	</main>
</body>
<script  src="{{ asset('/js/gallery.script.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type="text/javascript">
var classes = ['vertical','horizontal','big',''];
var randomBadges = function() {
  var divCount = 75;
  var randomDivCount = Math.floor(Math.random() * divCount);
  var randomEl, randomClass;
  do {
    randomEl = Math.floor(Math.random() * divCount);
    randomClass = classes[Math.floor(Math.random() * 3)];
    $('.badge').eq(randomEl).addClass(randomClass);
    randomDivCount--;
  } while (randomDivCount >= 0);
}
randomBadges();
</script>
</body>
</html>