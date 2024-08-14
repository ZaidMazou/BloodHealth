@extends('admin.Layout')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class=" text-danger">Liste des hôpitaux</h5>

        <div class="card-header-right">
            <ul class="list-unstyled card-option">
                <li><i class="fa fa fa-wrench open-card-option"></i></li>
                <li><i class="fa fa-window-maximize full-card"></i></li>
                <li><i class="fa fa-minus minimize-card"></i></li>
                <li><i class="fa fa-refresh reload-card"></i></li>
                <li><i class="fa fa-trash close-card"></i></li>
            </ul>
        </div>
    </div>
    <div class="card-block table-border-style">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Téléphone</th>
                        <th>Adresse</th>
                        <th>Administrateur</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($hospitals as $item)
                        <tr>
                            <th scope="row">{{ $item->id}}</th>
                            <td>{{ $item->name}}</td>
                            <td>{{ $item->email}}</td>
                            <td>{{ $item->telephone}}</td>
                            <td>{{ $item->adresse}}</td>
                            <td>{{ $item->admin}}</td>
                            <td><i class="fa fa-refresh reload-card text-success"></i></td>
                        </tr>
                    @empty
                    <div class="alert alert-danger col-md">Aucun hôpital</div>
                    @endforelse

                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection