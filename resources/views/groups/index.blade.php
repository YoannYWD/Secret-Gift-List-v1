@extends('app')

@section('content')

<div class="container">
    <div class="row">

            <h1 class="text-center">Liste des groupes</h1>
            @foreach($groups as $group)
            @if($group->user_id !== auth()->id())
            <div class="col-3 mt-5 mb-4">
                <div class="card" style="width: 18rem;">
                    <div class="card-body text-center">
                        <h5 class="card-title">{{$group->name}}</h5>
                    </div>
                </div>
            </div>
            @endif
            @endforeach

        
    </div>
</div>


@endsection