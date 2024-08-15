@extends('authentification.layout')

@section('authentification')
    
<form method="POST" action="{{ route('login') }}" class="md-float-material form-material">
    @csrf
    <div class="text-center">
        <img src="assets/images/logo.png" alt="logo.png">
    </div>
    <div class="auth-box card">
        <div class="card-block">
            <div class="row m-b-20">
                <div class="col-md-12">
                    <h3 class="text-center txt-primary">Connexion</h3>
                </div>
            </div>

            <!-- Username -->

            <!-- Email -->
            <div class="form-group form-primary">
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
                    <div class="form-group form-primary">
                        <input type="password" name="password" class="form-control" required>
                        <span class="form-bar"></span>
                        <label class="float-label">Password</label>
                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                
            </div>

            <!-- Terms & Conditions -->
            <div class="row m-t-25 text-left">
                <div class="col-md-6">
                    <div class="checkbox-fade fade-in-primary">
                        <label>
                            <input type="checkbox" value="">
                            <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                            <span class="text-inverse">I read and accept <a href="#">Terms & Conditions.</a></span>
                        </label>
                    </div>
                </div>
                <div class=" col-md-6">
                    <a href="{{ route('password.request')}}"> Vous avez oublié votre mot de passe ?</a>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="row m-t-30">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20">Se connecter</button>
                </div>
            </div>

            <hr/>
        </div>
    </div>
</form>



@endsection