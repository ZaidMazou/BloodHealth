@extends('admin.Layout')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class=" text-danger">Liste des poches de sang</h5>

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
                            <th>Groupe sanguin</th>
                            <th>Capacité <span class="text-danger">(ml)</span></th>
                            <th>Quantité</th>
                            <th>Date d'enregistrement</th>
                            <th>Date de modification</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($blood as $item)
                            <tr>
                                <th scope="row">{{ $item->id}}</th>
                                <td>{{ $item->group_sanguin}}</td>
                                <td>{{ $item->capacite}}</td>
                                <td>{{ $item->quantite}}</td>
                                <td>{{ $item->created_at}}</td>
                                <td>{{ $item->updated_at->format('d/m/Y')}}</td>
                            </tr>
                        @empty
                        <div class="alert alert-danger col-md">Aucune poche</div>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
