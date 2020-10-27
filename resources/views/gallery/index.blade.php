@extends('layouts.app')

@section('content')
    <div class="container">
        @if(count($errors) > 0 )
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <ul class="p-0 m-0" style="list-style: none;">
                @foreach($errors->all() as $error)
                <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="row">
        @foreach($galleries as $gallery)
            <div class="col-lg-4 col-md-6 col-sd-12 bg-light m-2 p-2">
                <a class="h1 d-flex flex-column justify-content-center text-center text-decoration-none text-dark" href="/gallery/{{ $gallery->slug }}">
                    <!--<img class-->
                    @if(!empty($gallery->getImage()))
                        <img class="img-fluid" src="/storage/{{ $gallery->slug }}/{{ $gallery->getImage()->filename }}">
                        {{ $gallery->name }}
                    @else
                        <img class="img-fluid" src="/storage/emptyGallery.png">
                        {{ $gallery->name }}
                    @endif
                </a>
            </div>
        @endforeach
        </div>
    </div>
@endsection