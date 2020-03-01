<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <script>
            addParam = function () {
                btnadd.insertAdjacentHTML("beforeend", "<div class='form-group row'><input type='text' name='parameters[name][]' class='form-control col-sm-2'>" +
                    "<input type='text' name='parameters[value][]' class='form-control col-sm-10'></div>");
            }
        </script>
        <title>Laravel</title>
    </head>
    <body>
        <div class='container'>
            {!! Form::open(array('method' => 'POST', 'action' => 'HousesController@store', 'enctype' => 'multipart/form-data', 'files' => true))!!}
                <div class="form-group">
                    <div class="row">
                        {!! Form::label('city', 'Город: ', ['class' => 'col-sm-2']) !!}
                        {!! Form::text('city', null, ['class' => 'form-control col-sm-10']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        {!! Form::label('district', 'Район: ', ['class' => 'col-sm-2']) !!}
                        {!! Form::text('district', null, ['class' => 'form-control col-sm-10']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        {!! Form::label('street', 'Улица: ', ['class' => 'col-sm-2']) !!}
                        {!! Form::text('street', null, ['class' => 'form-control col-sm-10']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        {!! Form::label('number', 'Номер дома: ', ['class' => 'col-sm-2']) !!}
                        {!! Form::text('number', null, ['class' => 'form-control col-sm-10']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        {!! Form::label('rooms', 'Кол-во комнат: ', ['class' => 'col-sm-2']) !!}
                        {!! Form::text('rooms', null, ['class' => 'form-control col-sm-10']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        {!! Form::label('floors', 'Этажность: ', ['class' => 'col-sm-2']) !!}
                        {!! Form::text('floors', null, ['class' => 'form-control col-sm-10']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        {!! Form::label('cost', 'Цена: ', ['class' => 'col-sm-2']) !!}
                        {!! Form::number('cost', null, ['class' => 'form-control col-sm-10']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        {!! Form::label('space', 'Площадь, м<sup>2</sup>', ['class' => 'col-sm-2'], false) !!}
                        {!! Form::number('space', null, ['class' => 'form-control col-sm-10']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        {!! Form::label('category', 'Категория: ', ['class' => 'col-sm-2']) !!}
                        {!! Form::select('category', $categories, null, ['class' => 'form-control col-sm-10']) !!}
                    </div>
                </div>
                <div class="form-group row justify-content-md-center">
                    <button type="button" onclick="addParam()" class="btn btn-success btn-sm col-sm-3">Добавить параметр</button>
                </div>
                <div id="btnadd"></div>
                @if(\Illuminate\Support\Facades\Auth::user()->isAdmin())
                    <div class="form-group row">
                        {!! Form::label('manager', 'Менеджер: ', ['class' => 'col-sm-2']) !!}
                        {!! Form::select('manager', $managers->pluck('name'), $managers->pluck('id'), ['class' => 'form-control col-sm-10']) !!}
                    </div>
                @endif
                <div class="form-group">
                    <div class="row">
                        {!! Form::label('description', 'Описание: ', ['class' => 'col-sm-2']) !!}
                        {!! Form::textarea('description', null, ['class' => 'form-control col-sm-10']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        {!! Form::file('images[]',  array('multiple' => 'multiple')) !!}
                    </div>
                </div>
                <div class="row justify-content-md-center">
                    {!! Form::submit('Добавить', ['class' => 'btn btn-success btn-lg col-sm-2']) !!}
                </div>

            {!! Form::close() !!}

        </div>
    </body>
</html>
<body>
