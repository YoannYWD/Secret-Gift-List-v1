@extends('app')

@section('content')

<main class="login-form">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <h3 class="card-header text-center">Proposer un cadeau</h3>
                    <div class="card-body">
                        <form action="{{route('gifts.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mb-3">
                                <input type="text" placeholder="Nom" class="form-control" name="name" required autofocus>
                                @if($errors->has('name'))
                                <span class="text-danger">{{$errors->first('name')}}</span>
                                @endif
                            </div>

                            <div class="form-group mb-3">
                                <input type="number" placeholder="Prix" class="form-control" name="price" required autofocus>
                                @if($errors->has('price'))
                                <span class="text-danger">{{$errors->first('price')}}</span>
                                @endif
                            </div>

                            <div class="form-group mb-3">
                                <input type="text" placeholder="Description" class="form-control" name="description" required autofocus>
                                @if($errors->has('description'))
                                <span class="text-danger">{{$errors->first('description')}}</span>
                                @endif
                            </div>
                           
                            <div class="form-group mb-3">
                                <label for="formFile" class="form-label">Image</label>
                                <input class="form-control" type="file" name="image">
                            </div>

                            <div class="d-grid mx-auto">
                                <input type="hidden" name="user_id" value="{{auth()->id()}}">
                                <input type="hidden" name="group_id" value="{{$group_id}}">
                                <button type="submit" class="btn btn-dark btn-block">Enregistrer</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<form action="{{route('gifts.index')}}" method="GET">
    @csrf
    <input type="hidden" name="group_id" value="{{$group_id}}">
    <button type="submit" class="btn btn-primary">Revenir au groupe</button>
</form>

@endsection