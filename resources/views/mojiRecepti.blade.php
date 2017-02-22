@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="lijeviMenu" name="menu" style="float:left; margin-left:-80px; margin-top:20px; font-size:17px">
            <ul><a href="/home">Naslovna</a></ul>
            <ul class="active"><a href="/moji_recepti">Moji recepti</a></ul>
            <ul><a href="/najdrazi_recepti">Najdraži recepti</a></ul>
        </div>

        <div class="row" style="overflow:auto;">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">

                    <div class="panel-heading">
                        <h4> Moji recepti
                        <a href="/new" style="float:right;">Novi recept</a></h4>
                    </div>

                    <div class="panel-body">
                        <ul class="list-group">
                            @foreach(Auth::User()->recipes as $recipe)
                                <li class="list-group-item">
                                    <a href="/moji_recepti/{{$recipe->id}}"> {{$recipe->title}} ({{$recipe->type}})</a>
                                    <a href="/recept/{{$recipe->id}}/delete" style="float:right">Obriši</a>
                                </li>
                            @endforeach
                        </ul>

                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
