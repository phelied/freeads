@extends('layouts.default')
@section('content')

<h2>Changer profil</h2>

@if ($message = Session::get('success'))
<div class="alert alert-success">
    <strong>{{ $message }}</strong>
</div>
@endif
<form method="POST" action="{{ route('update') }}">
    {{ csrf_field() }}

    @if($errors)
    @foreach($errors->all() as $error)
    <div class="alert alert-danger" role="alert">
        {{ $error }}
    </div>
    @endforeach
    @endif

    <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" id="name" class="form-control" name="name" readonly='readonly'value={{ auth()->user()->name }}>
    </div>

    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" class="form-control" id="email" name="email" value={{ auth()->user()->email }}>
    </div>

    <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="change password">
    </div>

    <div class="form-group">
        <input id="prodId" name="prodId" type="hidden" value={{ auth()->user()->id }}>
    </div>



    <div class="form-group">
        <button style="cursor:pointer" type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>
@stop