@extends('layouts.app')

@section('content')
<div class="container">

    <div class="lijeviMenu" name="menu" style="float:left; margin-left:-80px; margin-top:20px; font-size:17px">
        <ul class="active"><a href="/home">Naslovna</a></ul>
        <ul><a href="/moji_recepti">Moji recepti</a></ul>
        <ul><a href="/najdrazi_recepti">Najdraži recepti</a></ul>
    </div>


    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">

                <div class="panel-body" >
                    <div class="panel-heading" >

                        <form method="GET" action="/home/pretraga" >
                            <!-- ovo se mora dodati jer sigurnost laravela inače ne da -->
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <select name="searchTag" class="form-control" style="width:130px; float:left;">
                                <option selected="selected" value="0">Pretraga po</option>
                                <option value="1">Vrsta</option>
                                <option value="2">Namirnice</option>
                                <option value="3">Korisnik</option>
                            </select>

                            <input name="searchInput" type="text" class="form-control" placeholder="Pretraži..." style="float:left; width:63%;">

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary" style="width:100px;">Pretraži</button>
                            </div>
                        </form>

                    </div>
                </div>

                    <!-- popis recepata -->
                    <div class="row" style="margin-left: 10%;">

                        @foreach($recepti as $recept)
                            <?php
                                $path = DB::table('images')->where('recipe_id', $recept->id)->value('path'); ?>
                            <div class="col-sm-4">
                                <a href="/recepti/{{$recept->id}}">
                                <img src="{{ URL::to('/') }}/{{$path}}" class="img-responsive margin" style="width:90px; height:90px;" alt="Image">
                                {{$recept->user->name}} {{$recept->user->surname}}<br>
                                {{$recept->title}}
                                </a>
                            </div>
                        @endforeach

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <script>
                    alert('{{ $error }}');
                </script>
            @endforeach
        </ul>
    </div>
@endif