@extends('layouts.app') @section('content')
<div class="album py-5">
    <div class="container">

        <div class="row">
            @foreach($books as $book)
            <div class="col-md-4 d-flex align-items-stretch">
                <a href="{{ route('book.show', $book->slug) }}" style="text-decoration: none;" class="text-info">
                <div class="card mb-4" style="max-width: 540px;">
                    <div class="row no-gutters">
                        <div class="col-md-4">
                            <img src="{{ $book->picture }}" class="card-img" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">{{ $book->title }}</h5>
                                <p class="card-text">{{ $book->user->name }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                </a>
            </div>
            @endforeach
        </div>
        {{$books->appends(Request::all())->links()}}
    </div>
</div>
@endsection