@extends('app')

@section('content')

<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-2">
            <img src="{{$gift[0]->image}}" class="card-img-top" alt="Image de {{$gift[0]->name}}">
        </div>
        <div class="col-10 text-center">
            <h5 class="card-title">{{$gift[0]->name}}</h5>
            <p>{{$gift[0]->price}}€</p>
            <p>{{$gift[0]->description}}</p>
            <p>Posté par {{$gift[0]->user_nickname}}</p>
        </div>
    </div>
</div>

<div class="container mt-5 mb-5">
    @foreach($comments as $comment)
    <div class="row">
        <p>{{$comment->content}}</p>
        <p>Posté par {{$comment->user_nickname}} le {{$comment->created_at}}</p>
    </div>
    @endforeach
</div>

<div class="container mb-5">
    <div class="row">
        <form action="{{route('comments.store')}}" method="POST">
            <input type="hidden" name="group_id" value="{{$gift[0]->id}}">
            <input type="hidden" name="group_id" value="{{auth()->id()}}">
            <input type="text" class="form-control" name="content" placeholder="Votre commentaire...">
            <button type="submit" class="btn btn-primary mt-2">Poster</button>
        </form>
    </div>
</div>

<div class="container mb-5">
    <div class="row">
        <form action="" method="GET">
            @csrf
            <input type="hidden" name="group_id" value="{{$gift[0]->group_id}}">
            <button type="submit" class="btn btn-primary">Revenir au groupe</button>
        </form>
    </div>
</div>

@endsection