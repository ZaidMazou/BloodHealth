@extends('admin.Layout')

@section('content')
    <form action="{{ route('transactions/export-pdf')}}" method="get">
        @csrf
        <div class="form-group form-default form-static-label">
            <input type="date" name="start_date" class="form-control" id="start_date">
            <span class="form-bar"></span>
            <label class="float-label " for="start_date">Date de début</label>
        </div>
        <div class="form-group form-default form-static-label">
            <input type="date" name="end_date" class="form-control" id="end_date">
            <span class="form-bar"></span>
            <label class="float-label " for="end_date">Date de fin</label>
        </div>
        <button type="submit" class="btn btn-primary">Télécharger</button>
    </form>
@endsection