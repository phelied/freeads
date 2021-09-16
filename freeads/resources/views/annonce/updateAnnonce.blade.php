@extends('layouts.default')
@section('content')
<h2>Creer une annonce</h2>
@if ($message = Session::get('success'))
<div class="alert alert-success">
    <strong>{{ $message }}</strong>
</div>
@endif

@foreach ($annonces as $user)

<form method="POST" action="/change-annonce/{{ $user->id }}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="card" style="width: 18rem;">
        <div id="carouselExampleControls-{{ $user->id }}" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            @foreach ($user->pictures as $key => $picture)
            <div class="carousel-item {{$key == 0 ? 'active' : '' }}">
                <img src={{ $picture }} class="card-img-top" alt="...">
            </div>
            @endforeach
        </div>
        @if (count($user->pictures) > 1)
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls-{{ $user->id }}" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls-{{ $user->id }}" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
        @endif
    </div>
    </div>
    <div class="form-group">
        <label for="title">Titre:</label>
        <input type="text" class="form-control" id="title" name="title" value={{ $user->title }}>
    </div>

    <div class="form-group">
        <label for="description">Description:</label>
        <input type="textarea" class="form-control" id="description" name="description" value={{ $user->description }}>
    </div>

    <div class="form-group">
        <label for="price">Prix:</label>
        <input type="text" class="form-control" id="price" name="price" value={{ $user->price }}>
    </div>

    <div class="form-group">
        <label for="pictures"> Selectionner une image:</label>
        <input type="file" class="form-control" id="pictures" placeholder="adress" name="pictures[]" multiple>
    </div>

    <div class="form-group">
        <button style="cursor:pointer" type="submit" >Submit</button>
    </div>
</form>
@endforeach

@stop