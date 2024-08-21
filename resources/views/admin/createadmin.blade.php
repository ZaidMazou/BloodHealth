@extends('admin.Layout')

@section('content')
<div class=" row">
    <h2>Créer un administrateur</h2>
</div>
<div class=" row mt-5">
    <div class=" col-lg-8">
        <form method="POST" action="{{ route('admin.user.store') }}" class="md-float-material form-material">
            @csrf
                <!-- Username -->
                    <div class="form-group form-primary form-static-label">
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}" required autofocus>
                        <span class="form-bar"></span>
                        <label class="float-label">Choose Username</label>
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
        
                    <!-- Email -->
                    <div class="form-group form-primary form-static-label">
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                        <span class="form-bar"></span>
                        <label class="float-label">Your Email Address</label>
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
        
                    <div class="row">
                        <!-- Password -->
                        <div class="col-sm-6">
                            <div class="form-group form-primary form-static-label">
                                <input type="password" name="password" class="form-control" required>
                                <span class="form-bar"></span>
                                <label class="float-label">Password</label>
                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
        
                        <!-- Confirm Password -->
                        <div class="col-sm-6">
                            <div class="form-group form-primary form-static-label">
                                <input type="password" name="password_confirmation" class="form-control" required>
                                <span class="form-bar"></span>
                                <label class="float-label">Confirm Password</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class=" form-group form-primary form-static-label">
                            <select name="admin" id="admin" class="form-control">
                                <option value="0">Admin</option>
                                <option value="1">SuperAdmin</option>
                            </select>
                            <label for="admin" class="float-label">SuperAdmin ??</label>
                        </div>
                    </div>
        
        
                    <!-- Submit Button -->
                    <div class="row m-t-30">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20">Sign up now</button>
                        </div>
                    </div>
        
                    <hr/>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection