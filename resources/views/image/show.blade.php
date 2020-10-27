@extends('layouts.app')

@section('content')
    <div class="container">
                <img src="/storage/{{ $slug }}/{{ $filename }}" style="width: {{ $w }}px;height: {{ $h }}px">
    </div>
@endsection
