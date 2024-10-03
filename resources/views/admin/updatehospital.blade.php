@extends('admin.Layout')
@section('title','Modifier les information de votre hôpital')
@section('content')
    <div class="container">
        <h2>Modifier l'Hôpital</h2>
           
        <form action="{{ route('admin.hopital.update', $hospital->id) }}" method="POST" class="form-material">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Nom</label>
                <input type="text" name="name" id="name" class="form-control"
                    value="{{ old('name', $hospital->name) }}" required>
                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control"
                    value="{{ old('email', $hospital->email) }}" required>
                @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="telephone">Téléphone</label>
                <input type="text" name="telephone" id="telephone" class="form-control"
                    value="{{ old('telephone', $hospital->telephone) }}" required>
                @error('telephone')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="adresse">Adresse</label>
                <input type="text" name="adresse" id="adresse" class="form-control"
                    value="{{ old('adresse', $hospital->adresse) }}" required>
                @error('adresse')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Mettre à jour</button>
        </form>
    </div>
@endsection
