@extends('admin.Layout')

@section('content')

<div class=" row mb-5">
    <div>
        <h3> Retirer des poches de sang</h3>
    </div>
</div>

<form action="{{ route('admin.blood.update',Auth::user()->id)}}" method="post" class="form-material">
    @csrf
    @method('PUT')
    <div class="form-group form-default form-static-label">
        <select name="group_sanguin" id="group_sanguin" class="form-control" required>
            <option value="A+">A+</option>
            <option value="B+">B+</option>
            <option value="A-">A-</option>
            <option value="AB+">AB+</option>
            <option value="AB-">AB-</option>
            <option value="0-">O-</option>
            <option value="0+">O+</option>
        </select>
        <span class="form-bar"></span>
        <label class="float-label text-danger">Groupe sanguin</label>
    </div>
    <div class="form-group form-default form-static-label">
        <input type="number" name="quantite" class="form-control" id="quantite" min="1" required>
        <span class="form-bar"></span>
        <label class="float-label text-danger" for="quantite">Quantité</label>
    </div>
    <div class="form-group form-default form-static-label">
        <select type="number" name="capacite" class="form-control" id="capacite" required>
            <option value="300">300</option>
        </select>
        <span class="form-bar"></span>
        <label class="float-label text-danger" for="capacite">Capacité <span class="text-info">(ml)</span></label>
    </div>
    <button class="btn btn-primary" type="submit">Soumettre</button>
</form>
@endsection