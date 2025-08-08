@extends('layouts.app')

@section('title', 'Register - BookStore')

@section('content')
<div class="min-vh-100 d-flex align-items-center py-5" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-7 col-md-9">
                <div class="card shadow-lg border-0" style="border-radius: 20px;">
                    <div class="card-body p-0">
                        <!-- Header Section -->
                        <div class="text-center py-5 px-4" style="background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%); border-radius: 20px 20px 0 0;">
                            <div class="mb-3">
                                <i class="fas fa-book-open fa-3x text-white"></i>
                            </div>
                            <h2 class="text-white fw-bold mb-2">Join BookStore</h2>
                            <p class="text-white-50 mb-0">Start your journey of lending and borrowing books</p>
                        </div>

                        <!-- Form Section -->
                        <div class="p-4 p-md-5">
                            @if ($errors->any())
                                <div class="alert alert-danger mb-4">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                
                                <!-- Hidden field to automatically set role as 'user' -->
                                <input type="hidden" name="role" value="user">
                                
                                <!-- Personal Information -->
                                <div class="row g-3 mb-4">
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" 
                                                   class="form-control @error('name') is-invalid @enderror" 
                                                   id="name" 
                                                   name="name" 
                                                   value="{{ old('name') }}" 
                                                   placeholder="Full Name"
                                                   required 
                                                   autofocus>
                                            <label for="name">Full Name</label>
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="email" 
                                                   class="form-control @error('email') is-invalid @enderror" 
                                                   id="email" 
                                                   name="email" 
                                                   value="{{ old('email') }}" 
                                                   placeholder="Email Address"
                                                   required>
                                            <label for="email">Email Address</label>
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="tel" 
                                                   class="form-control @error('phone') is-invalid @enderror" 
                                                   id="phone" 
                                                   name="phone" 
                                                   value="{{ old('phone') }}" 
                                                   placeholder="Phone Number"
                                                   required>
                                            <label for="phone">Phone Number</label>
                                            @error('phone')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" 
                                                   class="form-control @error('address') is-invalid @enderror" 
                                                   id="address" 
                                                   name="address" 
                                                   value="{{ old('address') }}" 
                                                   placeholder="Address"
                                                   required>
                                            <label for="address">Address</label>
                                            @error('address')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-floating">
                                            <textarea class="form-control @error('bio') is-invalid @enderror" 
                                                      id="bio" 
                                                      name="bio" 
                                                      placeholder="Bio"
                                                      style="height: 100px;">{{ old('bio') }}</textarea>
                                            <label for="bio">Bio (Optional)</label>
                                            @error('bio')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Security -->
                                <div class="row g-3 mb-4">
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="password" 
                                                   class="form-control @error('password') is-invalid @enderror" 
                                                   id="password" 
                                                   name="password" 
                                                   placeholder="Password"
                                                   required>
                                            <label for="password">Password</label>
                                            @error('password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="password" 
                                                   class="form-control" 
                                                   id="password_confirmation" 
                                                   name="password_confirmation" 
                                                   placeholder="Confirm Password"
                                                   required>
                                            <label for="password_confirmation">Confirm Password</label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Terms & Submit -->
                                <div class="mb-4">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="terms" required>
                                        <label class="form-check-label" for="terms">
                                            I agree to the <a href="#" class="text-decoration-none">Terms and Conditions</a>
                                        </label>
                                    </div>
                                </div>

                                <div class="d-grid mb-4">
                                    <button type="submit" class="btn btn-primary btn-lg" 
                                            style="background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%); border: none;">
                                        Create Account
                                    </button>
                                </div>

                                <div class="text-center">
                                    <p class="mb-0 text-muted">Already have an account?</p>
                                    <a href="{{ route('login') }}" class="text-decoration-none fw-semibold">
                                        Sign in here
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
