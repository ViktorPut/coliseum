<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
    </head>
    <body>
        {!! Form::open(array('method' => 'POST', 'action' => 'HousesController@store'))!!}
            {!! Form::label('city', 'City: ') !!}
            {!! Form::text('city') !!}

            {!! Form::label('district', 'District: ') !!}
            {!! Form::text('district') !!}
            {!! Form::label('street', 'Street: ') !!}
            {!! Form::text('street') !!}
            {!! Form::label('number', 'Number: ') !!}
            {!! Form::text('number') !!}
            <br>
            {!! Form::label('rooms', 'Rooms: ') !!}
            {!! Form::text('rooms') !!}
            {!! Form::label('floors', 'Floors: ') !!}
            {!! Form::text('floors') !!}
            {!! Form::label('cost', 'Cost: ') !!}
            {!! Form::number('cost') !!}
            {!! Form::label('space', 'Space: ') !!}
            {!! Form::number('space') !!}<br>
            {!! Form::label('description', 'Description: ') !!}
            {!! Form::textarea('description') !!} <br>
            {!! Form::label('category', 'Category: ') !!}
            {!! Form::select('category', $categories->pluck('real_name'), $categories->pluck('id')) !!}<br>
{{--            @if(\Illuminate\Support\Facades\Auth::user()->isAdmin())--}}
                {!! Form::label('manager', 'Manager: ') !!}
                {!! Form::select('manager', $managers->pluck('name'), $managers->pluck('id')) !!}
{{--            @endif--}}
            {!! Form::submit('Add') !!}
        {!! Form::close() !!}
    </body>
</html>
