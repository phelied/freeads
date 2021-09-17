@extends('layouts.default')
@section('content')
<h2>Connexion</h2>

@if($errors)
@foreach($errors->all() as $error)
<div class="alert alert-danger" role="alert">
    {{ $error }}
</div>
@endforeach
@endif

<form method="POST" action="/login">
    {{ csrf_field() }}

    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" class="form-control" id="email" name="email">
    </div>

    <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" class="form-control" id="password" name="password">
    </div>

    <div class="form-group">
        <label for="">Remember Me</label>
        <input type="checkbox" name="remember_me">
    </div>

    <div class="form-group">
        <button style="cursor:pointer" type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>
<a href="/register"><button class="btn btn-light">Vous n'avez pas encore de compte?</button></a>
@stop