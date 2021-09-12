@extends('app')

@section('content')

<div class="container">
    <div class="row">
        <form action="{{route('gifts.create')}}" method="GET">
            @csrf
            <input type="hidden" name="group_id" value="{{$group_id}}">
            <button type="submit" class="btn btn-primary">Proposer un cadeau</button>
        </form>
    </div>
</div>

<div class="container">
    <div class="row">

            <h1 class="text-center">Liste des cadeaux proposés</h1>

            @foreach($gifts as $gift)
            <div class="col-3 mt-5 mb-4">
                <div class="card" style="width: 18rem;">
                    <img src="{{$gift->image}}" class="card-img-top" alt="Image de {{$gift->name}}" style="height: 18rem;">
                    <div class="card-body text-center">
                        <h5 class="card-title">{{$gift->name}}</h5>
                        <p>{{$gift->price}}€</p>
                        <p>{{$gift->description}}</p>
                        <p>Posté par {{$gift->user_nickname}}</p>
                        <form action="{{route('comments.create')}}" method="GET">
                            @csrf
                            <input type="hidden" value="{{$gift->id}}" name="id">
                            <button type="submit" class="btn btn-primary mb-2">Commenter</button>
                        </form>
                        @if($gift->user_id == auth()->id())
                        <form action="{{route('gifts.edit', $gift->id)}}" method="GET">
                            <input type="hidden" name="group_id" value="{{$group_id}}">
                            <button type="submit" class="btn btn-danger mb-2">Editer</button>
                        </form>
                        <form action="{{route('gifts.destroy', $gift->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Supprimer</a>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach


        
    </div>
</div>

@endsection