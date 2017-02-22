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
                        Stvori novi recept
                    </div>

                    <div class="panel-body">


                        <form method="POST" action="/new/next" enctype="multipart/form-data">

                            <!-- ovo se mora dodati jer sigurnost laravela inače ne da -->
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <!-- kako smo nazvali u bazi text note, tu će i spremiti iduće -->
                            <div class="form-group">
                                Naslov recepta
                                <input type="string" name="title" class="form-control">{{ old('title') }}</input>
                            </div>

                            <div class="form-group">
                                Tip recepta
                                <input type="string" name="type" class="form-control">{{ old('type') }}</input>
                            </div>

                            <div class="form-group">
                                Fotografija
                                <input type="file" name="image" ></input>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Dalje</button>
                            </div>
                        </form>

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