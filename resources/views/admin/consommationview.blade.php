@extends('admin.Layout')

@section('title','Résultats')

@section('content')
    <div class="row mt-5">
        <!-- Blood Type Distribution Chart -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    @if ($debut && $fin)
                        La consommation en poche de sang du centre <span class="h-3 text-info">{{ $hospital }}</span> de
                        {{ $debut }} à {{ $fin }} pour le groupe sanguin <span
                            class=" h-4 text-danger">{{ $group_sanguin }}</span>
                    @else
                        La consommation en poche de sang du centre <span class="h-3 text-info">{{ $hospital }}</span>
                        pour le groupe sanguin <span class=" h-4 text-danger">{{ $group_sanguin }}</span>
                    @endif
                </div>
                <div class="card-body">
                    @if ($totalQuantite)
                        <div class="alert alert-success">
                            {{ $totalQuantite }}
                        </div>
                    @else
                        <div class="alert alert-danger">
                            0
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
