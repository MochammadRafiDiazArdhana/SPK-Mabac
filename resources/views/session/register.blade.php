@extends('layouts.app')

@section('content')
        <form action="/session/register" method="POST">
        @csrf
            <div class="form-label-group d-flex flex-column gap-2">
                <label for="name" class="fw-bold">Nama</label>
            <input type="text" value="{{ Session::get('name')}}" name="name" class="form-control" placeholder="Nama">
            </div>
            <div class="form-label-group d-flex flex-column gap-2">
                <label for="email" class="fw-bold">Email</label>
            <input type="email" value="{{ Session::get('email')}}" name="email" class="form-control" placeholder="Email address">
            </div>
            <div class="form-label-group">
                <label for="password" class="fw-bold">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Password">
            </div>
            <button class="btn btn-primary" type="submit">Sign in</button>
        </form>
@endsection