@extends('layouts.app')

@section('content')
    <h1>{{$title}}</h1>
    @if(count($services) > 0)
        @foreach($services as $service)
        <ul class="list-group">
        <li class="list-group-item">{{$service}}</li>
        </ul>   
        @endforeach
    @endif
@endsection