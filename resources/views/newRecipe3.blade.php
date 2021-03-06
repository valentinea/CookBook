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
                        <h4><b> {{$recept->title}} 
                        ({{$recept->type}}) </b></h4><br>
                    </div>

                    <div class="panel-body">

                        <form method="POST" action="/new/{{$recept->id}}/text/add">

                            <!-- ovo se mora dodati jer sigurnost laravela inače ne da -->
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <!-- kako smo nazvali u bazi text note, tu će i spremiti iduće -->
                            <div class="form-group">
                                Tekst recepta:
                                <input type="text" name="text" class="form-control">{{ old('text') }}</input>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Recept je gotov!</button>
                            </div>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>


    </div>




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