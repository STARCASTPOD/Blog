@extends('layouts.app')

@section('head')
<style>
    .card-deck .card{
        /* min-height: 400px; */
        min-width: 300px;
        max-width: 300px;
        margin: 1.5rem 0.7rem;
    }
    .card-deck .card img.card-img-top{
        max-height: 40%;
    }

</style>
@endsection

@section('content')

    <div class="container">
        <div class="card-deck">

            @foreach ($users as $user)
                <div class="card">
                    <img src="{{URL::to('storage/profile_pictures/' .$user->details['avatar'])}}" alt="user" class="card-img-top">
                    <div class="card-body">
                    <div class="card-title"><h2>{{ $user->name }}</h2><small>@ {{$user->username }}</small></div>
                        <p>{{$user->details['bio']}}</p>

                        <ul class="list-inline my-3">
                            @if ( $user->details['facebook'])
                        <li class="list-inline-item"><a href="{{$user->details['facebook']}}"><i class="fab fa-facebook fa-2x"></i></a></li>
                            @endif
                            @if ( $user->details['twitter'])
                        <li class="list-inline-item"><a href="{{$user->details['twitter']}}"><i class="fab fa-twitter fa-2x"></i></a></li>
                            @endif
                            @if ( $user->details['instagram'])
                                <li class="list-inline-item"><a href="{{$user->details['instagram']}}"><i class="fab fa-instagram fa-2x"></i></a></li>
                            @endif
                        </ul>
                    </div>
                    <div class="card-footer">
                        <a href="{{URL::to('users/@'.$user->username)}}" class="btn btn-sm btn-primary">See profile</a>
                    </div>
                </div>
            @endforeach

        </div>

        <div class="mt-3 mx-auto">
        {{ $users->links() }}
        </div>
    </div>

@endsection