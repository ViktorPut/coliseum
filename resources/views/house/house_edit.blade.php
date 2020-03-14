<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script>
        addParam = function () {
            btnadd.insertAdjacentHTML("beforeend", "<div class='form-group row'><input type='text' name='parameters[name][]' class='form-control col-sm-3'><input type='text' name='parameters[value][]' class='form-control col-sm-9'></div>");
        }
    </script>
    <link rel="stylesheet" href="..src/sass/style.css">
    <title>Редактирование объявления</title>
</head>
<body>
<div class='container'>
    <form action="{{action('HousesController@update', [ 'house' => $house ])}}" method="POST" enctype="multipart/form-data">
        @csrf
        {{method_field('PATCH')}}
        <div class="form-group">
            <div class="row">
                <label for="city" class="col-sm-3">Город:</label>
                <input type="text" id="city" name="city" class="form-control col-sm-9" value="{{$house->address->city->name}}">
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <label for="district" class="col-sm-3">Район:</label>
                <input type="text" id="district" name="district" class="form-control col-sm-9" value="{{$house->address->district->name}}">
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <label for="street" class="col-sm-3">Улица:</label>
                <input type="text" id="street" name="street" class="form-control col-sm-9" value="{{$house->address->street->name}}">
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <label for="number" class="col-sm-3">Номер дома:</label>
                <input type="text" id="number" name="number" class="form-control col-sm-9" value="{{$house->address->number}}">
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <label for="rooms" class="col-sm-3">Кол-во комнат:</label>
                <input type="text" id="rooms" name="rooms" class="form-control col-sm-9" value="{{$house->rooms}}">
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <label for="floors" class="col-sm-3">Этажность:</label>
                <input type="text" id="floors" name="floors" class="form-control col-sm-9" value="{{$house->floors}}">
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <label for="cost" class="col-sm-3">Цена:</label>
                <input type="number" id="cost" name="cost" class="form-control col-sm-9" value="{{$house->cost}}">
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <label for="space" class="col-sm-3">Площадь, м<sup>2</sup></label>
                <input type="number" id="space" name="space" class="form-control col-sm-9" value="{{$house->space}}">
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <label for="category" class="col-sm-3">Категория:</label>
                <select  value="{{$categories}}" id="category" name="category" class="form-control col-sm-9">
{{--                <input type="number" value="{{$categories}}" id="category" name="category" class="form-control col-sm-9">--}}
            </div>
        </div>
        <div class="form-group row justify-content-md-center justify-content-sm-center">
            <button type="button" onclick="addParam()" class="btn btn-primary btn-sm col-sm-3">Добавить параметр</button>
        </div>
        <div id="btnadd"></div>
        @if(\Illuminate\Support\Facades\Auth::user()->isAdmin())

            <div class="form-group">
                <div class="row">
                    <label for="manager" class="col-sm-3">Менеджер:</label>
                    <select id="manager" name="manager" class="form-control col-sm-9 custom-select">
                        @foreach( $managers as $manager)S
                            <option value="{{$manager->id}}">{{$manager->email}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        @endif
        <div class="form-group">
            <div class="row">
                <label for="description" class="col-sm-3">Описание:</label>
                <textarea type="text" id="description" name="description" class="form-control col-sm-9"></textarea>
            </div>
        </div>
        <div class="form-group">
            <label for="photo">Новые фотографии</label>
            <input type="file" class="form-control-file" id="photo" name="photo" multiple="multiple">
        </div>

        <div class="form-group row justify-content-md-center justify-content-sm-center justify-content-center">
            <button type="submit" class="btn btn-success btn-lg col-sm-4 col-4">Изменить</button>
        </div>
    </form>

    <form action="" method="POST">

    </form>

{{--    <div class="row">--}}
{{--        <!-- цикл по картинкам -->--}}
{{--        <div class="col-sm-4 smallPaddingLeftRight smallMarginTop">--}}
{{--            <img src="src/img/image.jpg" class="imageSize">--}}
{{--            <form action="" method="POST">--}}
{{--                <div class="form-group row smallMarginTop">--}}
{{--                    <label for="rank" class="col-sm-5 col-md-4 col-6">Ранг:</label>--}}
{{--                    <input type="number" name="rank" class="form-control col-sm-5 col-md-4" value="">--}}
{{--                </div>--}}
{{--                <div class="row justify-content-md-center justify-content-sm-center">--}}
{{--                    <button type="submit" class="btn btn-danger btn-md col-sm-7">Удалить</button>--}}
{{--                </div>--}}
{{--                <div class="row justify-content-md-center justify-content-sm-center smallMarginTop">--}}
{{--                    <button type="submit" class="btn btn-success btn-md col-sm-7">Сохранить</button>--}}
{{--                </div>--}}
{{--            </form>--}}
{{--        </div>--}}
{{--        <!-- конец цикл по картинкам -->--}}

{{--    </div>--}}
</body>
</html>
