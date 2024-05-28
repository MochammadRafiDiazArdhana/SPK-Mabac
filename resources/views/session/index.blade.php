@extends('layouts.app')

@section('content')

        {{-- <form action="/session/login" method="POST">
        @csrf
            <div class="form-label-group d-flex flex-column gap-2">
                <label for="email" class="fw-bold">Email</label>
            <input type="email" value="{{ Session::get('email')}}" name="email" class="form-control" placeholder="Email address">
            </div>
        
            <div class="form-label-group">
                <label for="password" class="fw-bold">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Password">
            </div>

            <button class="btn btn-primary" type="submit">Sign in</button>
        </form> --}}
        <div class="m-auto mt-5 p-5">
            <div class="text-center m-auto">
                <h1>
                    Sistem Pendukung Keputusan
                </h1>
                <h2>
                    Metode Multi-Attributive Border Approximation Area Comparison
                </h2>
            </div>
            <div class="text-center w-50 m-auto p-5 border border-secondary rounded mt-5">
                <form action="/session/login" method="POST">
                    @csrf
                    <h1 class="h3 mb-2 fw-normal">Sign In</h1>
                
                    <div class="form-floating mt-4 mb-3">
                      <input value="{{ Session::get('email')}}" name="email" type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                      <label for="floatingInput" >Email address</label>
                    </div>
                    <div class="form-floating my-3">
                      <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
                      <label for="floatingPassword">Password</label>
                    </div>
                    <div>
                        Belum Punya akun?
                        <a href="register">Buat Akun</a>
                    </div>
                    <button class="w-100 mt-4 btn btn-lg btn-primary" type="submit">Sign in</button>
                </form>
            </div>
        </div>
@endsection