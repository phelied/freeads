@extends('layouts.default')
@section('content')
<h2>Creer une annonce</h2>
@if ($message = Session::get('success'))
            <div class="alert alert-success">
                <strong>{{ $message }}</strong>
            </div>
          @endif
    <form method="POST"  action="/create-annonce" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="title">Titre:</label>
            <input type="text" class="form-control" id="title" name="title">
        </div>

        <div class="form-group">
            <label for="description">Description:</label>
            <input type="textarea" class="form-control" id="description" name="description">
        </div>

        <div class="form-group">
            <label for="price">Prix:</label>
            <input type="text" class="form-control" id="price" name="price">
        </div>

        <div class="form-group">
            <label for="pictures"> Selectionner une/des image(s):</label>
            <input type="file" class="form-control" id="pictures" placeholder="adress" name="pictures[]" multiple>
        </div>

        <div class="form-group">
            <button style="cursor:pointer" type="submit" >Submit</button>
        </div>


    </form>

@stop