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

        <h1>Galéria: {{ $gallery->name }}</h1>
        <form action="/gallery/{{ $gallery->id }}" enctype="multipart/form-data" method="post">
            @csrf
            <label for="images" class="h4">Pridaj fotky</label></br>
            <input type="file" name="images[]" id="images" multiple required accept="image/*">
            <input type="hidden" name="gallery_id" value="{{ $gallery->id }}">
            <button class="btn btn-primary" type="submit">Submit</button>
        </form>
        <form method="post" action="/gallery/{{ $gallery->id }}">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit">Delete gallery</button>
        </form>
        <div class="row">
            @foreach($images as $image)
            <div class="col-lg-4 col-md-6 col-sd-12 py-2">
                <a href="/images/0x0/{{ $gallery->slug }}/{{ $image->filename }}"><img class="img-fluid" src="/storage/{{ $gallery->slug }}/{{ $image->filename }}" alt=""></a>
                <form class="d-flex justify-content-center" method="post" action="/image/{{ $image->id }}">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger mt-2" type="submit">Delete image</button>
                </form>
            </div>
            @endforeach
        </div>
    </div>
@endsection
