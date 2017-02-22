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
                        <h4><b>{{$recept->title}} ({{$recept->type}}) </b>

                        @if (Auth::user()->id != $recept->user_id)
                        <form method="GET" action="/recept/{{$recept->id}}/like" style="float:right">

                            <!-- ovo se mora dodati jer sigurnost laravela inače ne da -->
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            
                                <div class="form-group">
                                <button type="submit" class="btn btn-primary">
                                Sviđa mi se</button>
                            </div>
                        </form>
                        @endif
                        </h4>
                    </div>
                    <img src="{{ URL::to('/') }}/{{$path}}" style="width:80%; height:300px; margin-left:10%;">

                    <br>
                    <div class="panel-body">
                        {{$recept->text}}
                    </div>
                </div>
            </div>
        </div>
  
    </div>

    <!-- komentari -->
        <div style="margin-left:30%" >

            <form method="POST" action="/recepti/{{$recept->id}}/komentiraj">
                <!-- ovo se mora dodati jer sigurnost laravela inače ne da -->
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <!-- kako smo nazvali u bazi text note, tu će i spremiti iduće -->
                <div class="form-group" style="width:50%; float:left">
                    <input type="string" name="komentar" class="form-control"></input>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Dodaj komentar!</button>
                </div>
            </form>
        </div>


    @if( count($recept->comments)>0 )
        @foreach($recept->comments as $comment)
        <div class="row" style=" margin-left:28%;">
            <div class="col-sm-1">
                <div class="thumbnail">
                    <img class="img-responsive user-photo" src="https://ssl.gstatic.com/accounts/ui/avatar_2x.png">
                </div>
            </div>

            <div class="col-sm-5">
                <div class="panel panel-default">
                    <div class="panel-heading">
                    <strong> {{$comment->user->name}} {{$comment->user->surname}} </strong> <span class="text-muted"> {{$comment->timestamp}}</span>
                    </div>
                    <div class="panel-body"> {{$comment->tekst}} </div>
                </div>
            </div>
        </div>
        @endforeach
    @endif

@endsection

        <div style="position:absolute; margin-left:83%; margin-top:80px;">
            <h4><b> Sastojci </b></h4>
            @if( count($recept->ingredients)<1 )
                  <p>Nema dodanih sastojaka!</p>
            @else
                @foreach($recept->ingredients as $ing)
                    <p> <b>{{$ing->pivot->size}}</b> {{$ing->name}} </p> <br>
                @endforeach
            @endif
        </div>
