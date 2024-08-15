@extends('admin.Layout')

@section('content')
    <div class="card">
        <div class="card-block caption-breadcrumb">
            <div class="row">
                <div class="col-lg-4">
                    @if($user->picture)
                        <img src="{{ asset('storage/' . $user->picture) }}" class="img-thumbnail" alt="User Picture"/>
                    @else
                        <p>No picture available</p>
                    @endif
                </div>
                <div class="col-lg-6">
                    <div class="breadcrumb-header">
                        <h5>{{ $user->name }}</h5>
                        <span>{{ $user->profession}}</span>
                    </div>
                    <div class="page-header-breadcrumb">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">{{ $user->email}}
                            </li>
                            <li class="breadcrumb-item">{{ $user->telephone}}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>  
        </div>
    </div>


    <div class="card">
        <div class="card-header">
            <h5>Éditer votre profile</h5>
        </div>
        <div class="card-block">
            <form action=" {{ route('admin.profile.update')}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="profession">Profession</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="profession" value="{{ old('profession', $user->profession) }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="telephone">Téléphone</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="telephone" value="{{ old('telephone', $user->telephone) }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Photo de profile</label>
                    <div class="col-sm-10">
                        <input type="file" class="form-control" name="picture">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Soumettre</button>
            </form>
        </div>
    </div>
@endsection
