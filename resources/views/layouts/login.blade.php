@extends('layouts.template')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header text-dark bg-white">
                        <h3 class="text-center font-weight-light my-3">Login</h3>
                    </div>
                    <div class="card-body">
                        <form action="/login" method="POST">
                            @csrf
                            
                            <div class="form-floating mb-3">
                                <input name="email" type="email" 
                                    class="form-control @error('email') is-invalid @enderror" 
                                    id="emailInput" placeholder="name@example.com"
                                    value="{{ old('email') }}">
                                <label for="emailInput">Email address</label>
                                @error('email')
                                    <div class="invalid-feedback">
                                        <i class="bi bi-exclamation-circle-fill"></i> {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            
                            <div class="form-floating mb-3">
                                <input name="password" type="password" 
                                    class="form-control @error('password') is-invalid @enderror" 
                                    id="passwordInput" placeholder="Password">
                                <label for="passwordInput">Password</label>
                                @error('password')
                                    <div class="invalid-feedback">
                                        <i class="bi bi-exclamation-circle-fill"></i> {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" id="rememberMe">
                                <label class="form-check-label" for="rememberMe">Remember me</label>
                            </div>
                            
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-success btn-lg">
                                    <i class="bi bi-box-arrow-in-right"></i> Sign In
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-center py-3">
                        <div class="small">
                            <a href="/forgot-password">Forgot password?</a>
                        </div>
                        <div class="small mt-2">
                            Need an account? <a href="/register">Sign up</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        .card {
            border: none;
            border-radius: 10px;
            overflow: hidden;
        }
        
        .card-header {
            padding: 1.5rem;
            border-bottom: none;
        }
        
        .form-floating label {
            padding: 1rem 0.75rem;
        }
        
        .btn-primary {
            background-color: #4e73df;
            border: none;
            padding: 0.75rem;
            font-size: 1.1rem;
            transition: all 0.3s;
        }
        
        .btn-primary:hover {
            background-color: #2e59d9;
            transform: translateY(-1px);
        }
        
        a {
            color: #4e73df;
            text-decoration: none;
            transition: color 0.3s;
        }
        
        a:hover {
            color: #2e59d9;
            text-decoration: underline;
        }
    </style>
@endsection