@extends('admin.Layout')

@section('content')
    <div class=" row">
        @forelse ($blood as $item)
            <div class="col-md-6">
                <div class="card text-center order-visitor-card">
                    <div class="card-block">
                        <h2 class="m-b-0 text-lg">{{ $item->group_sanguin }}</h2>
                        <h4 class="m-t-15 m-b-15">{{ $item->total }}</h4>
                    </div>
                </div>
            </div>
        @empty
            <div class=" alert alert-danger col-lg text-center"> Aucune poche de sang</div>
        @endforelse
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card bg-c-green total-card">
                <div class="card-block">
                    <div class="text-left">
                        <h4>{{ $countblood->total }}</h4>
                        <p class="m-0">Poches de sang</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        
    </div>
    
@endsection
