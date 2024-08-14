@extends('admin.Layout')

@section('content')
    @if (!empty($hospital))
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h5 class="card-header-text">Détails de l'Hôpital</h5>
            </div>
            <div class="card-block accordion-block">
                <div class="accordion-box" id="hospital-details">
                    <!-- Nom de l'Hôpital -->
                    <a class="accordion-msg waves-effect waves-dark">Nom</a>
                    <div class="accordion-desc">
                        <p>{{ $hospital->name }}</p>
                    </div>

                    <!-- Email de l'Hôpital -->
                    <a class="accordion-msg waves-effect waves-dark">Email</a>
                    <div class="accordion-desc">
                        <p>{{ $hospital->email }}</p>
                    </div>

                    <!-- Téléphone de l'Hôpital -->
                    <a class="accordion-msg waves-effect waves-dark">Téléphone</a>
                    <div class="accordion-desc">
                        <p>{{ $hospital->telephone }}</p>
                    </div>

                    <!-- Adresse de l'Hôpital -->
                    <a class="accordion-msg waves-effect waves-dark">Adresse</a>
                    <div class="accordion-desc">
                        <p>{{ $hospital->adresse }}</p>
                    </div>

                    <a href="{{ route('admin.hopital.edit',$hospital->id)}}" class=" btn btn-primary">Modifier les informations</a>
                </div>
            </div>
        </div>
    </div>
    @else
        <div class="alert alert-danger col-lg">Aucun hopital</div>
    @endif
@endsection
