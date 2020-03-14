<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Создание пользователя</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</head>
<body>
<div class='container'>
{{--<!-- {!! Form::open(array('method' => 'POST', 'action' => 'UsersController@store'))!!} -->--}}
    <form action="{{action('UsersController', 'store')}}" method="POST">
        <div class="form-group">
            <div class="row">
                <label for="name" class="col-sm-3">Имя:</label>
                <input type="text" class="form-control col-sm-9" id="name" name="name">
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <label for="rank" class="col-sm-3">Ранг:</label>
                <input type="number" class="form-control col-sm-9" id="rank" name="rank">
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <label for="email" class="col-sm-3">Email:</label>
                <input type="email" class="form-control col-sm-9" id="email" name="email" aria-describedby="emailHelp">
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <label for="password" class="col-sm-3">Пароль:</label>
                <input type="password" class="form-control col-sm-9" id="newPassword" name="password">
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <label for="phone" class="col-sm-3">Телефон:</label>
                <input type="text" class="form-control col-sm-9" id="phone" name="phone">
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <label for="description" class="col-sm-3">Информация:</label>
                <textarea type="text" class="form-control col-sm-9" rows="3" id="description" name="description"></textarea>
            </div>
        </div>
        <div class="form-group">
            <label for="photo">Фотография</label>
            <input type="file" class="form-control-file" id="photo" name="photo">
        </div>
        <div class="row justify-content-md-center">
            <button type="submit" class="btn btn-success btn-lg col-sm-4">Добавить</button>
        </div>
        <!-- !! Form::close() !!} -->
    </form>

</div>
</body>
</html>
