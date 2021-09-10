@extends('app')

@section('content')

<main class="login-form">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <h3 class="card-header text-center">S'enregistrer</h3>
                    <div class="card-body">
                        <form action="{{route('userRegistration')}}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <input type="text" placeholder="Nom" class="form-control" name="lastname" required autofocus>
                                @if($errors->has('lastname'))
                                <span class="text-danger">{{$errors->first('lastname')}}</span>
                                @endif
                            </div>

                            <div class="form-group mb-3">
                                <input type="text" placeholder="Prénom" class="form-control" name="firstname" required autofocus>
                                @if($errors->has('firstname'))
                                <span class="text-danger">{{$errors->first('firstname')}}</span>
                                @endif
                            </div>

                            <div class="form-group mb-3">
                                <input type="text" placeholder="Pseudo" class="form-control" name="nickname" required autofocus>
                                @if($errors->has('nickname'))
                                <span class="text-danger">{{$errors->first('nickname')}}</span>
                                @endif
                            </div>

                            <div class="form-group mb-3">
                                <input type="email" placeholder="Email" class="form-control" name="email" required autofocus>
                                @if($errors->has('email'))
                                <span class="text-danger">{{$errors->first('email')}}</span>
                                @endif
                            </div>

                            <div class="form-group mb-3">
                                <input type="password" placeholder="Mot de passe" class="form-control" name="password" required autofocus>
                                @if($errors->has('password'))
                                <span class="text-danger">{{$errors->first("password")}}</span>
                                @endif
                            </div>

                            <div class="d-grid mx-auto">
                                <button type="submit" class="btn btn-dark btn-block">S'enregistrer</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection