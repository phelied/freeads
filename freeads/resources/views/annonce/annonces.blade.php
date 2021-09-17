@extends('layouts.default')
@section('content')

@if (!empty($annonces))

@foreach ($annonces as $user)


<div class="card" style="width: 18rem;">
    <a href="/show/{{ $user->id }}" style="text-decoration: none;">
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
        <div class="card-body">
            <h5 class="card-title">{{ $user->title }}</h5>
            <p class="card-text">{{ $user->description }}</p>
            <a href="#" class="btn btn-primary">{{ $user->price }}$</a>
        </div>
</div>
</a>
@endforeach
@else
<div class="d-flex justify-content-center">
    <p class=".text-secondary">Il n'y as pas d'annonces</p>
</div>


@endif
@stop