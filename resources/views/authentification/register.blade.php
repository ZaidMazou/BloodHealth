@extends('authentification.layout')

@section('authentification')
<form method="POST" action="{{ route('register') }}" class="md-float-material form-material">
    @csrf
    <div class="text-center">
        <img src="assets/images/logo.png" alt="logo.png">
    </div>
    <div class="auth-box card">
        <div class="card-block">
            <div class="row m-b-20">
                <div class="col-md-12">
                    <h3 class="text-center txt-primary">Sign up</h3>
                </div>
            </div>

            <!-- Username -->
            <div class="form-group form-primary">
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required autofocus>
                <span class="form-bar"></span>
                <label class="float-label">Choose Username</label>
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

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

                <!-- Confirm Password -->
                <div class="col-sm-6">
                    <div class="form-group form-primary">
                        <input type="password" name="password_confirmation" class="form-control" required>
                        <span class="form-bar"></span>
                        <label class="float-label">Confirm Password</label>
                    </div>
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

@endsection