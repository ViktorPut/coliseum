@extends('layouts.app')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
<div class="flex-center position-ref full-height">
    @if (Route::has('login'))
        <div class="top-right links">
            @auth
                <a href="{{ url('/') }}">Home</a>
            @else
                <a href="{{ route('login') }}">Login</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}">Register</a>
                @endif
            @endauth
        </div>
    @endif
     @section('content')
        <div class="title m-b-md">
             HOUSE INDEX
        </div>
        @csrf
        {!! Form::open(['method' => 'GET', 'action' => 'HousesController@create'])!!}
            {!! Form::submit('Добавить') !!}
        {!! Form::close() !!}
        {!! Form::label('') !!}
        @foreach($houses as $house)
            <ul>
                <li>
                    {{ $house->address->city->name }},
                    {{ $house->address->district->name }},
                    {{ $house->address->street->name }},
                    {{ $house->address->number }}
                    <br>
                    {{$house->category->real_name}}, {{number_format($house->cost, 0, '', ' ')}} руб.
                    {!! Form::open(['method' => 'GET', 'action' => ['HousesController@show', $house] ]) !!}
                        {!! Form::submit('Просмотреть') !!}
                    {!! Form::close() !!}
                    {!! Form::open(['method' => 'GET',  'action' => ['HousesController@edit', $house]]) !!}
                        {!! Form::submit('Обновить') !!}
                    {!! Form::close() !!}
                    {!! Form::open(['method' => 'DELETE',  'action' => ['HousesController@destroy', $house]]) !!}
                        {!! Form::submit('Удалить') !!}
                    {!! Form::close() !!}
                    <br>
                    *---------------------------------------------------------------------------------------------------*
                </li>
            </ul>
        @endforeach
    @endsection('content')

</body>
</html>
